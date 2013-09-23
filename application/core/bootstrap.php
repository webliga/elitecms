<?php
define('PATH_TO_CORE','application/core');
define('PATH_TO_APPLICATION','application');
define('PATH_TO_MODULES','application/modules');
define('PATH_TO_LANG','application/lang');
define('PATH_TO_CONFIG','application/config');
define('PATH_TO_LIB','application/lib');
define('PATH_SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);
define('SEPARATOR','/');
define('NAME_FOLDER_MODULES_MODELS','models');
define('NAME_FOLDER_MODULES_CONTROLLERS','controller');
define('PREFIX_CONTROLLER','C_');
define('PREFIX_MODEL','M_');


require_once PATH_TO_CORE.'/Grammatical.php';
require_once PATH_TO_CORE.'/Base.php';

require_once PATH_TO_CORE.'/Controller.php';
require_once PATH_TO_CORE.'/Model.php'; 
require_once PATH_TO_CORE.'/Secure.php'; 
require_once PATH_TO_CORE.'/Error.php'; 
require_once PATH_TO_CORE.'/Config.php';

require_once PATH_TO_CORE.'/Route.php';
require_once PATH_TO_CORE.'/Request.php';
require_once PATH_TO_CORE.'/Template.php';
require_once PATH_TO_CORE.'/Core.php';
require_once PATH_TO_CORE.'/Loader.php';