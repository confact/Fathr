<?php
/**
 * The Fathr class, the singleton that will hold the important stuff in the framework.
 */
class Father {
    private static $father;
    public $config = "";
    public $db;
    public $theme;
    private $loader;

    /**
     * loads the config and set it, and send it on to the loader
     * 
     * @global type $config
     */
    function __construct() {
        global $config;
        $this->config = $config;
        unset($config);
        $this->loader = new loader($this->config);
    }

    /**
     * 
     * @return type
     */
    public static function instance() {
        if (!isset(self::$father)) {
            self::$father = new Father();
        }
        return self::$father;
    }

    /**
     * the actual function that make everything work.
     * @return void
     */
    public function run() {
        if ($this->config['theme_from_core']) {
            
        }
        $this->loader->run();
    }

}

?>