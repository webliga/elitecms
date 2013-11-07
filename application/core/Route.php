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

// Проверяем урл на валидность (возвратит урл лишенный спецсимволов и других вредных инструкций))
        $url = Core::app()->getSecure()->validate_url($_SERVER['REQUEST_URI']);

        Core::app()->getConfig()->selectSystemConfig($url);

// Для удобства получаем ссылку на обработчик запроса
        $request = Core::app()->getRequest();

// Масив с правилами роутинга, будет создаваться из файлов модулей    
        $routeRuleArr = Core::app()->getConfig()->getModuleRouteRule();

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
                SD_MODULE_NAME .
                $request->getController() . '.php';

// Получаем язык отображения                  
        $path_lang = PATH_SITE_ROOT .
                SD .
                PATH_TO_LANG .
                SD .
                $request->getLang() .
                SD .
                $request->getLang() . '.php';

        if ($this->issetFile($path_controller))
        {
            Core::app()->getLoader()->loadFile($path_controller);

            $controllerClass =
                    PFX_CONTROLLER .
                    $request->getModuleName() .
                    SD_MODULE_NAME .
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
                $arrAccessAction = array(
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
                $configModule = Core::app()->getLoader()->loadFile($path_module_config, true, false);

                // Доступ екшена
                $arrAccessAction['access'] = $configModule['controller'][$request->getController()]['action'][$request->getAction()];

                //Core::app()->echoPre($arrAccessAction);
//Сначала проверяем доступен ли данный экшн только из админки? А потом уже груповой доступ
                if ($arrAccessAction['access']['callFromAdmin'] == $request->getCallFromAdmin() &&  Core::app()->getUser()->checkUserAccess($arrAccessAction))
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

                    Core::app()->getConfig()->setConfigItem('lang', $lang);

                    $action = $request->getAction();
// Отрабатываем модуль, который выводит главное содержание страницы
// и получаем страницу отображения контента
                    $page = $module_controller->$action();

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