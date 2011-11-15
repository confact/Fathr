<?php
require_once('config/config.php');
require_once('system/core/father.php');

$Father = new Father($config);
$Father->run();
?>