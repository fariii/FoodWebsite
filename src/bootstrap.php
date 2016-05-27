<?php
/**
 * Common file for all mixed php+html codes.
 * Load and setup required services (database, session)
 */
    /**
     * load configuration
     */
    $settings = include("settings.php");
    
    //set defaults for missing configuration
    $settings = array_merge(array("driver" => "",
                                  "host" => "",
                                  "port" => "",
                                  "user" => "",
                                  "pass" => "",
                                  "dbname" => ""),
                            $settings);
    /**
     * Prepare session
     */
    if (session_start() !== true) {
        //report problem with session initialization    
    }
    
    /**
     * Prepare superglobals ($_POST, $_GET)
     */
    
    $_post = $_POST;
    $_get = $_GET;
    
    /**
     * Prepare database
     */
    require_once __DIR__ . "/db/db.php";

    if (db::Instance($settings["driver"],
                 $settings["host"],
                 $settings["port"],
                 $settings["user"],
                 $settings["pass"],
                 $settings["dbname"])->Connected() !== true) {
        //database connection issue
    }
    