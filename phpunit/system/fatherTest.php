<?php
class FatherTest extends PHPUnit_Framework_TestCase {
	
	function testFathrIsFather()
	{
		$fathr = Father::instance();
		$this->assertEquals($fathr, Father::instance());
	}
	
}
?>