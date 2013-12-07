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
    private $_urlToProductsImg = '';

    function __construct()
    {
        parent::__construct();

        $this->init();

        Core::app()->getTemplate()->setVar('createPath', 'newsitems/create');
        Core::app()->getTemplate()->setVar('createTitle', 'Создать новость/статью');

        $this->_pathToProductsImg =
                PATH_SITE_ROOT .
                SD .
                'img' .
                SD .
                'shop' .
                SD .
                'products' .
                SD;


        $this->_urlToProductsImg =
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
            $modelProduct = $this->loadModel('main', 'shop', true);
            $settings = Core::app()->getConfig()->getConfigItem('settings');
            $id_curr_lang = $settings['lang_site_default'];

            $dataArr = $modelProduct->getAllProducts($id_curr_lang);

            //$this->echoPre($dataArr, false, true);

            for ($i = 0; $i < count($dataArr); $i++)
            {
                unset($dataArr[$i]['preview']);
                unset($dataArr[$i]['id_main_img']);
                unset($dataArr[$i]['hit']);
                unset($dataArr[$i]['is_active']);
                unset($dataArr[$i]['on_order']);
                unset($dataArr[$i]['id_lang']);
            }


            $dataArr['link_edite'] = '/admin/shop/products/edite/';
            $dataArr['link_delete'] = '/admin/shop/products/delete/';
            //$this->echoPre($dataArr['link_edite']);
            $content = Core::app()->getTemplate()->getWidget('data_table', $dataArr);

            Core::app()->getTemplate()->setVar('title_page', 'Все товары');
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


        if (!$this->isEmpty($post))
        {
            Core::app()->getEvent()->startEvent('shop_before_product_create', array(&$post, &$files));


            $modelProduct = $this->loadModel('main', 'shop', true);
            $imagesData = $files['images'];


            $safeImgArr = $img->getSafeImagesArr($imagesData);
$this->echoPre($safeImgArr, false, true);
            $productData = $post['shop_products'];
            $id_product = $modelProduct->insertProduct($productData);
            $id_main_img = 0;

            for ($i = 0; $i < count($safeImgArr); $i++)
            {
                $file = $safeImgArr[$i];
                $file['path_to_save'] = $this->_pathToProductsImg . $id_product . SD;

                $this->createProductImg($file);

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

            $url = Core::app()->getHtml()->createUrl('admin/shop/products');
            Core::app()->getRequest()->redirect($url, true, 302);
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

    private function createProductImg($imgData)
    {
        $img = Core::app()->getImage();

        $modelShop = $this->loadModel('main', 'shop', true);

        $moduleSettings = $modelShop->getAllShopSettings();
        $moduleSettings = $moduleSettings[0];
        $this->echoPre($moduleSettings, false, true);

        $img->saveImg($file);
        //$img->createDublicateImg($file);
    }

    public function update()
    {
        $post = Core::app()->getRequest()->getPost();
        $files = Core::app()->getRequest()->getFile();
        $img = Core::app()->getImage();



        if (!$this->isEmpty($post))
        {
            $id_product = (int) $post['id'];
            $modelProduct = $this->loadModel('main', 'shop', true);

            //$this->echoPre($post, false, true);
            $imagesData = $files['images']; // Новые изображения
            // Масив с безопасными картинками
            $safeImgArr = $img->getSafeImagesArr($imagesData);

            // Подготавливаем основные данные товара
            if (isset($post['shop_products']))
            {
                $productData = $this->getDefaultProductData($post['shop_products']);
            }
            else
            {
                $productData = $this->getDefaultProductData(array());
            }

            // Обновляем основные данные товара
            $modelProduct->updateProductById($id_product, $productData);
            $id_main_img = 0;

            // Удаляем картинки если такие есть
            if (isset($post['images_delete']))
            {
                for ($i = 0; $i < count($post['images_delete']); $i++)
                {
                    $id_image_delete = $post['images_delete'][$i];

                    //$img->deleteImg($file);

                    $modelProduct->deleteProductImageById($id_image_delete);
                }
            }

            // Вносим новые картинки
            for ($i = 0; $i < count($safeImgArr); $i++)
            {
                $file = $safeImgArr[$i];
                $file['path_to_save'] = $this->_pathToProductsImg . $id_product . SD;
                $img->saveImg($file);

                $imgDataArr['id_product'] = $id_product;
                $imgDataArr['name'] = $file['name'];
                $id_main_img = $modelProduct->insertProductImg($imgDataArr);
            }
            // устанавливаем главную картинку
            $arr['id_main_img'] = $id_main_img;
            $modelProduct->updateProductById($id_product, $arr);
            $arr = null;

            $productData = $post['shop_products_content'];
            // Обновляем или вносим новые данные контента по языкам товара
            for ($i = 0; $i < count($productData); $i++)
            {
                $id_lang = (int) $productData[$i]['id_lang'];
                $content_isset = $modelProduct->checkProductContentByLangId($id_lang);

                //проверяем, существует ли контент для данного языка, если нет то создаем, если да то обновляем
                if ($content_isset > 0)
                {
                    $modelProduct->updateProductContentById($id_product, $id_lang, $productData[$i]);
                }
                else
                {
                    $productData[$i]['id_product'] = $id_product;
                    $modelProduct->insertProductContent($productData[$i]);
                }
            }

            $productData = $post['id_categories'];
            // удаляем все категории
            $modelProduct->deleteAllCategoriesByProductId($id_product);

            // вносим новые категории товара
            for ($i = 0; $i < count($productData); $i++)
            {
                $arr['id_product'] = $id_product;
                $arr['id_category'] = $productData[$i];
                $modelProduct->insertProductCategory($arr);
            }

            $url = Core::app()->getHtml()->createUrl('admin/shop/products');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
    }

    public function edite($params = null)
    {
        $id = 0;
        if ($params != null && is_array($params))
        {
            $id = $params['id'];
        }
        else
        {
            $get = Core::app()->getRequest()->getGet();
            $id = $get['id'];
        }

        if ($id > 0)
        {
            $modelShop = $this->loadModel('main', 'shop', true);



            $settings = Core::app()->getConfig()->getConfigItem('settings');

            $dataArr = $modelShop->getProductById($id);

            $dataArr['url_to_products_img'] = $this->_urlToProductsImg . $id . SD;
            $dataArr['all_langs'] = Core::app()->getConfig()->getConfigItem('all_langs');
            $dataArr['lang_site_default'] = $settings['lang_site_default'];
            $dataArr['root'] = 'Без категории';
            $dataArr['form_action'] = '/admin/shop/products/update/';

            $dataArr['path'] = '';
            $dataArr['name_module'] = 'shop';
            $dataArr['file_content_view'] = 'admin_product_create.php';
            $dataArr['return'] = true;

            Core::app()->getEvent()->startEvent('shop_before_product_edite', array(&$dataArr));

            //$this->echoPre($dataArr, false, true);

            $content = Core::app()->getTemplate()->moduleContentView($dataArr);

            Core::app()->getTemplate()->setVar('title_page', 'Создание товара');
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

    private function getDefaultProductData($dataArr)
    {
        if (is_array($dataArr))
        {
            $date = Date('H:i:s d-m-Y');

            if (isset($dataArr['hit']))
            {
                $dataArr['hit'] = 1;
            }
            else
            {
                $dataArr['hit'] = 0;
            }

            if (isset($dataArr['is_active']))
            {
                $dataArr['is_active'] = 1;
            }
            else
            {
                $dataArr['is_active'] = 0;
            }

            if (isset($dataArr['on_order']))
            {
                $dataArr['on_order'] = 1;
            }
            else
            {
                $dataArr['on_order'] = 0;
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