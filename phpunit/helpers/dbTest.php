<?php
class dbTest extends PHPUnit_Framework_TestCase {

	private $load = "";
	private $controller = "";

	function __construct() {
		$this->load = new load($this);
		$this->load->helper("db");
	}
	
	function testCreateTable()
	{
		$tbl_name = "tableTest";
		$return = $this->db->create_table($tbl_name, array("id" => "int(10) NOT NULL AUTO_INCREMENT", "key" => "varchar(100) NOT NULL"), "id");

		$this->db->query("DROP TABLE IF EXISTS ".$tbl_name." CASCADE;");
		$this->assertTrue($return);
		
	}
	

}