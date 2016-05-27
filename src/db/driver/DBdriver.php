<?php
/**
 * Abstract database driver class.
 */

if (!extension_loaded("PDO") && !class_exists("PDO")) {
    class PDO {
        CONST PARAM_INT = 1;
        CONST PARAM_STR = 2;
        CONST PARAM_NULL = 3;
    }
} 
 
abstract class DBDriver {

    protected $host = null;
    protected $port = null;
    protected $user = null;
    protected $pass = null;
    protected $dbname = null;
    
    public function __construct($host, $port, $user, $pass, $dbname) {
        
        $this->host = $host;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
        $this->dbname = $dbname;
    }
    //=============================================================================================
    public function __destruct() {
        
        $this->Close();    
    }
    //=============================================================================================
    /**
     * Open database connection
     */
    protected function Connect() {
        
        return false;
    }
    //=============================================================================================
    public function Connected() {
        
        return false;    
    }
    //=============================================================================================
    /**
     * Close database connection 
     */
    protected function Close() {
        
        return false;    
    }
    //=============================================================================================
    public function Query($sql, array $types = array(), array $values = array()) {
        
        return null;
    }
    //=============================================================================================
    /**
     * Escape string.
     * @param string $data string what we want escape
     * @return mixed escaped string is returned or false on error
     */
    public function Escape($data) {
        
        return false;
    }
    //=============================================================================================
}
