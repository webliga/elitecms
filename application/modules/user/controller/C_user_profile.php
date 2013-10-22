<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_user_profile extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * Действие по умолчанию
     */
    public function index()
    {
        $this->loadModule('M_user_user', $this->getNameModule());
        $this->loadModule('M_main_shop', $this->getNameModule('main'));

        Core::app()->getTemplate()->setVar('content', 'Это контент, который обрабатывается 
            контроллером с адресной строки. Сейчас находимся в user/profile
            
');
        
    }
    
    public function create()
    {
        
    }

        
    public function update()
    {
        
    }
    
        
    public function delete()
    {
        
    }
}

?>