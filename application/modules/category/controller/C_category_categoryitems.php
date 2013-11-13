<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_category_categoryitems extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'categoryitems/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать категорию');        
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index($dataArr = NULL)
    {
        $post = Core::app()->getRequest()->getPost();

        if ($this->isEmpty($post))
        {
            $this->loadModel('categoryitems', 'category');

            Core::app()->getTemplate()->setVar('title_page', 'Категории');

            $dataArr = $this->M_category_categoryitems->getAllCategoryItems();


            for ($i = 0; $i < count($dataArr); $i++)
            {
                unset($dataArr[$i]['img']);

                unset($dataArr[$i]['id_parent']);
                unset($dataArr[$i]['id_module']);
                unset($dataArr[$i]['is_active']);

                unset($dataArr[$i]['show_name']);
            }


            $dataArr['link_edite'] = 'categoryitems/edite/';
            $dataArr['link_delete'] = 'categoryitems/delete/';
            //$this->echoPre($dataArr['link_edite']);
            $content = Core::app()->getTemplate()->getWidget('data_table', $dataArr);

            Core::app()->getTemplate()->setVar('content', $content);
        }
    }
    
    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

    }
    
    public function create()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {// Сделать проверку на валидность и пустоту
            $this->loadModel('categoryitems', 'category');
            
            unset($post['id']);

            if (isset($post['is_active']))
            {
                $post['is_active'] = true;
            }
            else
            {
                $post['is_active'] = false;
            }

            $this->M_category_categoryitems->setCategoryItem($post);

            $url = Core::app()->getHtml()->createUrl('admin/categoryitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $this->loadModel('modules', 'admin');

            $dataArr = array();
            $dataArr['form_action'] = 'admin/categoryitems/create/';
            $dataArr['all_category_modules'] = $this->M_admin_modules->getAllModules('category');
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_categoryitem_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            $dataArr['name_system'] = 'category';
            $dataArr['name_controller'] = 'categoryitems';
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);

            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Создание категории');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('categoryitems', 'category');

            $id = $post['id'];

            if (isset($post['is_active']))
            {
                $post['is_active'] = true;
            }
            else
            {
                $post['is_active'] = false;
            }

            // На всяк случай проверяем, а не является ли родителем сам пункт меню
            // Если да, то не меняем родителя
            if ($id == $post['id_parent'])
            {
                unset($post['id_parent']);
            }
            //Core::app()->echoPre($post); 
            //Core::app()->echoPre($dataArr);

            $this->M_category_categoryitems->updateCategoryitemById($id, $post);

            $url = Core::app()->getHtml()->createUrl('admin/categoryitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('categoryitems', 'category');
            $this->loadModel('modules', 'admin');

            $dataArr = $this->M_category_categoryitems->getCategoryItemById($get['id']);

            Core::app()->getTemplate()->setVar('title_page', 'Редактирование пункта меню');

            $dataArr['form_action'] = 'admin/categoryitems/update/';
            $dataArr['all_category_modules'] = $this->M_admin_modules->getAllModules('category');
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'admin';
            $dataArr['file_content_view'] = 'mod_admin_categoryitem_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            $dataArr['name_controller'] = 'categoryitems';
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);


            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('categoryitems', 'category');

            $this->M_category_categoryitems->deleteCategoryItemById($get['id']);

            $url = Core::app()->getHtml()->createUrl('admin/categoryitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        $content = '';

        if ($dataArr != null)
        {
            $dataArr['root'] = 'Корень модуля категории';
            
            $this->loadModel('categoryitems', $this->getNameModule());

            $dataOptionArr = $this->M_category_categoryitems->getAllCategoryItems();
            
            $dataArr = $this->getDefaultCategoryItemData($dataArr);

            $dataArr['select_all_items'] = $dataOptionArr;
            $dataArr['select'] = 'form_select';
            $dataArr['select_name'] = 'id_parent';
            $dataArr['select_lable'] = 'Родительская категория:';
            $dataArr['option_value_selected'] = $dataArr['id_parent']; // Существующий родительский пункт

            $y = 0;

            $dataArr['select_data'][$y]['option_value'] = 0;
            $dataArr['select_data'][$y]['option_text'] = $dataArr['root'];
            $y++;
            
            // Формируем текущий список родительских пунктов меню
            for ($i = 0; $i < count($dataOptionArr); $i++)
            {
                if ($dataArr['id_module'] == $dataOptionArr[$i]['id_module'] && $dataArr['id'] != $dataOptionArr[$i]['id'])
                {
                    $dataArr['select_data'][$y]['option_value'] = $dataOptionArr[$i]['id'];
                    $dataArr['select_data'][$y]['option_text'] = $dataOptionArr[$i]['name'];
                    $y++;
                }
            }
            //$this->echoPre($dataArr);
            $content .= Core::app()->getHtml()->createSelect($dataArr);

            
            // Третий параметр указывает, что виджет нужно искать в папке с шаблоном    
            $content .= Core::app()->getTemplate()->getWidget('menuitems_js', $dataArr, true);
        }

        return $content;
    }

    private function getDefaultCategoryItemData($dataArr)
    {
        if (is_array($dataArr))
        {
            if (!isset($dataArr['id_module']) || $this->isEmpty($dataArr['id_module']))
            {
                if(isset($dataArr['all_category_modules']))
                {
                    $dataArr['id_module'] = $dataArr['all_category_modules'][0]['id'];
                }
                else
                {
                    $dataArr['id_module'] = 0;
                }
                
            }

            if (!isset($dataArr['id_parent']) || $this->isEmpty($dataArr['id_parent']))
            {
                $dataArr['id_parent'] = 0;
            }

            if (!isset($dataArr['id']) || $this->isEmpty($dataArr['id']))
            {
                $dataArr['id'] = 0;
            }                        
        }

        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function deleteModuleDataById($id)
    {
        
    }

}

?>