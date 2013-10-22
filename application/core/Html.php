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
    
    public function createInput($dataArr)
    {
        if(!isset($dataArr['input']) || $this->isEmpty($dataArr['input']))
        {
            $dataArr['input'] = 'form_input';
        }
        
        
        $content = Core::app()->getTemplate()->getWidget($dataArr['input'],$dataArr, null);
        
        return $content;
    }
        
    public function createSelect($dataArr)
    {
        if(!isset($dataArr['select']) || $this->isEmpty($dataArr['select']))
        {
            $dataArr['select'] = 'form_select';
        }
        
        
        $content = Core::app()->getTemplate()->getWidget($dataArr['select'],$dataArr, null);
        
        return $content;
    }
}

?>
