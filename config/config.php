<?php

/* This is the config-file. */

//development mode
$config['developmentmode'] = true;

// the path to the site. Example: www.example.com/fathr - then sitepath is fathr
$config['sitepath'] = "fathr";

// Applicationpath
$config['applicationpath'] = "application";

// This is the default controller you will use if no page is set
$config['default_controller'] = "example";

require_once('config/db.php');
?>