<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_user_auth extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * index вызывается только в одном случаяе
     * 1. через url ($dataArr == null)
     */
    // Загружаем этот метод только из строки браузера
    // $dataArr - get параметры, передаваемые в строке браузера
    public function index($dataArr = null)
    {
        $dataArr = array();

        $dataArr['form_action'] = 'auth/login/';
        $dataArr['path'] = '';
        $dataArr['name_module'] = 'user'; // папка где брать файл
        $dataArr['file_content_view'] = 'mod_user_auth.php';
        $dataArr['return'] = true;

        $dataArr['content'] = Core::app()->getTemplate()->moduleContentView($dataArr);
        $content = Core::app()->getTemplate()->getWidget('form', $dataArr);

        Core::app()->getTemplate()->setVar('title_page', 'Регистрация пользователя');
        Core::app()->getTemplate()->setVar('content', $content);
    }

    public function login()
    {
        $post = Core::app()->getRequest()->getPost();
        $secure = Core::app()->getSecure();
        $user = Core::app()->getUser();

        if ($secure->checkPassword($post['password']) && $secure->checkString($post['login']))
        {
            $this->loadModel('auth');
            $dataArr = $this->M_user_auth->searchUserByLogin($post['login']);

            if ($dataArr != null)
            {
                if (!$user->isAuth())
                {
                    $user->login($dataArr);
                }
            }
            else
            {
                $content = 'Секури прошли и логин не верен';
            }
        }
        else
        {
            $content .= 'Пароль не подошел';
        }

        Core::app()->getTemplate()->setVar('title_page', 'Авторизация пользователя');
        Core::app()->getTemplate()->setVar('content', $content);
    }

    public function logout()
    {
        $user = Core::app()->getUser();


        $user->logout();

        $url = Core::app()->getHtml()->createUrl('auth');
        Core::app()->getRequest()->redirect($url, true, 302);
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {
        
    }

    public function create()
    {
        
    }

    public function delete()
    {
        
    }

    public function edite()
    {
        
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        
    }

    private function getDefaultUserData($dataArr)
    {
        if (is_array($dataArr))
        {
            $date = Date('H:i:s d-m-Y');


            if (isset($dataArr['date_create']) && $this->isEmpty($dataArr['date_create']))
            {
                $dataArr['date_create'] = $date;
            }
            else
            {
                $dataArr['date_create'] = $date;
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        
    }

    public function deleteModuleDataById($dataArr)
    {
        
    }

}

?>