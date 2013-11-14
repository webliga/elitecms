<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_user_register extends Controller
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

        $content = 'А тут все пользователи';


        Core::app()->getTemplate()->setVar('title_page', 'Список Пользователей');

        Core::app()->getTemplate()->setVar('content', $content);
    }

    // Загружаем этот метод только для вывода в позиции модуля
    public function showDataByPosition($dataArr = null)
    {

    }

    public function create()
    {
        $post = Core::app()->getRequest()->getPost();

        $get = Core::app()->getRequest()->getGet();
        $this->loadModel('register', 'user');

        if (!$this->isEmpty($post))
        {
            unset($post['confirm_password']);

            $dataArr = $this->getDefaultUserData($post);


            $this->M_user_register->setUser($dataArr);

            $url = Core::app()->getHtml()->createUrl('');
            Core::app()->getRequest()->redirect($url, true, 302);
        }
        else
        {
            $dataArr = array();

            $dataArr['id'] = 0;
            $dataArr['form_action'] = 'register/create/';
            $dataArr['path'] = '';
            $dataArr['name_module'] = 'user'; // папка где брать файл
            $dataArr['file_content_view'] = 'mod_user_create.php';
            $dataArr['return'] = true;

            $dataArr['content'] = Core::app()->getTemplate()->moduleContentView($dataArr);
            $content = Core::app()->getTemplate()->getWidget('form', $dataArr);

            Core::app()->getTemplate()->setVar('title_page', 'Регистрация пользователя');
            Core::app()->getTemplate()->setVar('content', $content);
        }
    }

    public function delete()
    {

    }

    public function edite()
    {
        $this->loadModel('M_main', $this->getNameModule());
        $this->loadModel('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница редактирования новости. Отображается форма редактирования');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {
            $content = '';

            $this->loadModel('status', $this->getNameModule());
            $this->loadModel('main', $this->getNameModule());

            $dataArr['input'] = 'form_input';


            $dataOptionArr = $this->M_crm_status->getAllStatuses();
            $setting = $this->M_crm_main->getCrmSettingsByModuleId($dataArr['id']);


            //$this->echoPre($dataOptionArr);
            //$this->echoPre($setting);

            $dataArr['select'] = 'form_select';
            $dataArr['select_name'] = 'id_status_work';
            $dataArr['select_lable'] = 'Статус работы по умолчанию';
            $dataArr['option_value_selected'] = $setting['id_status_work']; // Существующий родительский пункт

            $y = 0;

            $dataArr['select_data'][$y]['option_value'] = 0;
            $dataArr['select_data'][$y]['option_text'] = 'Открытая';
            $y++;

            // Формируем текущий список родительских пунктов меню
            for ($i = 0; $i < count($dataOptionArr); $i++)
            {
                $dataArr['select_data'][$y]['option_value'] = $dataOptionArr[$i]['id'];
                $dataArr['select_data'][$y]['option_text'] = $dataOptionArr[$i]['name'];
                $y++;
            }

            $content .= Core::app()->getHtml()->createSelect($dataArr);
            /*
              $dataArr['input_name'] = 'count_elements';
              $dataArr['input_value'] = $dataArr['count_elements'];
              $dataArr['input_lable'] = 'К-ство элементов';
              $content .= Core::app()->getHtml()->createInput($dataArr);
             */
            return $content;
        }
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
        $this->loadModel('main', $this->getNameModule());

        $result = $this->M_crm_main->updateCrmSettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModel('main', $this->getNameModule());

        $result = $this->M_crm_main->deleteCrmSettingsByModuleId($id);
    }

}

?>