<?php
class Session {

	function __construct()
	{
		session_start();
	}
	
	function getUser($key)
	{
		return $_SESSION['user_'.$key];
	}
	
	function setUser($key, $var)
	{
		$_SESSION['user_'.$key] = $var;
		return $_SESSION['user_'.$key];
	}
	
	function deleteUser($key)
	{
		unset($_SESSION['user_'.$key]);
	}
}
?>