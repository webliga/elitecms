<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Html
 *
 * @author Веталь
 */
class Html extends Base
{
    
    public function createUrl($url)
    {
        $url = '/ru/' . $url;
        
        return $url;
    }
    
    public function createBtn($form_action,$img , $id_hidden = null, $name_hidden = null)
    {
        $dataArr['form_action'] = $form_action;
        $dataArr['img'] = $img;  
        $dataArr['id_hidden'] = $id_hidden;        
        $dataArr['name_hidden'] = $name_hidden;               
        
        $btn = Core::app()->getTemplate()->getWidget('btn_panel', $dataArr, null);
        
        return $btn;
    }
}

?>
