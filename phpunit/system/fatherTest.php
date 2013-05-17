<?php
class FatherTest extends PHPUnit_Framework_TestCase {
	
	private $fathr = "";
	
	function __construct()
	{
		global $fathr;
		$this->fathr = $fathr;
	}
	
	function testFathrIsFather()
	{
		
		$this->assertEquals($this->fathr, Father::instance());
	}
	
	function testConfig()
	{
		$this->assertNotEmpty($this->fathr->config["applicationpath"]);
	}
	
}
?>