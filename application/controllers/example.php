<?php
/**
 * A example controller to show how to use the framework.
 */
class Example extends Controller {

    /**
     * if you want to set own setting in construct, call parent's construct first.
     */
    function __construct() {
        parent::__construct();
    }

    /**
     * just show that only echos in this function will appear on fathrurl/example/index
     */
    function index() {
        echo "it Works!";
        echo "<br /><a href='/" . $this->config['sitepath'] . "example/newpage'>a new function</a>";
        echo "<br /><a href='/" . $this->config['sitepath'] . "example/testconfig'>see how configs works</a>";
        echo "<br /><a href='/" . $this->config['sitepath'] . "example/testmodel'>how model works</a>";
        echo "<br /><a href='/" . $this->config['sitepath'] . "example/testview'>custom views</a>";
        echo "<br /><a href='/" . $this->config['sitepath'] . "example/testhelper'>how a core helper works (session)</a>";
        echo "<br /><a href='/" . $this->config['sitepath'] . "example/testtheme'>see how the horrible theme engine works</a>";
        echo "<p>You can see the example code on <a href='https://github.com/confact/Fathr'>github</a>.</p>";
    }

    /**
     * just a new page, on example/newpage
     */
    public function newpage() {
        echo "new page";
    }

    /**
     * Shows how you can get config data.
     */
    public function testconfig() {
        echo "You can now get the configs directly in controller. (db_config is secret)<br />";
        echo "config['applicationpath'] = " . $this->config['applicationpath'];
    }

    /**
     * A example how to use models.
     */
    public function testmodel() {
        $this->load->model("user");
        $this->user->test();
    }

    /**
     * How to load and show a test, you can get the view as string 
     * if you set a second parameter to true
     */
    public function testview() {
        $this->load->view("test");
    }

    /**
     * How to use helpers, you can always add
     * your own helpers in the helpers directory
     */
    public function testhelper() {
        $this->load->helper("session");
        $this->session->setUser("test", "testar");
        echo $this->session->getuser("test");
    }

    /**
     * Shows how to use the parameters/arguments.
     * 
     * @param mixed $arg1
     * @param mixed $arg2
     */
    public function testarguments($arg1, $arg2) {
        echo "This framework only support 2 arguments for now..<br />";
        echo $arg1 . " - " . $arg2;
    }

    /**
     * How the falure will react, uncomment the lines and see what will happened.
     */
    public function testfails() {
        echo "This calls will fail because i haven't load them in the function:<br />";
        //$this->user->test();
        //echo $this->session->getuser("test");
    }

}

?>