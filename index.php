<?php
ini_set('display_errors', 1);

require_once '/application/core/bootstrap.php';

Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'db');
Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'default');
Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'role_group');

//Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());

$time_start = microtime(true);






Core::app()->getRoute()->run();

$time_end = microtime(true);
$time = $time_end - $time_start;
echo $time;
?>