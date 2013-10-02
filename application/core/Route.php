<?php

/**
 * Класс который отвечает за запросы
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Route
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
        // Для удобства получаем ссылку на обрабтчик запроса
        $request = Core::app()->getRequest();
        $request->runParseUrl($url);

        //путь к запускаемому контроллеру
        $path_controller =
                PATH_SITE_ROOT .
                SEPARATOR .
                PATH_TO_MODULES .
                SEPARATOR .
                $request->getModule() .
                SEPARATOR .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SEPARATOR .
                PREFIX_CONTROLLER . $request->getController() . '.php';
        // Получаем язык отображения                  
        $path_lang = PATH_SITE_ROOT .
                SEPARATOR .
                PATH_TO_LANG .
                SEPARATOR .
                $request->getLang() .
                SEPARATOR .
                $request->getLang() . '.php';

        if (file_exists($path_controller))
        {
            Core::app()->getLoader()->loadClass($path_controller);

            $controllerClass = PREFIX_CONTROLLER . $request->getController();

            if (!class_exists($controllerClass))
            {
                Core::app()->getError()->errorPage404('3');
            }

            $module_controller = new $controllerClass;
            $module_controller->setNameModule($request->getModule()); //Вводим имя, что потом загружать модели данного модуля

            if (method_exists($module_controller, $request->getAction()))
            {
                // вызываем действие контроллера и включаем язык
                // проверяем доступ пользователя к екшену

                $arrAccessAction = array(
                        'module' => $request->getModule(),
                        'controller' => $request->getController(),
                        'action' => $request->getAction(),
                    );

                $path_module_config = 
                        PATH_SITE_ROOT .
                        SEPARATOR . 
                        PATH_TO_MODULES . 
                        SEPARATOR . 
                        $request->getModule() .
                        SEPARATOR .
                        NAME_FOLDER_MODULES_CONFIG . 
                        SEPARATOR .
                        PREFIX_CONFIG . 'main.php';
                                               
                // Получаем настройки модуля (разрешения екшенов)        
                $config = Core::app()->getLoader()->loadClass($path_module_config, true);
                //Core::app()->echoPre(Core::app()->getConfig()->getConfigItem('default_role'));
                //Core::app()->echoPre($config);
                // Доступ екшена
                $arrAccessAction['access'] = $config[$request->getController()][$request->getAction()];
                
                Core::app()->echoPre($arrAccessAction);
                
                if (Core::app()->getUser()->checkUserAccess($arrAccessAction))
                {
                    if (!file_exists($path_lang))
                    {
                        $path_lang = PATH_SITE_ROOT .
                                SEPARATOR .
                                PATH_TO_LANG .
                                SEPARATOR .
                                $request->getLang('ru') .
                                SEPARATOR .
                                $request->getLang('ru') . '.php';
                    }

                    //require_once $path_lang;

                    Core::app()->getLoader()->loadClass($path_lang);
                    
                    
                    Core::app()->getConfig()->setConfigItem('lang', $lang);

                    $action = $request->getAction();

                    $module_controller->$action();
                }
                else
                {
                    Core::app()->getError()->errorAccessDenied('Нет доступа');
                }
            }
            else
            {
                Core::app()->getError()->errorPage404('2');
            }
        }
        else
        {
            Core::app()->getError()->errorPage404('1');
        }
    }

}

?>