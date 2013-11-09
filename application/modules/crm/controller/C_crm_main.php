<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_Crm_main extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * index вызывается только в одном случаяе
     * 1. через url ($dataArr == null)
     */
    // Загружаем этот метод только из строки браузера
    // $dataArr - get параметры, передаваемые в строке браузера
    public function index($dataArr = null)
    {
        //$this->echoPre(phpinfo());
        $content = '';
        // Если существуют GET данные - $dataArr
        // показываем статью по id
        // Если нету GET данных, значит неправильно набран URL или без параметров

        $get = Core::app()->getRequest()->getGet();

        $this->loadModule('M_crm_main', 'crm');

        $classArr['menu_ul'] = 'menu_ul';
        $classArr['menu_ul_level'] = 'menu_ul_level';
        $classArr['menu_li'] = 'menu_li';
        $classArr['menu_a'] = 'menu_span';
        $classArr['menu_span'] = 'task_menu_a';

        $tree = $this->buildTree($this->M_crm_main->getAllTasks());


        $dataArr['tasks'] = $this->createTreeView($tree, 1, $classArr);
        $dataArr['path'] = '';
        $dataArr['name_module'] = $this->getNameModule();
        $dataArr['file_content_view'] = 'mod_tasks_list.php';
        $dataArr['return'] = true; //возвратить результат как текст (что б занести в переменную)

        $content .= Core::app()->getTemplate()->moduleContentView($dataArr, false);
        Core::app()->getTemplate()->setVar('title_page', 'Список задач');

        Core::app()->getTemplate()->setVar('content', $content);
    }

    function buildTree($array_items)
    {

        if (is_array($array_items))
        {
            $items_count = count($array_items);
            for ($i = 0; $i < $items_count; $i++)
            {
                $item = $array_items[$i];

                //$this->echoPre($item['id']);
                //$this->echoPre($item);

                if ($item['id_parent'] == 0)
                { //верхний уровень
                    $children = $this->getChildNode($array_items, $item['id']);

                    if (isset($item['crm_statuses_is_complete']) && $item['crm_statuses_is_complete'])
                    {
                        $item['percent'] = 100;
                    }
                    else
                    {
                        $item['percent'] = $this->getPercentComplete($children);
                    }


                    $item['children'] = $children;
                    $result[] = $item;

                    //$this->echoPre($children);
                    //$this->echoPre($item);
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

                // Если статус говорит что задание завершено (проверяется, завершено, закрыто, одобренно и т.д.)
                if (isset($item['crm_statuses_is_complete']) && $item['crm_statuses_is_complete'])
                {
                    $item['percent'] = 100;
                }
                else
                {
                    $item['percent'] = $this->getPercentComplete($children);
                }

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

    private function getPercentComplete($children)
    {
        $percent = 0;

        if (isset($children) && is_array($children))
        {
            $count = count($children);
            $part = floor(100 / $count); // 100% делим на к-ство потомков
            $all_child_complete = true;

            for ($i = 0; $i < $count; $i++)
            {
                if ($children[$i]['percent'] < 100)// если потомок завершен, то добавляем его % к основному %
                {
                    $all_child_complete = false;
                }

                $percent += floor($part * ($children[$i]['percent'] / 100));
            }

            // Если все детки имеют статус завершено. Например 100 / 3 дает 33, что при сумме 99, а не 100
            // Тогда прописываем 100 вручную
            if ($all_child_complete)
            {
                $percent = 100;
            }
        }

        return $percent;
    }

    public function createTreeView($array_items, $level = 1, $classArr)
    {
        $result = '';

        $result .= '<ul class="' . $classArr['menu_ul'] . ' ' . $classArr['menu_ul_level'] . '-' . $level . '">';

        if (is_array($array_items))
        {
            $items_count = count($array_items);

            for ($i = 0; $i < $items_count; $i++)
            {
                $item = $array_items[$i];

                $menu_span = $classArr['menu_span'];

                if (!isset($item['crm_statuses_name']))
                {
                    $item['crm_statuses_name'] = 'Без статуса';
                }

                if (!isset($item['title']))
                {
                    $item['title'] = '';
                }

                if (!isset($item['class_li']))
                {
                    $item['class_li'] = '';
                }

                if ($item['crm_statuses_is_complete'])// если потомок завершен, то добавляем его % к основному %
                {
                    $menu_span = 'task_menu_a_complete';
                }

                $result .= '<li class="' . $classArr['menu_li'] . ' ' . $item['class_li'] . '">';
                $result .=
                        '<a  class="' . $classArr['menu_a'] . '"  href="' . Core::app()->getHtml()->createUrl('crm/tasks/?id=' . $item['id']) . '" title="' . $item['title'] . '">' .
                        $item['name'] .
                        ' (' .
                        $item['percent'] . ' %) ' .
                        '<span class="' . $menu_span . '">' .
                        ' ( ' .
                        $item['crm_statuses_name'] . ' )' .
                        '</span>' .
                        '</a>';

                if (is_array($item['children']))
                { //верхний уровень
                    $level++;
                    $result .= $this->createTreeView($item['children'], $level, $classArr);
                    $level--;
                }

                $result .= '</li>';
            }
        }

        $result .= '</ul>';
        return (isset($result)) ? $result : false;
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        // $dataArr - данные для вызова модуля в позиции

        if ($dataArr != null)
        {
            // Если есть данные $dataArr модуля
            // Выводим модуль в его позиции, согласно данным $dataArr
            // Если данных нету, значит мы вызвали этот экшн через строку в браузере
            $this->loadModule('M_crm_main', $this->getNameModule());

            $settings = $this->M_crm_main->getCrmSettingsByModuleId($dataArr['id_module']);

            //Формируем HTML структуру списка новостей
            $dataArr['crm_items'] = $this->M_crm_main->getCrm($settings['count_elements']);

            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = $settings['template_file'];
            $dataArr['return'] = false;
            //$this->echoPre($dataArr);
            Core::app()->getTemplate()->moduleContentView($dataArr, false);
            //$this->echoPre($dataArr);
        }
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

    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {
            $content = '';

            $this->loadModule('M_crm_main', $this->getNameModule());

            $dataArr = $this->M_crm_main->getCrmSettingsByModuleId($dataArr['id']);
            $this->echoPre($dataArr);

            $dataArr = $this->getDefaultCrmData($dataArr);


            $dataArr['input'] = 'form_input';


            $dataArr['input_name'] = 'template_file';
            $dataArr['input_value'] = $dataArr['template_file'];
            $dataArr['input_lable'] = 'Файл отображения списка новостей';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'count_elements';
            $dataArr['input_value'] = $dataArr['count_elements'];
            $dataArr['input_lable'] = 'К-ство элементов';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            return $content;
        }
    }

    private function getDefaultCrmData($dataArr)
    {
        if (is_array($dataArr))
        {
            if (!isset($dataArr['count_elements']) || $this->isEmpty($dataArr['template_file']))
            {
                $dataArr['template_file'] = '';
            }

            if (!isset($dataArr['count_elements']) || $this->isEmpty($dataArr['count_elements']))
            {
                $dataArr['count_elements'] = 20;
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        $this->loadModule('M_crm_main', $this->getNameModule());

        $result = $this->M_crm_main->updateCrmSettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModule('M_crm_main', $this->getNameModule());

        $result = $this->M_crm_main->deleteCrmSettingsByModuleId($id);
    }

}

?>