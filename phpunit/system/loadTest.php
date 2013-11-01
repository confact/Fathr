<?php
class loadTest extends PHPUnit_Framework_TestCase {
	
	private $load = "";
	private $controller = "";
	
	function __construct()
	{
		$this->controller = new Example();
		$this->load = new load($this->controller);
	}
	
	function testView()
	{
		$test = file_get_contents("../application/views/test.php");
		$this->expectOutputString($test);
        $this->load->view("test");
       
	}
	
	function testModelWithNoExcpetion()
	{
		try {
            $this->load->model("user");
            return;
        }
 
        catch (Exception $expected) {
            $this->fail($expected->getMessage());
        }
	}
	
	function testModelWithExcpetion()
	{
		try {
            $this->load->model("test");
        }
 
        catch (Exception $expected) {
            return;
        }
 
        $this->fail('An expected exception has not been raised.');
	}
	
	function testModelWithDuplicateExcpetion()
	{
		try {
            $this->load->model("user");
            $this->load->model("user");
        }
 
        catch (Exception $expected) {
            return;
        }
 
        $this->fail('An expected exception has not been raised.');
	}
	
	function testHelperWithExcpetion()
	{
		try {
            $this->load->helper("test");
        }
 
        catch (Exception $expected) {
            return;
        }
 
        $this->fail('An expected exception has not been raised.');
	}
		
	function testLoadFather()
	{
		global $config;
        $fatherr = new Father();
        
        $this->assertEquals($config, $fatherr->config);
	}
}