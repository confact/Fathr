<?php
class dbTest extends PHPUnit_Framework_TestCase {

	function __construct() {
		$this->controller = new Example();
		$this->load = new load($this->controller);
		$this->load->helper("db");
	}
	
	function testCreateTable()
	{
		$return = $this->db->create_table("test", array("id" => "int(10) NOT NULL AUTO INCREMENT", "key" => "varchar(100) NOT NULL"), "id");
		$this->assertTrue($return);
	}
	

}