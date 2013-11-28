<?php
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/core/bootstrap.php';

$config = Core::app()->getConfig();
$config->loadSystemConfig(PFX_CONFIG.'db');
$config->loadSystemConfig(PFX_CONFIG.'default');
$config->loadSystemConfig(PFX_CONFIG.'role_group');
Core::app()->getEvent()->init();

$time_start = microtime(true);



Core::app()->getRoute()->run();
echo memory_get_usage(true) . '<br>';
$time_end = microtime(true);
$time = $time_end - $time_start;
echo $time;


?>