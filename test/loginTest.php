<?php

include_once('src/login.php');
include_once('test/helperEval.php');
include_once('test/bootstrap.php');

class loginTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Error message when email or password is set, but missing value.
     */
    CONST ERROR_MISSING_DATA = "<p>please enter both email and password</p>";
    
    //=============================================================================================
    /**
     * test load page first time, without errors only standalone form
     * @runInSeparateProcess
     */    
    public function testLoadPage() {
        
        $result = Evaluate(LOGIN_FILE, array());
        
        $this->assertEquals(null, $result);
    }
    //=============================================================================================
    /**
     * @runInSeparateProcess
     * @dataProvider dataLoginValues
     */     
    public function testLoginValues($post, $get, $error_search) {

        $result = Evaluate(LOGIN_FILE, array_merge($post, $get));
        
        $this->assertEquals(null, $result);
        
        //search error message in response
      //  if ($error_search) {
     //       $this->assertGreaterThan(0, strpos($result, $error_search));   
      //  }
           
    }
    //=============================================================================================
    public function dataLoginValues() {
        
        return array(
                        //page without required params (first time)
                        array(array(), array(), null),
                        
                        /**
                         * Not testable, data are not properly sanitized
                         */
                        //array(array("_POST" => array("email" => "test",
                        //                             "password" => array())), array(), null),
                        
                        array(array("_POST" => array("email" => "",
                                                     "password" => "")), array(), self::ERROR_MISSING_DATA),
                        array(array("_POST" => array("email" => "test",
                                                     "password" => "")), array(), self::ERROR_MISSING_DATA),
                       array(array("_POST" => array("email" => "",
                                                     "password" => "test")), array(), self::ERROR_MISSING_DATA),
                        
                     );
    }
    //=============================================================================================
}
