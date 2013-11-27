<?php
ini_set('display_errors', 1);

require_once $_SERVER['DOCUMENT_ROOT'] . '/application/core/bootstrap.php';


Core::app()->getConfig()->loadSystemConfig(PFX_CONFIG.'db');
Core::app()->getConfig()->loadSystemConfig(PFX_CONFIG.'default');
Core::app()->getConfig()->loadSystemConfig(PFX_CONFIG.'role_group');
Core::app()->getEvent()->init();

$time_start = microtime(true);



Core::app()->getRoute()->run();

$time_end = microtime(true);
$time = $time_end - $time_start;
echo $time;
?>