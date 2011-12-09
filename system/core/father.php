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
		global $config;
		$this->config = $config;
		unset($config);
		$this->loader = new loader($this->config);
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
    	if($this->config['theme_from_core'])
    	{
    		
    	}
    	$this->loader->run();
    }
}
?>