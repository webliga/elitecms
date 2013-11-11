<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_category_main extends Controller
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
    public function index($dataArr = null)
    {
        Core::app()->getTemplate()->setVar('content', 'Выводим данные связанные с этой категорией. Сейчас находимся в category/main');
    
        $this->echoPre(Core::app()->getRequest()->getGet());
    }
    
    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

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
        $this->loadModel('M_main', $this->getNameModule());
        $this->loadModel('M_shop', $this->getNameModule());

        Core::app()->getTemplate()->setVar('title_page', 'Страница создания новости. Отображается форма редактирования');
    }

    public function write()
    {
        $this->loadModel('M_main', $this->getNameModule());
        $this->loadModel('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница записи новости. Отображается форма записи');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function edite()
    {
        $this->loadModel('M_main', $this->getNameModule());
        $this->loadModel('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница редактирования новости. Отображается форма редактирования');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

// Получаем индивидуальные поля для настройки модуля
    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {//$this->echoPre($dataArr);
            $content = '';

            $this->loadModel('main', $this->getNameModule());

            $dataArr = $this->M_category_main->getCategorySettingsByModuleId($dataArr['id']);
            $dataArr = $this->getDefaultCategoryData($dataArr);


            $dataArr['input'] = 'form_input';

            $dataArr['input_name'] = 'template_name';
            $dataArr['input_value'] = $dataArr['template_name'];
            $dataArr['input_lable'] = 'Шаблон для отображения модуля категории';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'template_file';
            $dataArr['input_value'] = $dataArr['template_file'];
            $dataArr['input_lable'] = 'Файл для отображения контента категории';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'count_elements';
            $dataArr['input_value'] = $dataArr['count_elements'];
            $dataArr['input_lable'] = 'Количество элементов на странице';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_width';
            $dataArr['input_value'] = $dataArr['img_width'];
            $dataArr['input_lable'] = 'Ширина картинки категории';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_height';
            $dataArr['input_value'] = $dataArr['img_height'];
            $dataArr['input_lable'] = 'Высота картинки категории';
            $content .= Core::app()->getHtml()->createInput($dataArr);
            /*
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
             */
            return $content;
        }
    }

    private function getDefaultCategoryData($dataArr)
    {
        if (is_array($dataArr))
        {

            if ($this->isEmpty($dataArr['template_name']))
            {
                $dataArr['template_name'] = '';
            }

            if ($this->isEmpty($dataArr['template_file']))
            {
                $dataArr['template_file'] = '';
            }

            if ($this->isEmpty($dataArr['count_elements']) || $dataArr['count_elements'] == 0)
            {
                $dataArr['count_elements'] = '20';
            }

            if ($this->isEmpty($dataArr['img_width']) || $dataArr['img_width'] == 0)
            {
                $dataArr['img_width'] = '100';
            }

            if ($this->isEmpty($dataArr['img_height']) || $dataArr['img_height'] == 0)
            {
                $dataArr['img_height'] = '100';
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr)
    {
        $this->loadModel('main', $this->getNameModule());

        $result = $this->M_category_main->updateCtegorySettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModel('main', $this->getNameModule());
        $this->loadModel('categoryitems', $this->getNameModule());

        $result = $this->M_category_main->deleteCategorySettingsByModuleId($id);
        $result = $this->M_category_categoryitems->deleteAllCategoryItemsByModuleId($id);
    }

}

?>