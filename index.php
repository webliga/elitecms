<?php
ini_set('display_errors', 1);

require_once '/application/core/bootstrap.php';

Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'db');
Core::app()->getConfig()->loadConfig(PREFIX_CONFIG.'default');

Core::app()->getRoute()->run();
?>