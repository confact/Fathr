<?php
/**
 * More or less the real father. 
 * This load, fix uri and make the framework alive on the page.
 */
class loader {

    public $defaultcontroller = "";
    public $controllername = "";
    public $controller = "";
    public $controllerpath = "";
    public $url = "";

    /**
     * 
     * @param array $config
     */
    public function __construct($config = "") {
        $this->controllerpath = $config['applicationpath'] . '/controllers/';
        $this->defaultcontroller = $config['default_controller'];
        if (!isset($_GET['page'])) {
            $_GET['page'] = "";
        }
        $this->url = $this->urlslug($_GET['page']);
    }

    /**
     * checking the classes if exist and so on, if it does it will go on to alive();
     * @return void
     */
    public function run() {
        if ($this->url[0] == "" OR $this->url[0] == "index.php") {
            $this->controllername = ucfirst($this->defaultcontroller);
            $this->controller = new $this->controllername();
            $this->alive();
        } else {

            if (file_exists($this->controllerpath . $this->url[0] . '.php')) {
                $this->controllername = ucfirst($this->url[0]);
                $this->controller = new $this->controllername();
                $this->alive();
            } else {
                $this->show_error(403);
            }
        }
    }

    /**
     * this checks for the function and parameters in 
     * the controller saved from the function run();
     * @return void
     */
    private function alive() {
        if (isset($this->url[1]) AND $this->url[1] != NULL) {
            $function = $this->url[1];
            $parameters = $this->split_urlToOnlyParameters($this->url);
            if (method_exists($this->controller, $function)) {
                if (count($parameters) > 0) {
                    $this->openFunction($function, $parameters);
                } else {
                    $this->openFunction($function);
                }
            } else {
                $this->show_error(404);
            }
        } else {
            $this->openFunction("index");
        }
    }

    /**
     * checks for parameters and then call the function in the controller in the right way.
     * @global Father $fathr
     * @param string $function
     * @param array|null $parameters
     */
    private function openFunction($function, $parameters = null) {
        global $fathr;
        if ($parameters == null) {
            $fathr->controller = $this->controller;
            $fathr->controller->$function();
        } else {
            $fathr->controller = $this->controller;
            call_user_func_array(array($fathr->controller, $function), $parameters);
        }
    }

    /**
     * just check the url to find controllers,
     * function/actions and parameters.
     * 
     * @param string $url
     * @return string
     */
    private function urlslug($url) {
        $slug = explode('/', $url);
        foreach ($slug as $key => $value) {
            if (is_null($value)) {
                unset($my[$key]);
            }
        }
        return $slug;
    }

    /**
     * simple error shower.
     * 
     * @param string|int $errorid
     */
    private function show_error($errorid = "500") {
        echo " ERROR " . $errorid . " - We had some problems. come back later.";
    }

    /**
     * a working but ugly way to split the array to just 
     * containing parameters for the call_user_func_array();
     * 
     * @param array $array
     * @return array
     */
    private function split_urlToOnlyParameters($array) {
        $parameters = array();
        for ($i = 2; $i < count($array); $i++) {
            $parameters[] = $array[$i];
        }
        return $parameters;
    }

}

?>