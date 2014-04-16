<?php
/**
* This is the helper that will help you with the communication, save and removal for the session cookies.
* This helper is tested.
* @author Håkan Nylén
*
*/
class Session {

    function __construct()
    {
        if (!isset($_SESSION)) session_start();
    }

    function getUser($key)
    {
        if(isset($_SESSION['user_'.$key])) {
            return $_SESSION['user_'.$key];
        }
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