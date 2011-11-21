<?php
class Example extends Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index() {
		echo "it Works!";
		echo "<br /><a href='/".$this->config['sitepath']."/example/newpage'>a new function</a>";
		echo "<br /><a href='/".$this->config['sitepath']."/example/testconfig'>see how configs works</a>";
		echo "<br /><a href='/".$this->config['sitepath']."/example/testmodel'>how model works</a>";
		echo "<br /><a href='/".$this->config['sitepath']."/example/testview'>custom views</a>";
		echo "<br /><a href='/".$this->config['sitepath']."/example/testhelper'>how a core helper works (session)</a>";
		echo "<br /><a href='/".$this->config['sitepath']."/example/testtheme'>see how the horrible theme engine works</a>";
		echo "<p>You can see the example code on <a href='https://github.com/confact/Fathr'>github</a>.</p>";
	}
	
	public function newpage() {
		echo "new page";
	}
	public function testconfig() {
		echo "You can now get the configs directly in controller. (db_config is secret)<br />";
		echo "config['applicationpath'] = " . $this->config['applicationpath'];
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
	
	public function testarguments($arg1, $arg2) {
		echo "This framework only support 2 arguments for now..<br />";
		echo $arg1." - ".$arg2;
	}
	public function testtheme() {
		$this->load->theme();
		$this->theme->setPageTitle("Fathr Title");
		$this->theme->setHeaderTitle("Fathr Header");
		$this->theme->setMain("test");
		$this->theme->render();
	}
	
	public function testfails() {
		echo "This calls will fail because i haven't load them in the function:<br />";
		//$this->user->test();
		//echo $this->session->getuser("test");
	}

}
?>