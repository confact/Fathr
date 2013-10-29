<?php

/**
 * The class that helps the user to load helpers, 
 * models and views very easy, by calling this functions bellow.
 * @author confact <hakan@dun.se>
 */
class load {

    /**
     * 
     * @param Controller $controller
     */
    function __construct(&$controller) {
        $this->contr = &$controller;
    }

    /**
     * just simple include the view.
     * 
     * @global Father $fathr
     * @param string $name
     * @param boolean $return
     * 
     * @return void|string
     */
    function view($name, $return = false) {
        global $fathr;
        if (file_exists($fathr->config['applicationpath'] . '/views/' . $name . '.php')) {
            if ($return) {
                $returner = include($fathr->config['applicationpath'] . '/views/' . $name . '.php');
                return $returner;
            } else {
                include($fathr->config['applicationpath'] . '/views/' . $name . '.php');
            }
        }
    }

    /**
     * check if the model should load db, then save it to the controller.
     * 
     * @global Father $fathr
     * @param string $name
     * @param boolean $db
     * 
     * @throws Exception
     */
    function model($name, $db = false) {
        global $fathr;
        if (file_exists($fathr->config['applicationpath'] . '/models/' . $name . '.php')) {
            $modelname = ucfirst($name);
            if (!isset($this->contr->$name)) {
                $this->contr->$name = new $modelname($db);
            } else {
                throw new Exception("Model already set.");
            }
        } else {
            throw new Exception("Model at path " . $fathr->config['applicationpath'] . '/models/' . $name . '.php' . "doesn't exist.");
        }
    }

    /**
     * check if the helper is the db or not, then save it to the controller.
     * 
     * @global Father $fathr
     * @param string $name
     * @throws Exception
     */
    function helper($name) {
        global $fathr;
        if (file_exists($fathr->config['systempath'] . '/helpers/' . $name . '.php')) {
            if ($name == "db") {
                $modelname = ucfirst($name);
                $fathr->db = new $modelname();
                $this->contr->$name = &$fathr->db;
            } else {
                $modelname = ucfirst($name);
                if (!isset($this->contr->$name)) {
                    $this->contr->$name = new $modelname();
                }
            }
        } else {
            throw new Exception("helper doesn't exist.");
        }
    }

}

?>