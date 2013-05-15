<?php
class sessionTest extends PHPUnit_Framework_TestCase {

	private $session = "";

	function __construct()
	{
		$this->session = new Session();
	}
	
	function testSession()
	{
		$testresult = "test-result";
		$this->session->setUser("test", $testresult);
		$this->assertEquals($this->session->getUser("test"), $testresult);
	}
	
	function testDeleteSession()
	{
		$testresult = "test-result";
		$this->session->setUser("test", $testresult);
		$this->session->deleteUser("test");
		$this->AssertEmpty($this->session->getUser("test"));
	}

}
?>