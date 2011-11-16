<?php
class Father {
	private static $father;
	
	public $config = "";
	public $db;
	
	function __construct()
	{
		$fathr = &$this;
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