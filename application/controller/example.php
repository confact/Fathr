<?php
class Example extends Controller {

	function index() {
		echo "it Works!";
		echo "<br /><a href='?page=example/newpage'>how a other function can work</a>";
	}
	
	public function newpage() {
		echo "new page";
	}

}
?>