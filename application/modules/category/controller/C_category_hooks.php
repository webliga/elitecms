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
            $dataArr['id_parent'] = 0;   //   Если одиночный селект и у него нету родителя, то ставим родителем корень
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'category';
            $dataArr['file_content_view'] = 'create_treeview_select.php';
            $dataArr['return'] = true;
            
            $dataArr['select_all_items'] = $dataOptionArr;
            
            if(isset($hookDataArr[0]['selected_category']) && is_array($hookDataArr[0]['selected_category']) && count($hookDataArr[0]['selected_category']) > 0)
            {
                $dataArr['selected_category'] = $hookDataArr[0]['selected_category'];
            }
            
            
            //$this->echoPre($dataArr, false, true);
            
            $content = Core::app()->getTemplate()->moduleContentView($dataArr);
            //$this->echoPre($hookDataArr, false, true);
            //$this->echoPre($content, false, true);
            $hookDataArr[0]['all_categories'] = $content;
        }
    }

}

?>
