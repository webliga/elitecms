<?php
define('PATH_TO_CORE','application/core');
define('PATH_TO_APPLICATION','application');
define('PATH_TO_MODULES','application/modules');
define('PATH_TO_LANG','application/lang');
define('PATH_TO_CONFIG','application/config');
define('PATH_TO_LIB','application/lib');
define('PATH_SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

define('SEPARATOR','/');
define('DEFAULT_ACTION','index');
define('NAME_FOLDER_MODULES_MODELS','models');
define('NAME_FOLDER_MODULES_CONTROLLERS','controller');
define('NAME_FOLDER_MODULES_CONFIG','config');

define('PREFIX_CONTROLLER','C_');
define('PREFIX_MODEL','M_');
define('PREFIX_CONFIG','config_');

require_once PATH_TO_CORE.'/Base.php';

require_once PATH_TO_CORE.'/Access.php';
require_once PATH_TO_CORE.'/Controller.php';
require_once PATH_TO_CORE.'/Model.php'; 
require_once PATH_TO_CORE.'/Config.php';

require_once PATH_TO_CORE.'/Template.php';
require_once PATH_TO_CORE.'/Core.php';
require_once PATH_TO_CORE.'/Loader.php';
