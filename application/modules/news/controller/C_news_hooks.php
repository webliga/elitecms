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
class C_news_hooks extends Controller
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

    public function hook_category_index($dataArr = null)
    {
        if ($dataArr != null)
        {
            $cat_id = $dataArr[0];
            $limit = $dataArr[1];
            
            $modelNewsItems = $this->loadModel('newsitems', 'news', true);
            $dataArr['news_items'] = $modelNewsItems->getAllNewsItemsByCategory($cat_id, $limit);

            $dataArr['title'] = '';
            
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'news';
            $dataArr['file_content_view'] = 'mod_news_list_by_cat.php';
            $dataArr['return'] = true;
            //$this->echoPre($dataArr);
            $dataArr[2] .= Core::app()->getTemplate()->moduleContentView($dataArr, false);
            Core::app()->getTemplate()->setVar('title_page', 'Новости');
        }
    }

    //put your code here
}

?>
