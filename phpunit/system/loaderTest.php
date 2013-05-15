<?php
class loaderTest extends PHPUnit_Framework_TestCase {

	private $loader = "";

	function __construct()
	{
		global $fathr;
		$this->loader = new loader($fathr->config);
	}
	
	function testRun()
	{
		global $fathr;
		$echo = "it Works!" . "<br /><a href='/".$fathr->config['sitepath']."example/newpage'>a new function</a>" . 
		"<br /><a href='/".$fathr->config['sitepath']."example/testconfig'>see how configs works</a>" . 
		"<br /><a href='/".$fathr->config['sitepath']."example/testmodel'>how model works</a>" .
		"<br /><a href='/".$fathr->config['sitepath']."example/testview'>custom views</a>" . 
		"<br /><a href='/".$fathr->config['sitepath']."example/testhelper'>how a core helper works (session)</a>" . 
		"<br /><a href='/".$fathr->config['sitepath']."example/testtheme'>see how the horrible theme engine works</a>" .
		"<p>You can see the example code on <a href='https://github.com/confact/Fathr'>github</a>.</p>";
		$this->expectOutputString($echo);
		$this->loader->run();
		
	}
	
	function testRunFail()
	{
		$this->loader->url[0] = "example2";
		$echo = " ERROR " . "403" . " - We had some problems. come back later.";
		$this->expectOutputString($echo);
		$this->loader->run();
	}

}
?>