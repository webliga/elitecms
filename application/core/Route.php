<?php

/**
 * Класс который отвечает за запросы
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Route extends Base
{

    private $_started;

    function __construct()
    {
        $this->_started = false;
    }

    function __destruct()
    {
        
    }

    public function run()
    {//  Предотвращаем повторный неконтролируемый/случайный запуск обработки запроса пользователя
        if ($this->_started)
        {
            return;
        }

        $this->_started = true;
        $config = Core::app()->getConfig();
// Проверяем урл на валидность (возвратит урл лишенный спецсимволов и других вредных инструкций))
        // под вопросом
        $url = Core::app()->getSecure()->validate_url($_SERVER['REQUEST_URI']);
        $config->selectSystemConfig($url);

        Core::app()->getEvent()->startEvent('route_select_system_config', array(&$config));
        //$this->echoPre($result, false, true);
// Для удобства получаем ссылку на обработчик запроса
        $request = Core::app()->getRequest();

// Масив с правилами роутинга, будет создаваться из файлов модулей    
        $routeRuleArr = $config->getAllModulesRouteRule();

        $request->setRouteRule($routeRuleArr);
        $request->setGlobalVars(); // Получаем get post данные (глобальные обнулятся)
        $request->runParseUrl($url);

        //путь к запускаемому контроллеру
        $path_controller =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_MODULES .
                SD .
                $request->getModuleName() .
                SD .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SD .
                PFX_CONTROLLER .
                $request->getModuleName() .
                S_MODULE_NAME .
                $request->getController() . '.php';

// Получаем язык отображения                  
        $path_lang = PATH_SITE_ROOT .
                SD .
                PATH_TO_LANG .
                SD .
                $request->getLang() . '.php';
        //Core::app()->echoPre($path_controller);
        if ($this->issetFile($path_controller))
        {
            Core::app()->getLoader()->loadFile($path_controller);

            $controllerClass =
                    PFX_CONTROLLER .
                    $request->getModuleName() .
                    S_MODULE_NAME .
                    $request->getController();

            if (!class_exists($controllerClass))
            {
                Core::app()->getError()->errorPage404('3 Класс ' . $controllerClass . ' не существует');
            }

            $module_controller = new $controllerClass;
            $module_controller->setNameModule($request->getModuleName()); //Вводим имя, что б потом загружать модели данного модуля

            if (method_exists($module_controller, $request->getAction()))
            {
                // вызываем действие контроллера и включаем язык
                // проверяем доступ пользователя к екшену
                $accessModuleCurrent = array(
                    'module' => $request->getModuleName(),
                    'controller' => $request->getController(),
                    'action' => $request->getAction(),
                );

                $path_module_config =
                        PATH_SITE_ROOT .
                        SD .
                        PATH_TO_MODULES .
                        SD .
                        $request->getModuleName() .
                        SD .
                        NAME_FOLDER_MODULES_CONFIG .
                        SD .
                        PFX_CONFIG . 'main.php';

                // Получаем настройки модуля (разрешения екшенов)  
                // Разработчик модуля прописывает тип  доступа к экшену
                $accessModuleDefault = Core::app()->getLoader()->loadFile($path_module_config, true, false);

                // Доступ екшена
                $accessModuleCurrent['access'] = $accessModuleDefault['controller'][$request->getController()]['action'][$request->getAction()];

//Сначала проверяем доступен ли данный экшн только из админки? А потом уже груповой доступ
                if ($accessModuleCurrent['access']['call_from_admin'] == $request->getCallFromAdmin() && Core::app()->getUser()->checkUserAccess($accessModuleCurrent))
                {
                    if (!file_exists($path_lang))
                    {
                        $path_lang =
                                PATH_SITE_ROOT .
                                SD .
                                PATH_TO_LANG .
                                SD .
                                $request->getLang('ru') .
                                SD .
                                $request->getLang('ru') . '.php';
                    }

                    $lang = Core::app()->getLoader()->loadFile($path_lang, true);

                    $config->setConfigItem('lang', $lang);

                    $action = $request->getAction();


                    // Отрабатываем модуль, который выводит главное содержание страницы
                    // и получаем страницу отображения контента
                    $page = $module_controller->$action($request->getParams());
                    /*
                      $this->echoPre(Core::app()->getConfig()->getDataArrayConfig());

                      $this->appExit();

                     */
                    Core::app()->getTemplate()->show($page);
                }
                else
                {
                    Core::app()->getError()->errorAccessDenied('Нет доступа');
                }
            }
            else
            {
                Core::app()->getError()->errorPage404('method_exists($module_controller, $request->getAction() = ' . $request->getAction());
            }
        }
        else
        {
            Core::app()->getError()->errorPage404('1');
        }
    }

}

?>