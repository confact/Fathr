<?php

/**
 * This is the helper that will help you with the communication,
 * save and removal for the session cookies.
 * 
 * This helper is tested.
 */
class Session {

    /**
     * just call session_start
     */
    function __construct() {
        if (!isset($_SESSION))
            session_start();
    }

    /**
     * 
     * @param string $key the key for the session
     * @return mixed
     */
    function getUser($key) {
        if (isset($_SESSION['user_' . $key])) {
            return $_SESSION['user_' . $key];
        }
    }

    /**
     * Set a session
     * 
     * @param string $key
     * @param mixed $var
     * @return mixed
     */
    function setUser($key, $var) {
        $_SESSION['user_' . $key] = $var;
        return $_SESSION['user_' . $key];
    }

    /**
     * Delete a session
     * 
     * @param string $key
     */
    function deleteUser($key) {
        unset($_SESSION['user_' . $key]);
    }

}

?>