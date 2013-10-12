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

}

?>
