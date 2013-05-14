<?php

/* This is the config-file. */
global $config;
//development mode
$config['developmentmode'] = true;

// the path to the site. Example: www.example.com/fathr/ - then sitepath is fathr/
$config['sitepath'] = "";

// the "tag"/prefix for the tables in  fathr cms. "tag_"{settings} as example.
$config['table_tag'] = "fathr_";

// Applicationpath
$config['applicationpath'] = "../application";

// This is the default controller you will use if no page is set
$config['default_controller'] = "fathr_frontcontroller";

// use front controller/theme engine directly from the core?
$config['theme_from_core'] = true;
?>