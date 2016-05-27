<?php

require_once "DBDriver.php";

class drv_mysqli extends DBDriver {
    
    private $connection = null;
    
    //=============================================================================================
    public function Connect() {
        
        if ($this->connection) {
            return true;    
        }
        
        $this->connection = mysqli_connect($this->host, $this->user, $this->pass, $this->dbname);
        
        if ($this->connection) {
            return true;
        }
        
        return false;
    }
    //=============================================================================================
    public function Connected() {
        
        if ($this->connection) {
            return true;    
        }

        return false;
    }
    //=============================================================================================
    public function Close() {
        
        if ($this->connection === null) {
            return true;    
        }
        
        if (mysqli_close($this->connection)) {
            $this->connection = null;
            return true;
        }
        
        return false;
    }
    //=============================================================================================
    public function Query($query, array $types = array(), array $values = array()) {
    
        if (count($types) != count($values)) {
            return null; //invalid parameters
        }
        
        foreach ($values as $param_i => $param) {
            $break = false;
            if (!is_array($param) && false) {
                $param = array($values);
                $break = true;
            }
            
            $rep_i = strpos($query, "?");
            
            if ($rep_i !== false) {

                $query = substr_replace($query,
                                        $this->PDOTypeReplace($types[$param_i],
                                                              $param), $rep_i, 1);
            }
            
            if ($break) break;
        }    
    
        $query_resulsts = array();
        
        $results = mysqli_query($this->connection, $query, MYSQLI_STORE_RESULT);

        if (is_object($results)) {
            
            while($row = mysqli_fetch_assoc($results)) {

                $query_resulsts[] = $row;
            }
            
            $results->close();
        }
        else {
            $query_resulsts = $results;
            
            if (!$results) {
                $query_error = mysqli_errno($this->connection);
                
                if ($query_error != 0) {
                    $query_error_str = mysqli_error($this->connection);
                
                    echo $query_error.":".$query_error_str;
                }
            }
        }
        
        return $query_resulsts;
    }
    //=============================================================================================
    /**
     * Raw type cast by PDO constants.
     * 
     * @param PDO* $pdo_constant (see http://php.net/manual/en/pdo.constants.php)
     * @param mixed $value parameter value
     */
    private function PDOTypeReplace($pdo_constant, $value) {
        
        $ret_value = "NULL";
        
        if ($pdo_constant === \PDO::PARAM_STR) {
            $ret_value = "'".$this->Escape($value)."'";
        }
        else if ($pdo_constant === \PDO::PARAM_NULL) {
            $ret_value = "NULL";    
        }
        else {
            $ret_value = (int) $value;    
        }
       
        return $ret_value;
    }
    //=============================================================================================
    public function Escape($data) {
        
        if (!$this->connection) {
            return false;    
        }
        
        return mysqli_real_escape_string($this->connection, $data);    
    }
    //=============================================================================================
}