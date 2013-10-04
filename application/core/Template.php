<?php

/**
 * Главный класс для всех контроллеров
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 23:02:27
 */
class Template extends Base
{

    public $_data;
    private $_nameTemplate = '';

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    public function setVar($nameVar, $dataVar)
    {
        $this->_data[$nameVar] = $dataVar;
    }

    public function getRenderedHtml($pathToTemplate, $data)
    {
        $content = '';

        return $content;
    }

    public function show()
    {
        Core::app()->getLoader()->loadTemplate();
    }

    public function showBlock($nameBlock)
    {
        Core::app()->getLoader()->loadTemplateBlock($nameBlock);
    }

//Вызывается из кода шаблонов
//Вставляет результат работы модулей, привязанных к данной позиции.
    public function getModulesByPosition($nameModulePosition)
    {
        $positions = array(// Это тестовый масив. Такой же масив будет передаваться с БД
            'header_top' => array(
                'modules' => array(
                    0 => array(
                        'name' => 'menu',
                        'template_file' => 'mod_menu_header.php',
                        'data' => array('id_menu' => 0),
                    ),
                ),
            ),
            'footer_bottom' => array(
                'modules' => array(
                    0 => array(
                        'name' => 'menu',
                        'template_file' => 'mod_menu_footer_bottom.php',
                        'data' => array('id_menu' => 1),
                    ),
                    1 => array(
                        'name' => 'menu',
                        'template_file' => 'mod_menu_center_top.php',
                        'data' => array('id_menu' => 2),
                    ),
                ),
            ),
            'footer_top' => array(
                'modules' => array(
                    0 => array(
                        'name' => 'menu',
                        'template_file' => 'mod_menu_header.php',
                        'data' => array('id_menu' => 0),
                    ),
                ),
            ),            
            'center_top' => array(
                'modules' => array(
                    0 => array(
                        'name' => 'menu',
                        'template_file' => 'mod_menu_center_top.php',
                        'data' => array('id_menu' => 2),
                    ),
                ),
            ),
        );

        foreach ($positions as $key_position_name => $value)
        {
            if ($key_position_name == $nameModulePosition)
            {
                for ($i = 0; $i < count($value['modules']); $i++)
                {
                    $this->getModuleContent($value['modules'][$i]['name'], $value['modules'][$i]['template_file'], $value['modules'][$i]['data']);
                }
            }
        }
    }

    public function getModuleContent($nameModule, $pathContentView, $data)
    {//Реализовать возможность вызова модуля из другого домена, по типу hmvc

        $path =
                PATH_SITE_ROOT .
                SEPARATOR .
                PATH_TO_MODULES .
                SEPARATOR .
                $nameModule .
                SEPARATOR .
                NAME_FOLDER_MODULES_CONTROLLERS .
                SEPARATOR .
                PREFIX_CONTROLLER .
                $nameModule . '_main.php';

        if (file_exists($path))
        {
            require_once $path;

            $className = PREFIX_CONTROLLER . $nameModule . '_main';
            $mod = new $className;
            $mod->setNameModule($nameModule);

            $action = DEFAULT_ACTION;
            $arrData = $mod->$action($data);

            $template = Core::app()->getConfig()->getConfigItem('default_template');

            $path =
                    PATH_SITE_ROOT .
                    SEPARATOR .
                    $template['path'] .
                    SEPARATOR .
                    $template['name'] .
                    SEPARATOR .
                    'modules' .
                    SEPARATOR .
                    $nameModule .
                    SEPARATOR .
                    $pathContentView;
            
            if (file_exists($path))
            {
                extract($arrData);
                // Передаем данные в шаблон вывода
                require $path;
            }
        }
        else
        {
            Core::app()->getError()->errorFileNotExist('Блок ' . $path . ' не существует!');
        }
    }

}

?>