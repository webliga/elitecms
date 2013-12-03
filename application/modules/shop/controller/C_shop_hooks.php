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
class C_shop_hooks extends Controller
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
            $dataArr[2] .= 'А это уже выводятся товары';
        }
    }

    //put your code here
}

?>
