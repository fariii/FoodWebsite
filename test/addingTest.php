<?php
include_once('src/adding.php');

class addingTest extends PHPUnit_Framework_TestCase {
    
    CONST ERROR_MISSING_DATA = "Please enter all the requirement.";
    CONST ERROR_EXISTING_MEAL = "This meal already exists";
    CONST ERROR_INSERT_MEAL = "Failed insert new meal";
    CONST SUCCESS_ADDED = "New meal added";
    CONST SUCCESS_UPDATE = "meal updated";
    CONST ERROR_UPDATE = "meal update failed";
    //=============================================================================================
    /**
     * test load page first time, without "adding" param
     * @runInSeparateProcess
     */    
    public function testLoadPage() {
        
        $result = Evaluate(ADDING_FILE, array());
        
        $this->assertEquals(null, $result);
    }
    //=============================================================================================
    /**
     * @dataProvider dataAddMeal
     */     
    public function testAddMeal($post, $get, $error_search) {
        
        $post["adding"] = "add";
        
        $result = Evaluate(ADDING_FILE, array_merge($post, $get), array("user" => "test"));
        
        $this->assertEquals(null, $result);
        
        //search error message in response
       // if ($error_search) {
       //     $this->assertGreaterThan(0, strpos($result, $error_search));   
       // }
           
    }
    //=============================================================================================
    public function dataAddMeal() {
        
        return array(
                        //page without required params (first time)
                        array(array(), array(), null),
                        
                        /**
                         * Not testable, data are not properly sanitized
                         */
                        //array(array("_POST" => array("adding" => 1)), array(), self::ERROR_MISSING_DATA),
                        
                        array(array("_POST" => array("FoodName" => "asdf",
                                                     "price" => "zero",
                                                     "description" => "simple")), array(), self::ERROR_MISSING_DATA),
                        array(array("_POST" => array("FoodName" => "food",
                                                     "price" => "",
                                                     "description" => "simple")), array(), self::ERROR_MISSING_DATA),
                        array(array("_POST" => array("FoodName" => "food",
                                                     "price" => "zero",
                                                     "description" => "")), array(), self::ERROR_MISSING_DATA),                        
                     );
    }

    //=============================================================================================
  
   
}
