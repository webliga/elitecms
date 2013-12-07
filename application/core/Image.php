<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author Веталь
 */
class Image extends Base
{

    private $_whiteList;

    //put your code here

    function __construct()
    {
        $this->_whiteList['image/jpeg'] = array('jpg', 'jpeg', 'JPG', 'JPEG');
        $this->_whiteList['image/gif'] = array('gif', 'GIF');
        $this->_whiteList['image/png'] = array('png', 'PNG');
    }

    function __destruct()
    {
        
    }

    public function checkGD()
    {
        return gd_info();
    }

    public function getSafeImagesArr($dataArr)
    {
        $safeImgArr = array();

        for ($i = 0; $i < count($dataArr['tmp_name']); $i++)
        {
            $type = $dataArr['type'][$i]; // миметип от пользователя
            if (!$this->isEmpty($type))
            {
                $imageinfo = getimagesize($dataArr['tmp_name'][$i]);
                $mime = $imageinfo['mime']; // миметип с папки tmp
                // Если миметип который пришел от пользователя есть в белом списке
                // И если , который мы самы проверяем с папки tmp есть в нашем белом списке
                // И если тот что пришел и тот что с папки tmp равны- значит хорошее изображение
                if (isset($this->_whiteList[$type]) && isset($this->_whiteList[$mime]) && ($type == $mime))
                {
                    $name = $dataArr['name'][$i]; // имя файла от пользователя

                    if ($this->checkExt($name, $this->_whiteList[$mime]))
                    {
                        $safeImgArr[] = $this->getSafeImageData($dataArr, $i);
                    }
                }
            }
        }

        return $safeImgArr;
    }

    private function checkExt($name, $extArr)
    {
        $arr = explode('.', $name);
        // Проверяем, если у нас "расширений" одно (разобьет на две части)
        if (count($arr) == 2)
        {
            // Пробегаемся по расширениям из белого списка
            for ($i = 0; $i < count($extArr); $i++)
            {
                // Сверяем расширения из белого спика с тем что к нам пришло
                if ($arr[1] == $extArr[$i])
                {
                    return true;
                }
            }
        }

        return false;
    }

    private function getSafeImageData($dataArr, $i)
    {
        $imgArr = array();
        foreach ($dataArr as $key => $value)
        {
            // Формируем масив с данными нужного изображения
            $imgArr[$key] = $value[$i];
        }

        return $imgArr;
    }

    public function saveImg($file)
    {
        if (is_uploaded_file($file['tmp_name']))
        {
            $pathToSave = $file['path_to_save'] . $file['name'];

            if (!is_dir($file['path_to_save']))
            {
                mkdir($file['path_to_save'], 0777, true);
            }

            if (move_uploaded_file($file['tmp_name'], $pathToSave))
            {
                return true;
            }
        }

        return false;
    }

    public function deleteImg($file)
    {
        if (is_uploaded_file($file['tmp_name']))
        {
            $pathToSave = $file['path_to_save'] . $file['name'];

            if (!is_dir($file['path_to_save']))
            {
                mkdir($file['path_to_save'], 0777, true);
            }

            if (move_uploaded_file($file['tmp_name'], $pathToSave))
            {
                return true;
            }
        }

        return false;
    }
}

?>
