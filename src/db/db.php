<?php
/**
 * database service as singleton (we don't want create multiple instance)
 */
class db {
    
    private $driver = null;
    
    CONST DRIVER_DIR = "driver";
    
    //class instance
    protected static $instance = null;
    
    //=============================================================================================
    protected function __construct($driver, $host, $port, $user, $pass, $dbname) {
            
        $this->LoadDriver($driver, $host, $port, $user, $pass, $dbname);
    }
    //=============================================================================================
    /**
     * Get database instance.
     * 
     * @param string $driver name of driver what we want load (driver are placed in DRIVER_DIR)
     * @param string $host database hostname
     * @param int|string $port database port
     * @param string $user database user
     * @param string $pass database user password
     * @param string $dbname database name
     *
     * @return db always instance of this class
     */
    public static function Instance($driver = null, $host = null, $port = null, $user = null, $pass = null, $dbname = null) {
        
        //firstime initialize
        if (static::$instance === null) {
            static::$instance = new self($driver, $host, $port, $user, $pass, $dbname);
        }
        
        return static::$instance;    
    }
    //=============================================================================================
    /**
     * Load database driver.
     *
     * @param string $driver name of driver what we want load (driver are placed in DRIVER_DIR)
     * @param string $host database hostname
     * @param int|string $port database port
     * @param string $user database user
     * @param string $pass database user password
     * @param string $dbname database name
     *
     * @return boolean true is returned when database driver was loaded successfully otherwise
     *                 is returned false
     */
    private function LoadDriver($driver, $host, $port, $user, $pass, $dbname) {

        $driver_path = __DIR__ . "/" . self::DRIVER_DIR . "/" .$driver . ".php";
        
        if (!(file_exists($driver_path) || is_file($driver_path))) {

            return false; //driver file not found
        }
        
        require_once($driver_path);
        
        if (!class_exists($driver)) {

            return false;    //driver class not exists after load driver class file
        }
        
        $driver_classname = "drv_".$driver;
        
        $driver_class = new $driver_classname($host, $port, $user, $pass, $dbname);
        
        if ($driver_class instanceof DBDRiver) {
            
            if ($driver_class->Connect()) {
                $this->driver = $driver_class;
                return true; //we load valid db driver
            }
        }

        return false; //driver is not inherited from DBDriver base class, which means is not valid
    }
    //=============================================================================================
    public function Connected() {
        
        if ($this->driver) {
            return $this->driver->Connected();
        }
        
        return false;
    }
    //=============================================================================================
    public function Query($sql, array $params = array(), array $values = array()) {
        
        if (!$this->driver) {
            return false;    
        }
        
        $results = $this->driver->Query($sql, $params, $values);
        
        return $results;
    }
    //=============================================================================================
    
}
