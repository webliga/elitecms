<?php

/**
 * Класс отвечающий за безопасность
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class Secure extends Base
{

    function __construct()
    {
        // echo 'Secure__construct()<br>';
    }

    function __destruct()
    {
        
    }

    /**
     * Проверяет урл на валидность. Возвращает масив с разбитым урлом по модулям,
     * контроллере, екшине и языку
     * 
     * @param url
     */
    public function validate_url($url)
    {
        return $url;
    }
    
    public function checkGetPost($dataArr)
    {
        $arr = array();
        
        foreach ($dataArr as $key => $value)
        {
            $key = mb_strtolower($key);
            
            if($key == 'id')
            {
                $value = (int)$value;
            }

            //  тут проверка стандартных переменных 
            // например проверяем id, является ли оно числом
            // так как мы заранее знаем что оно должно быть только числом
            // иначе мы его просто не запишем или вызовем ошибку
            $arr[$key] = $value;
            
        }

        return $arr;
    }    
    
    public function checkInt($int)
    {
        return preg_match("/[0-9]+/", $int);
    }
    
    public function checkEmail($email)
    {
        return preg_match("/@/", $email);
    }
    
    public function checkString($string)
    {
        return preg_match("/^[A-Za-zА-Яа-я]+$/", $string);
    } 
    
    public function checkPassword($password)
    {
        return preg_match("/^[A-Za-zА-Яа-я0-9]+$/", $password);
    }     
}

?>