<?php
class dbTest extends PHPUnit_Framework_TestCase {

	private $load = "";
	private $controller = "";

	function __construct() {
		$this->controller = new Example();
		$this->load = new load($this->controller);
	}
	
	function testLoadDb()
	{
		global $fathr;
        $this->load->helper("db");
        $this->assertEquals($this->controller->db, $fathr->db);
        
        return;
        
	}
	
	function testCreateTable()
	{
		$return = $this->db->create_table("test", array("id" => "int(10) NOT NULL AUTO INCREMENT", "key" => "varchar(100) NOT NULL"), "id");
		$this->assertTrue($return);
	}
	

}