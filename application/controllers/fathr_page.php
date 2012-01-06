<?php
class Fathr_page extends Controller {
	function __construct() {
		parent::__construct();
		$this->load->theme();
		$this->load->helper("db");
	}
	
	function index() {
		echo "works";
	}
	
	function page($id = 0) {
		if($id != 0)
		{
			
		}
		else {
			echo "give a id for the page";
		}
	}
	
}
?>