<?php

/**
 * Класс вывода ошибок
 * @author Веталь
 * @version 1.0
 * @created 17-Вер-2013 20:21:07
 */
class Event extends Base
{

    private $_eventsArr = array();

    function __construct()
    {
        
    }

    function __destruct()
    {
        
    }

    public function startEvent($eventName, $dataArr = null)
    {
        // Если существует наше событие
        if (isset($this->_eventsArr[$eventName]) && isset($this->_eventsArr[$eventName]['all_event_hooks']))
        {
            // получаем все хуки нашего события если они есть

            $allEventHooks = $this->_eventsArr[$eventName]['all_event_hooks'];
            $allHooksCount = count($allEventHooks);

            for ($i = 0; $i < $allHooksCount; $i++)
            {
                $hook = $allEventHooks[$i];
                // Запускаем каждый хук, передавая ему параметры
                $this->useHook($hook, $dataArr);
            }
        }
    }

    private function useHook($hook, $dataArr)
    {
        //путь к запускаемому контроллеру
        $path_controller =
                PATH_SITE_ROOT .
                SD .
                PATH_TO_MODULES .
                SD .
                $hook['module'] .
                SD .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SD .
                PFX_CONTROLLER .
                $hook['module'] .
                S_MODULE_NAME .
                $hook['controller'] .
                '.php';

        if ($this->issetFile($path_controller))
        {
            Core::app()->getLoader()->loadFile($path_controller);

            $controllerClass =
                    PFX_CONTROLLER .
                    $hook['module'] .
                    S_MODULE_NAME .
                    $hook['controller'];

            if (class_exists($controllerClass))
            {
                $module_controller = new $controllerClass;

                if (method_exists($module_controller, $hook['action']))
                {
                    $action = $hook['action'];
                    $module_controller->$action($dataArr);
                }
            }
        }
    }

    function init()
    {
        // Получаем дефолтные настройки модулей по умолчанию (из файла конфига модулей)
        $this->_eventsArr = Core::app()->getConfig()->getAllEventsHooksConfig();

        //$this->echoPre($this->_eventsArr);
    }

    public function registerEvent($nameSystem, $eventData)
    {
        $this->_eventsArr[$nameSystem] = $eventData;
    }

    public function registerHook($eventName, $hook)
    {
        if (isset($this->_eventsArr[$eventName]))
        {
            $this->_eventsArr[$eventName]['all_event_hooks'][] = $hook;
        }
        else
        {
            return false;
        }

        return true;
    }

}

?>