<?php
class Example extends Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index() {
		echo "it Works!";
		echo "<br /><a href='example/newpage'>how a other function can work</a>";
	}
	
	public function newpage() {
		echo "new page";
	}
	
	public function testmodel() {
		global $fathr;
		$fathr->load->model("user");
		$fathr->user->test();
	}
	
	public function testview() {
		global $fathr;
		$fathr->load->view("test");
	}

}
?>