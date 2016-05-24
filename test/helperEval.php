<?php

register_shutdown_function("ShutdownHandler");

//=================================================================================================
/**
 * Evaluate php file.
 * @params string $file path to php
 * @params array $data customer server variables ($_POST,$_GET)
 *
 *                     example: array("_POST" => array("keyname" => "keyvalue"))
 * @return string|null if error occurs then null is returned,otherwise is returned evaluated
 *                     $file php content.
 */
function Evaluate($file, array $data = array()) {
    
    if (!file_exists($file) || !is_file($file)) {
        return null;    
    }
    
    $vars = array_merge(array("_POST" => array(),
                              "_GET" => array()),
                        $data);
    
    $buffer_data = null;
    $content = file_get_contents($file);
    
    //start output buffer
    ob_start();
    
        $_POST = $vars["_POST"];
        $_GET = $vars["_GET"];
        
        //try {
            //eval php code.
            //Note: this is not safe way, but we test known code.
            eval("?>".$content."<?php");
            
            //store output buffer
            $buffer_data = ob_get_contents();
        
        //} catch(\Exception $e) {
            //$buffer_data = $e->getMessage();
        //    $buffer_data = null;
       // }
        
    //release output buffer
    ob_end_clean();
    
    return $buffer_data;
}
//=================================================================================================
function ShutdownHandler() {
    
        $lasterror = error_get_last();
        
        switch ($lasterror['type']) {
            case E_ERROR:
            case E_CORE_ERROR:
            case E_COMPILE_ERROR:
            case E_USER_ERROR:
            case E_RECOVERABLE_ERROR:
            case E_CORE_WARNING:
            case E_COMPILE_WARNING:
            case E_PARSE:
                echo "FATAL:".print_r($lasterror, true);
        }
}
