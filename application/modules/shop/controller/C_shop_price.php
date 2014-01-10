<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of C_news_hooks
 *
 * @author Веталь
 */
class C_shop_price extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    public function index($dataArr = null)
    {
        $content = 'www';

        $mShopPrice = $this->loadModel('price', 'shop', true);
        $allPrices = $mShopPrice->getAllPrices();
        $settings = Core::app()->getConfig()->getConfigItem('settings');
        $lang_site_default = $settings['lang_site_default'];

        for ($i = 0; $i < count($allPrices); $i++)
        {
            $priceContentArr = $allPrices[$i]['price_content'];
            // ищем наш язык для построения списка цен
            for ($y = 0; $y < count($priceContentArr); $y++)
            {
                $dataPriceArr[$y]['id'] = $priceContentArr[$y]['id'];
                $dataPriceArr[$y]['title'] = $priceContentArr[$y]['title'];
            }
        }


        $dataPriceArr['link_edite'] = '/admin/shop/price/edite/';
        $dataPriceArr['link_delete'] = '/admin/shop/price/delete/';
        //$this->echoPre($dataArr['link_edite']);
        $content = Core::app()->getTemplate()->getWidget('data_table', $dataPriceArr);

        //$this->echoPre($allPrices, false, true);

        Core::app()->getTemplate()->setVar('title_page', 'Цены товара');
        Core::app()->getTemplate()->setVar('content', $content);

        return 'index.tpl.php';
    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();
        $files = Core::app()->getRequest()->getFile();
        $img = Core::app()->getImage();


        if (!$this->isEmpty($post))
        {$this->echoPre($post, false, true);
            Core::app()->getEvent()->startEvent('shop_before_price_create', array(&$post, &$files));


            $modelProduct = $this->loadModel('main', 'shop', true);
            $imagesData = $files['images'];


            $safeImgArr = $img->getSafeImagesArr($imagesData);

            $productData = $post['shop_products'];
            $id_product = $modelProduct->insertProduct($productData);
            $id_main_img = 0;

            for ($i = 0; $i < count($safeImgArr); $i++)
            {
                $file = $safeImgArr[$i];
                $file['path_to_dir_save'] = $this->_pathToProductsDirImg . $id_product . SD;

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

            $mShopPrice = $this->loadModel("price", "shop", true);
            $settings = Core::app()->getConfig()->getConfigItem('settings');


            $dataPriceArr['all_langs'] = Core::app()->getConfig()->getConfigItem('all_langs');
            $dataPriceArr['all_prices'] = $mShopPrice->getAllPrices();
            $dataPriceArr['lang_site_default'] = $settings['lang_site_default'];
            $dataPriceArr['form_action'] = '/admin/shop/price/create/';
            
            $dataPriceArr['path'] = '';
            $dataPriceArr['name_module'] = 'shop';
            $dataPriceArr['file_content_view'] = 'admin_price_settings.php';
            $dataPriceArr['return'] = true;

            Core::app()->getEvent()->startEvent('shop_before_price_create_empty', array(&$dataArr));

            //$this->echoPre($dataPriceArr, false, true);

            $content = Core::app()->getTemplate()->moduleContentView($dataPriceArr);

            Core::app()->getTemplate()->setVar('title_page', 'Создание цены товара');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function showDataByPosition($dataArr = null)
    {
        
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function updateModuleFormFildsConfig($dataArr)
    {
        
    }

    public function deleteModuleDataById($dataArr)
    {
        
    }

    public function getAdminTabContentShopPriceSettings($dataArr = null)
    {
        $content = '1111';

        $mShopPrice = $this->loadModel("price", "shop", true);
        $settings = Core::app()->getConfig()->getConfigItem('settings');


        $dataPriceArr['all_langs'] = Core::app()->getConfig()->getConfigItem('all_langs');
        $dataPriceArr['all_prices'] = $mShopPrice->getAllPrices();
        $dataPriceArr['lang_site_default'] = $settings['lang_site_default'];

        $dataPriceArr['path'] = '';
        $dataPriceArr['name_module'] = 'shop';
        $dataPriceArr['file_content_view'] = 'admin_price_settings.php';
        $dataPriceArr['return'] = true;

        $this->echoPre($dataPriceArr, false, true);

        $content = Core::app()->getTemplate()->moduleContentView($dataPriceArr);

        return $content;
    }

    //put your code here
}

?>
