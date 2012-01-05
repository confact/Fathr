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
		$menu['home'] = "/example/newpage";
		$this->theme->setMenu($menu);
		$this->theme->setStylesheet("stylesheet");
		$this->theme->setMain("<p>This is a easy but still powerful framework with inbuilt theme engine for some slackers.</p> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed enim enim, iaculis non sagittis nec, eleifend non nulla. Aliquam ut aliquet eros. Etiam non quam sit amet magna lacinia rhoncus. Duis tempus purus vel nisi mattis in fermentum felis sodales. Praesent orci risus, vestibulum id hendrerit sit amet, posuere ac nibh. Nam aliquam vulputate nisl at ullamcorper. Maecenas elit dolor, aliquet ac imperdiet in, rutrum in nisl.</p>
<p>In et erat lacus. Pellentesque urna sapien, aliquet vitae porttitor vitae, consectetur ac ante. Morbi venenatis sapien ut arcu auctor pellentesque. Ut iaculis, nunc nec cursus faucibus, magna tortor euismod turpis, quis rhoncus orci nunc a neque. Mauris luctus, dui id mollis varius, lectus massa molestie diam, at rhoncus enim augue ut mi. Pellentesque convallis dapibus leo, vitae gravida enim pretium vel. Donec dolor nibh, sollicitudin eget semper commodo, elementum in turpis.</p><p>Morbi dapibus aliquam dignissim. Morbi tempus tempus lectus a venenatis. In nulla mi, tincidunt eu viverra at, hendrerit posuere purus. Integer sodales posuere mauris, ac hendrerit eros pharetra sed. Quisque erat leo, rutrum nec tempor posuere, consectetur sodales dui. Praesent augue erat, tempor ut luctus mattis, consequat et massa. Phasellus faucibus ornare massa, et laoreet eros cursus non. Integer at massa lacus, et tempus neque. Proin a urna eu lacus dictum mollis nec a velit. Fusce sit amet enim mauris, a condimentum sapien.</p><p>Praesent molestie condimentum ultrices. Maecenas suscipit turpis non mi malesuada dignissim. Fusce molestie porttitor fringilla. Suspendisse sodales ligula nec turpis pretium eleifend. Maecenas in erat tellus, quis pretium sapien. Sed tincidunt, felis ac gravida fermentum, felis nunc imperdiet nisl, vitae vehicula libero elit vitae massa. Nullam id sapien orci, dignissim tincidunt sapien. Duis ligula tellus, egestas vel varius ut, placerat id est.</p><p>Donec et ipsum in elit mollis faucibus nec sed erat. Quisque vitae massa posuere enim iaculis accumsan. Nulla facilisi. Cras consectetur pulvinar libero et fermentum. Sed enim dolor, luctus sit amet aliquam quis, sollicitudin et erat. Sed viverra, mi et vestibulum aliquam, neque odio malesuada nulla, sit amet semper turpis turpis vel ipsum. Nunc tortor ligula, porta eu elementum vel, facilisis sit amet metus. Phasellus laoreet lorem et nisl porttitor vehicula. Fusce vel libero purus. Vestibulum blandit eros commodo est pharetra sed pretium odio interdum. Sed vel nunc massa, non rutrum tellus. Curabitur at ante ultrices nunc porta ornare. Curabitur sit amet pharetra ipsum. Praesent at turpis urna, ut dignissim elit.</p>");
		$this->theme->setSidebar("Welcome", "right");
		$this->theme->setSidebar("Welcome left", "left");
		$this->theme->render();
	}
	
	public function testfails() {
		echo "This calls will fail because i haven't load them in the function:<br />";
		//$this->user->test();
		//echo $this->session->getuser("test");
	}

}
?>