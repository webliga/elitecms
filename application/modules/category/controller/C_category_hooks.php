<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of C_category_hooks
 *
 * @author Веталь
 */
class C_category_hooks extends Base
{

    //put your code here


    public function hook_get_all_category($hookDataArr = null)
    {
        if ($hookDataArr != null)
        {
            $modelCategoryMain = $this->loadModel('categoryitems', 'category', true);
            $dataOptionArr = $modelCategoryMain->getAllCategoryItems();
            $categoryMain = $this->loadController('main', 'category', true);

            $root['id'] = 0;
            $root['id_parent'] = -1;
            $root['name'] = 'Корень';
            $dataOptionArr[] = $root;

            $dataOptionArr = $categoryMain->buildTree($dataOptionArr);

            $dataArr['name_select'] = 'id_categories';
            $dataArr['multiple'] = true;            
            $dataArr['id_parent'] = 0;   //          
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'category';
            $dataArr['file_content_view'] = 'create_treeview_select.php';
            $dataArr['return'] = true;
            
            $dataArr['select_all_items'] = $dataOptionArr;
            $content = Core::app()->getTemplate()->moduleContentView($dataArr);
            
            //$this->echoPre($content, false, true);
            $hookDataArr[0]['all_categories'] = $content;
        }
    }

}

?>
