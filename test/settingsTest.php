<?php

class settingsTest extends PHPUnit_Framework_TestCase {
    
    //=============================================================================================
    /**
     * Common settings variables test (presence, data type)
     * 
     * @dataProvider paramsSettings
     */
    public function testSettings($key, $type, $format) {
        
        $settings = $this->LoadSettings();
        
        $this->assertEquals(true, isset($settings[$key]), "(" . $key . ") missing or is null in settings.php");
        $this->assertInternalType($type, $settings[$key]);
        
        if ($type !== "string" || $format === null) {
            return;    
        }
        
        $this->assertRegExp($format, $settings[$key]);
    }
    //=============================================================================================
    /**
     * Data set for settings parameters.
     *
     * parameters: <variable name>,<variable value data type>, <regex pattern for test string format (optionaL)>
     *
     * for disable check regex pattern set <regex pattern> to null
     */
    public function paramsSettings() {
        
        return array(
                     //host : format test lower case names separated by dot
                     //sub.sub.sub.domain.tld
                     //sub.sub.sub.domain.tld:80 - port number (allowed one to three digit port)
                     "host" => array("host", "string", "/^([a-z](\.)?)+(\:[0-9]{1,3})?$/"),
                     //user : first char 's' with 7 digit sequence
                     "user" => array("user", "string", "/^(s){1}([0-9]){7}$/"),
                     //pass : format 6 digit sequence
                     "pass" => array("pass", "string", "/^([0-9]){6}$/"),
                     //db : format first char 's', 7 digits ended by "_db"
                     "db"   => array("db", "string", "/^(s){1}([0-9]){7}(_db){1}$/")
                     );    
    }
    //=============================================================================================
    /**
     * Helper load settings.php data.
     * We load data each time on new test, and we don't need use static "setUpBeforeClass"
     */
    private function LoadSettings() {

        include SETTINGS_FILE;
        
        return get_defined_vars();
    }
    //=============================================================================================
}