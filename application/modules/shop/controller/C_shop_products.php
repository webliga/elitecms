<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_shop_products extends Controller
{

    private $_pathToProductsImg = '';

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'newsitems/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать новость/статью');
        
        $this->_pathToProductsImg  =
                    PATH_SITE_ROOT .
                    SD .
                    'img' .
                    SD .
                    'shop' .
                    SD .
                    'products' .
                    SD; 
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
        $files = Core::app()->getRequest()->getFile();
        $img = Core::app()->getImage();


        $this->loadModel('categoryitems', 'category');

        if (!$this->isEmpty($post))
        {
            $modelProduct = $this->loadModel('main', 'shop', true);
            $imagesData = $files['images'];

            
            $safeImgArr = $img->getSafeImagesArr($imagesData);
            $this->echoPre($imagesData);
            $this->echoPre($safeImgArr);
            
            
            
            $productData = $post['shop_products'];
            $id_product = $modelProduct->insertProduct($productData);
            $id_main_img = 0;
            
            for ($i = 0; $i < count($safeImgArr); $i++)
            {
                $file = $safeImgArr[$i];
                $file['path_to_save'] = $this->_pathToProductsImg . $id_product . SD;
                $img->saveImg($file);
                
                $imgDataArr['id_product'] = $id_product;
                $imgDataArr['name'] = $file['name'];
                $id_main_img = $modelProduct->insertProductImg($imgDataArr);
            }           
            
            $arr['id_main_img'] = $id_main_img;
            $modelProduct->updateProductById($id_product, $arr);
            $arr = null;
            
            $productData = $post['shop_products_content'];
            
            for ($i = 0; $i < count($productData); $i++)
            {
                $productData[$i]['id_product'] = $id_product;
                
                $modelProduct->insertProductContent($productData[$i]);
            }
            
            
            $productData = $post['id_categories'];
            
            for ($i = 0; $i < count($productData); $i++)
            {
                $arr['id_product'] = $id_product;
                $arr['id_category'] = $productData[$i];
                $modelProduct->insertProductCategory($arr);
            }            
            
            $this->echoPre($id_product);
            $this->echoPre($post, false, true);
            
            
/*

//// Сделать проверку на валидность и пустоту
            // http://spuzom.ru/detail.php?id=249
            // Добавление в источник выдает ошибка ?i воспринимает как нашу инструкцию, переделать
            $this->loadModel('main', 'shop');

            unset($post['id']);

            $post = $this->getDefaultNewsItemData($post);

            Core::app()->getEvent()->startEvent('shop_before_product_create', array(&$dataArr));
            $this->M_news_newsitems->setNewsItem($post);
*/

            
            //$url = Core::app()->getHtml()->createUrl('admin/newsitems');
            //Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $modelShop = $this->loadModel('main', 'shop', true);

            $settings = Core::app()->getConfig()->getConfigItem('settings');

            $dataArr = array();

            $dataArr['id'] = 0;
            $dataArr['all_langs'] = Core::app()->getConfig()->getConfigItem('all_langs');
            $dataArr['lang_site_default'] = $settings['lang_site_default'];
            $dataArr['root'] = 'Без категории';
            $dataArr['form_action'] = '/admin/shop/create/';

            $dataArr['path'] = '';
            $dataArr['name_module'] = 'shop';
            $dataArr['file_content_view'] = 'admin_product_create.php';
            $dataArr['return'] = true;

            Core::app()->getEvent()->startEvent('shop_before_product_create_empty', array(&$dataArr));

            //$this->echoPre($dataArr, false, true);

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            Core::app()->getTemplate()->setVar('title_page', 'Создание товара');
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

            $post = $this->getDefaultNewsItemData($post);

            Core::app()->getEvent()->startEvent('shop_before_product_update', array(&$post));
            unset($post['id']);
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

            Core::app()->getEvent()->startEvent('shop_before_product_edite', array(&$dataArr));
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