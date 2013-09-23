<?php
ini_set('display_errors', 1);

require_once '/application/core/bootstrap.php';

Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'db');
Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'default');
Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'role_group');

//Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());

Core::app()->getRoute()->run();
?>