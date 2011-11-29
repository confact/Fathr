<?php
class Father {
// The Fathr class, the singleton that will hold the important stuff in the framework.
	private static $father;
	
	public $config = "";
	public $db;
	public $theme;
	private $loader;
	
	function __construct()
	{
		$this->father = &$this;
		$this->loader = new loader();
		global $config;
		$this->config = $config;
		unset($config);
	}

	public static function instance()
    {
        if (!isset(self::$father)) {
            self::$father = new Father();
        }
        return self::$father;
    }
    
    public function run()
    {
    	if($config['theme_from_core'])
    	{
    		
    	}
    	$this->loader->run();
    }
}
?>