<?php
class loadTest extends PHPUnit_Framework_TestCase {
	
	private $load = "";
	
	function __construct()
	{
		$controller = new Controller();
		$this->load = new load($controller);
	}
	
	function testModelwithExcpetion()
	{
		try {
            $this->load->model("test");
        }
 
        catch (Exception $expected) {
            return;
        }
 
        $this->fail('An expected exception has not been raised.');
	}
	
	function testHelperwithExcpetion()
	{
		try {
            $this->load->helper("test");
        }
 
        catch (Exception $expected) {
            return;
        }
 
        $this->fail('An expected exception has not been raised.');
	}
}