<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_menu_main extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * Получаем стартовые данные для формирования меню
     */
    public function index($data = null)
    {
        if ($data != null)
        {
            $this->loadModule('M_menu_main', $this->getNameModule());

            $dataArr['menu_items'] = $this->M_menu_main->getMenuItemsByModuleId($data['id_module']);
//$this->echoPre($dataArr['menu_items']);
            $settings = $this->M_menu_main->getMenuSettingsByModuleId($data['id_module']);
            
            // Сделать сортировку масива пунктов меню по дочерним элементам (priority)

            // Получаем индивидуальные настройки CSS для пунктов меню из БД

            $classArr['menu_ul'] = $settings['menu_ul'];
            $classArr['menu_ul_level'] = $settings['menu_ul_level'];
            $classArr['menu_li'] = $settings['menu_li'];
            $classArr['menu_a'] = $settings['menu_span'];
            $classArr['menu_span'] = $settings['menu_a'];

            //Формируем HTML структуру меню
            $dataArr['menu_items'] = $this->createMenuTreeView($this->buildTree($dataArr['menu_items']), 1, $classArr);

            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = $settings['template_file'];
            $dataArr['return'] = false;
            //$this->echoPre($dataArr);
            Core::app()->getTemplate()->moduleContentView($dataArr, false);
            // Выводим на экран содержимое файла нашего модуля
            //Core::app()->getTemplate()->moduleFileContentView(null, $this->getNameModule(), $menu_items, $settings['template_file']);
        }
    }

    function buildTree($array_items)
    {
        if (is_array($array_items))
        {
            $items_count = count($array_items);
            for ($i = 0; $i < $items_count; $i++)
            {
                $item = $array_items[$i];
                if ($item['id_parent'] == 0)
                { //верхний уровень
                    $children = $this->getChildNode($array_items, $item['id']);
                    $item['children'] = $children;
                    $result[] = $item;
                }
            }
        }
        return (isset($result)) ? $result : false;
    }

    function getChildNode($array, $id)
    {
        $count = count($array);
        for ($i = 0; $i < $count; $i++)
        { // перебор массива
            $item = $array[$i];
            if ($item['id_parent'] == $id)
            { // 2 уровень найден
                $children = $this->getChildNode($array, $item['id']);
                $item['children'] = $children;
                $child_array[] = $item; // добавить 2 уровень
            }
        }
        if (isset($child_array))
        {
            return $child_array;
        }
        else
        {
            return false;
        }
    }

    // В класе Html нужно сделать создание списков
    public function createMenuTreeView($array_items, $level = 1, $classArr)
    {
        $result = '';

        $result .= '<ul class="' . $classArr['menu_ul'] . ' ' . $classArr['menu_ul_level'] . '-' . $level . '">';

        if (is_array($array_items))
        {
            $items_count = count($array_items);

            for ($i = 0; $i < $items_count; $i++)
            {
                $item = $array_items[$i];

                $result .= '<li class="' . $classArr['menu_li'] . ' ' . $item['class_li'] . '">';
                $result .=
                        '<a  class="' . $classArr['menu_a'] . '"  href="' . Core::app()->getHtml()->createUrl($item['link']) . '" title="' . $item['title'] . '">' .
                        '<span class="' . $classArr['menu_span'] . '">' .
                        $item['name'] .
                        '</span>' .
                        '</a>';

                if (is_array($item['children']))
                { //верхний уровень
                    $level++;
                    $result .= $this->createMenuTreeView($item['children'], $level, $classArr);
                    $level--;
                }

                $result .= '</li>';
            }
        }

        $result .= '</ul>';
        return (isset($result)) ? $result : false;
    }

    public function create()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->getTemplate()->setVar('title_page', 'Страница создания новости. Отображается форма редактирования');
    }

    public function write()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница записи новости. Отображается форма записи');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function edite()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница редактирования новости. Отображается форма редактирования');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

// Получаем индивидуальные поля для настройки модуля
    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {
            $content = '';

            $this->loadModule('M_menu_main', $this->getNameModule());

            $dataArr = $this->M_menu_main->getMenuSettingsByModuleId($dataArr['id']);
            $dataArr = $this->getDefaultMenuData($dataArr);
            
            
            $dataArr['input'] = 'form_input';


            $dataArr['input_name'] = 'template_file';
            $dataArr['input_value'] = $dataArr['template_file'];
            $dataArr['input_lable'] = 'Файл отображения';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'menu_ul';
            $dataArr['input_value'] = $dataArr['menu_ul'];
            $dataArr['input_lable'] = 'CSS класс для ul';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'menu_ul_level';
            $dataArr['input_value'] = $dataArr['menu_ul_level'];
            $dataArr['input_lable'] = 'CSS класс для ul level';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'menu_li';
            $dataArr['input_value'] = $dataArr['menu_li'];
            $dataArr['input_lable'] = 'CSS класс для li';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'menu_li_active';
            $dataArr['input_value'] = $dataArr['menu_li_active'];
            $dataArr['input_lable'] = 'CSS класс для активного li';
            $content .= Core::app()->getHtml()->createInput($dataArr);
            
            $dataArr['input_name'] = 'menu_a';
            $dataArr['input_value'] = $dataArr['menu_a'];
            $dataArr['input_lable'] = 'CSS класс для a';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'menu_span';
            $dataArr['input_value'] = $dataArr['menu_span'];
            $dataArr['input_lable'] = 'CSS класс для span';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            return $content;
        }
    }

    private function getDefaultMenuData($dataArr)
    {
        if (is_array($dataArr))
        {
            if ($this->isEmpty($dataArr['menu_ul']))
            {
                $dataArr['menu_ul'] = 'nav-ul';
            }
            
            if ($this->isEmpty($dataArr['menu_ul_level']))
            {
                $dataArr['menu_ul_level'] = 'nav-ul-level';
            }
            
            if ($this->isEmpty($dataArr['menu_li']))
            {
                $dataArr['menu_li'] = 'nav-li';
            }
            
            if ($this->isEmpty($dataArr['menu_li_active']))
            {
                $dataArr['menu_li_active'] = 'nav-li-active';
            }            
            
            if ($this->isEmpty($dataArr['menu_a']))
            {
                $dataArr['menu_a'] = 'nav-a';
            }
            
            if ($this->isEmpty($dataArr['menu_span']))
            {
                $dataArr['menu_span'] = 'nav-span';
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr)
    {
        $this->loadModule('M_menu_main', $this->getNameModule());

        $result = $this->M_menu_main->updateMenuSettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModule('M_menu_main', $this->getNameModule());
        $this->loadModule('M_menu_menuitems', $this->getNameModule());

        $result = $this->M_menu_main->deleteMenuSettingsByModuleId($id);
        $result = $this->M_menu_menuitems->deleteAllMenuItemsByModuleId($id);
    }

}

?>