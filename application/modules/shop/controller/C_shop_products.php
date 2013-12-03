<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_shop_products extends Controller
{

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'newsitems/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать новость/статью');
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
            $this->loadModel('newsitems', 'news');

            Core::app()->getTemplate()->setVar('title_page', 'Новости / статьи');

            $dataArr = $this->M_news_newsitems->getAllNewsItems();


            for ($i = 0; $i < count($dataArr); $i++)
            {
                unset($dataArr[$i]['preview']);
                unset($dataArr[$i]['text']);
                unset($dataArr[$i]['img']);

                unset($dataArr[$i]['id_category_items']);
                unset($dataArr[$i]['id_author']);
                unset($dataArr[$i]['date_create']);

                unset($dataArr[$i]['from_source']);
                unset($dataArr[$i]['is_active']);
                unset($dataArr[$i]['show_title']);

                unset($dataArr[$i]['show_preview']);
                unset($dataArr[$i]['show_img']);
                unset($dataArr[$i]['show_date']);

                unset($dataArr[$i]['show_author']);
            }


            $dataArr['link_edite'] = 'newsitems/edite/';
            $dataArr['link_delete'] = 'newsitems/delete/';
            //$this->echoPre($dataArr['link_edite']);
            $content = Core::app()->getTemplate()->getWidget('data_table', $dataArr);

            Core::app()->getTemplate()->setVar('content', $content);

            return 'index.tpl.php';
        }
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();

        $this->loadModel('categoryitems', 'category');

        if (!$this->isEmpty($post))
        {// Сделать проверку на валидность и пустоту
            // http://spuzom.ru/detail.php?id=249
            // Добавление в источник выдает ошибка ?i воспринимает как нашу инструкцию, переделать
            $this->loadModel('newsitems', 'news');

            unset($post['id']);

            $post = $this->getDefaultNewsItemData($post);

            $this->M_news_newsitems->setNewsItem($post);

            $url = Core::app()->getHtml()->createUrl('admin/newsitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $this->loadModel('modules', 'admin');

            $dataArr = array();

            $dataArr['root'] = 'Без категории';
            $dataArr['form_action'] = 'admin/newsitems/create/';
            $dataArr['all_categories'] = $this->M_category_categoryitems->getAllCategoryItems();
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'news';
            $dataArr['file_content_view'] = 'admin_newsitem_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            $dataArr['name_system'] = 'news';
            $dataArr['name_controller'] = 'newsitems';
            $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
            $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);

            $dataArr['content'] = $content;

            $content = Core::app()->getTemplate()->getWidget('form', $dataArr, null);

            Core::app()->getTemplate()->setVar('title_page', 'Создание пункта меню');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();

        if (!$this->isEmpty($post))
        {
            $this->loadModel('newsitems', 'news');

            $id = $post['id'];
            unset($post['id']);
            $post = $this->getDefaultNewsItemData($post);

            //Core::app()->echoPre($post); 
            //Core::app()->echoPre($dataArr);

            $this->M_news_newsitems->updateNewsitemById($id, $post);

            $url = Core::app()->getHtml()->createUrl('admin/newsitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite()
    {
        $get = Core::app()->getRequest()->getGet();

        if (!$this->isEmpty($get))
        {
            $this->loadModel('newsitems', 'news');
            $this->loadModel('categoryitems', 'category');

            $dataArr = $this->M_news_newsitems->getNewsItemById($get['id']);
            Core::app()->getTemplate()->setVar('title_page', 'Редактирование статьи / новости');


            $dataArr['root'] = 'Без категории';
            $dataArr['form_action'] = 'admin/newsitems/update/';
            $dataArr['all_categories'] = $this->M_category_categoryitems->getAllCategoryItems();
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'news';
            $dataArr['file_content_view'] = 'admin_newsitem_create.php';
            $dataArr['return'] = true;

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            /*
              $dataArr['name_controller'] = 'newsitems';
              $dataArr['action'] = DEFAULT_ACTION_MODULE_FORM;
              $content .= Core::app()->getTemplate()->moduleContentView($dataArr, true);
             */
            //$this->echoPre($dataArr);
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
            $this->loadModel('newsitems', 'news');

            $this->M_news_newsitems->deleteNewsItemById($get['id']);

            $url = Core::app()->getHtml()->createUrl('admin/newsitems');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        $content = '';

        return $content;
    }

    private function getDefaultNewsItemData($dataArr)
    {
        if (is_array($dataArr))
        {
            $date = Date('H:i:s d-m-Y');

            if (isset($dataArr['is_active']))
            {
                $dataArr['is_active'] = true;
            }
            else
            {
                $dataArr['is_active'] = false;
            }

            if (isset($dataArr['show_title']))
            {
                $dataArr['show_title'] = true;
            }
            else
            {
                $dataArr['show_title'] = false;
            }

            if (isset($dataArr['show_preview']))
            {
                $dataArr['show_preview'] = true;
            }
            else
            {
                $dataArr['show_preview'] = false;
            }

            if (isset($dataArr['show_img']))
            {
                $dataArr['show_img'] = true;
            }
            else
            {
                $dataArr['show_img'] = false;
            }

            if (isset($dataArr['show_date']))
            {
                $dataArr['show_date'] = true;
            }
            else
            {
                $dataArr['show_date'] = false;
            }

            if (isset($dataArr['show_author']))
            {
                $dataArr['show_author'] = true;
            }
            else
            {
                $dataArr['show_author'] = false;
            }

            if (isset($dataArr['date_create']) && $this->isEmpty($dataArr['date_create']))
            {
                $dataArr['date_create'] = $date;
            }
            else
            {
                $dataArr['date_create'] = $date;
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