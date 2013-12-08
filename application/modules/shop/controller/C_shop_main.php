<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_shop_main extends Controller
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
    public function index($params = null)
    {
        
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        
    }

    public function create()
    {
        
    }

    public function edite()
    {
        
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {
            $content = '';

            $modelShop = $this->loadModel('main', null, true);

            $dataArr = $modelShop->getShopSettingsByModuleId($dataArr['id']);
            //$this->echoPre($dataArr);

            $dataArr = $this->getDefaultShopData($dataArr);


            $dataArr['input'] = 'form_input';


            $dataArr['input_name'] = 'template_product_list';
            $dataArr['input_value'] = $dataArr['template_product_list'];
            $dataArr['input_lable'] = 'Файл отображения списка товаров';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'template_product_detail';
            $dataArr['input_value'] = $dataArr['template_product_detail'];
            $dataArr['input_lable'] = 'Файл отображения товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_width_big';
            $dataArr['input_value'] = $dataArr['img_width_big'];
            $dataArr['input_lable'] = 'Ширина большой картинки товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_height_big';
            $dataArr['input_value'] = $dataArr['img_height_big'];
            $dataArr['input_lable'] = 'Высота большой картинки товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_width_medium';
            $dataArr['input_value'] = $dataArr['img_width_medium'];
            $dataArr['input_lable'] = 'Ширина средней картинки товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_height_medium';
            $dataArr['input_value'] = $dataArr['img_height_medium'];
            $dataArr['input_lable'] = 'Высота средней картинки товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_width_small';
            $dataArr['input_value'] = $dataArr['img_width_small'];
            $dataArr['input_lable'] = 'Ширина Маленькой картинки товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'img_height_small';
            $dataArr['input_value'] = $dataArr['img_height_small'];
            $dataArr['input_lable'] = 'Высота маленькой картинки товара';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'create_canvas';
            $dataArr['input_value'] = 1;
            $dataArr['input_type'] = 'checkbox';
            $dataArr['input_checked'] = $dataArr['create_canvas'] ? 'checked' : '';
            $dataArr['input_lable'] = 'Создавать белую подложку при маленьком изображении?';

            $content .= Core::app()->getHtml()->createInput($dataArr);


            return $content;
        }
    }

    private function getDefaultShopData($dataArr)
    {
        if (is_array($dataArr))
        {
            if (!isset($dataArr['template_product_list']) || $this->isEmpty($dataArr['template_product_list']))
            {
                $dataArr['template_product_list'] = 'mod_products_list.php';
            }

            if (!isset($dataArr['template_product_detail']) || $this->isEmpty($dataArr['template_product_detail']))
            {
                $dataArr['template_product_detail'] = 'mod_products_detail.php';
            }

            if (!isset($dataArr['img_width_big']) || $this->isEmpty($dataArr['img_width_big']))
            {
                $dataArr['img_width_big'] = '580';
            }

            if (!isset($dataArr['img_height_big']) || $this->isEmpty($dataArr['img_height_big']))
            {
                $dataArr['img_height_big'] = '580';
            }

            if (!isset($dataArr['img_width_medium']) || $this->isEmpty($dataArr['img_width_medium']))
            {
                $dataArr['img_width_medium'] = '280';
            }

            if (!isset($dataArr['img_height_medium']) || $this->isEmpty($dataArr['img_height_medium']))
            {
                $dataArr['img_height_medium'] = '280';
            }

            if (!isset($dataArr['img_width_small']) || $this->isEmpty($dataArr['img_width_small']))
            {
                $dataArr['img_width_small'] = '80';
            }

            if (!isset($dataArr['img_height_small']) || $this->isEmpty($dataArr['img_height_small']))
            {
                $dataArr['img_height_small'] = '80';
            }

            if (!isset($dataArr['create_canvas']) || $this->isEmpty($dataArr['create_canvas']))
            {
                $dataArr['create_canvas'] = '0';
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        $modelShop = $this->loadModel('main', null, true);
        if (!isset($dataArr['create_canvas']) || $this->isEmpty($dataArr['create_canvas']))
        {
            $dataArr['create_canvas'] = '0';
        }

        //$this->echoPre($dataArr, false, true);
        $result = $modelShop->updateShopSettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModel('main', $this->getNameModule());

        $result = $this->M_news_main->deleteNewsSettingsByModuleId($id);
    }

}

?>