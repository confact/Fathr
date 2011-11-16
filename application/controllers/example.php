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
		$this->load->model("user");
		$this->user->test();
	}
	
	public function testview() {
		$this->load->view("test");
	}
	
	public function testhelper() {
		$this->load->helper("session");
		$this->session->setUser("test", "testar");
		echo $this->session->getuser("test");
	}

}
?>