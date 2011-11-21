<?php
class Father {
// The Fathr class, the singleton that will hold the important stuff in the framework.
	private static $father;
	
	public $config = "";
	public $db;
	public $theme;
	
	function __construct()
	{
		$this->father = &$this;
		global $config;
		$this->config = $config;
	}

	public static function instance()
    {
        if (!isset(self::$father)) {
            self::$father = new Father();
        }
        return self::$father;
    }
}
?>