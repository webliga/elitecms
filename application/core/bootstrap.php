<?php
define('SEPARATOR','/');
define('SEPARATOR_MODULE_NAME','_');

define('EXT_TEMPLATE_FILE','.php');

define('NAME_FOLDER_MODULES_MODELS','models');
define('NAME_FOLDER_MODULES_CONTROLLERS','controller');
define('NAME_FOLDER_MODULES_CONFIG','config');
define('NAME_FOLDER_WIDGETS','widgets');
define('NAME_FOLDER_TEMPLATES','templates');
define('NAME_FOLDER_HTML','html');
define('NAME_FOLDER_ERROR','error');

define('PREFIX_CONTROLLER','C_');
define('PREFIX_MODEL','M_');
define('PREFIX_CONFIG','config_');
define('PREFIX_BLOCK','block_');

define('DEFAULT_ACTION','index');
define('DEFAULT_ACTION_MODULE_SHOW_DATA_BY_POSITION','showDataByPosition');
define('DEFAULT_ACTION_MODULE_FORM','getModuleFormFildsConfig');
define('DEFAULT_ACTION_MODULE_FORM_UPDATE','updateModuleFormFildsConfig');
define('DEFAULT_ACTION_MODULE_FORM_DELETE','deleteModuleDataById');
define('DEFAULT_PAGE_MAIN','index.tpl.php');

define('PATH_TO_CORE','application/core');
define('PATH_TO_APPLICATION','application');
define('PATH_TO_MODULES','application/modules');
define('PATH_TO_LANG','application/lang');
define('PATH_TO_CONFIG','application/config');
define('PATH_TO_LIB','application/lib');
define('PATH_SITE_ROOT',$_SERVER['DOCUMENT_ROOT']);

define('PATH_TO_DEFAULT_WIDGETS',PATH_SITE_ROOT . SEPARATOR . PATH_TO_APPLICATION . SEPARATOR . NAME_FOLDER_HTML . SEPARATOR . NAME_FOLDER_WIDGETS);
define('PATH_TO_DEFAULT_ERRORS',PATH_SITE_ROOT . SEPARATOR . PATH_TO_APPLICATION . SEPARATOR . NAME_FOLDER_HTML . SEPARATOR . NAME_FOLDER_ERROR);

require_once PATH_TO_CORE.'/Base.php';

require_once PATH_TO_CORE.'/Access.php';
require_once PATH_TO_CORE.'/Controller.php';
require_once PATH_TO_CORE.'/Model.php'; 
require_once PATH_TO_CORE.'/Config.php';

require_once PATH_TO_CORE.'/Template.php';
require_once PATH_TO_CORE.'/Core.php';
require_once PATH_TO_CORE.'/Loader.php';
