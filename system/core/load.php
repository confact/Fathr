<?php
class load
{
	
	function view($name)
	{
		include($config['applicationpath'] . '/view/' . $name . '.php');
	}
}
?>