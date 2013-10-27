<?php

/**
 * Главный клас модуля, все запросы по умолчанию отправляются сюда
 * @author Веталь
 * @version 1.0
 * @updated 17-Вер-2013 20:15:13
 */
class C_news_main extends Controller
{

    function __construct()
    {
        parent::__construct();
    }

    function __destruct()
    {
        
    }

    /**
     * index вызывается только в двух случаях
     * 1. через url ($dataArr == null)
     * 2. при выводе в позиции ($dataArr != null)
     */
    public function index($dataArr = null)
    {
        // $dataArr - данные для вызова модуля в позиции

        if ($dataArr != null)
        {// Сделать метод autoLoad()
            // Если есть данные $dataArr модуля
            // Выводим модуль в его позиции, согласно данным $dataArr
            // Если данных нету, значит мы вызвали этот экшн через строку в браузере

            $this->loadModule('M_news_main', $this->getNameModule());

            $settings = $this->M_news_main->getNewsSettingsByModuleId($dataArr['id_module']);

            //Формируем HTML структуру списка новостей
            $dataArr['news_items'] = $this->M_news_main->getNews($settings['count_elements']);

            $dataArr['path'] = '';
            $dataArr['name_module'] = $this->getNameModule();
            $dataArr['file_content_view'] = $settings['template_file'];
            $dataArr['return'] = false;
            //$this->echoPre($dataArr);
            Core::app()->getTemplate()->moduleContentView($dataArr, false);
            //$this->echoPre($dataArr);
        }
        else
        {
            // Если существуют GET данные
            // показываем статью по id
            // Если нету GET данных, значит неправильно набран URL

            $get = Core::app()->getRequest()->getGet();

            if ($get != null)
            {
                $id_news = $get['id'];

                $this->loadModule('M_news_main', 'news');

                $dataArr = $this->M_news_main->getNewsById($id_news);


                $dataArr['path'] = '';
                $dataArr['name_module'] = $this->getNameModule();
                $dataArr['file_content_view'] = 'mod_news_detail.php';
                $dataArr['return'] = true;
                //$this->echoPre($dataArr);
                $content = Core::app()->getTemplate()->moduleContentView($dataArr, false);

                //$this->echoPre($news);

                Core::app()->getTemplate()->setVar('content', $content . 'Главный контент. Сейчас находимся в news/main');
            }
            else
            {
                Core::app()->getTemplate()->setVar('content', 'Не хватает данных');
            }
        }
    }

    public function create()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->getTemplate()->setVar('title_page', 'Страница создания новости. Отображается форма редактирования');
    }

    public function write()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница записи новости. Отображается форма записи');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function edite()
    {
        $this->loadModule('M_main', $this->getNameModule());
        $this->loadModule('M_shop', $this->getNameModule());

        Core::app()->echoEcho('Страница редактирования новости. Отображается форма редактирования');
        //Core::app()->echoEcho('_name_model = ' . $this->mainM_shop->_name_model);
        //Core::app()->echoPre(Core::app()->getConfig()->getDataArrayConfig());
    }

    public function getModuleFormFildsConfig($dataArr = null)
    {
        if ($dataArr != null)
        {
            $content = '';

            $this->loadModule('M_news_main', $this->getNameModule());

            $dataArr = $this->M_news_main->getNewsSettingsByModuleId($dataArr['id']);
            $this->echoPre($dataArr);

            $dataArr = $this->getDefaultNewsData($dataArr);


            $dataArr['input'] = 'form_input';


            $dataArr['input_name'] = 'template_file';
            $dataArr['input_value'] = $dataArr['template_file'];
            $dataArr['input_lable'] = 'Файл отображения списка новостей';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            $dataArr['input_name'] = 'count_elements';
            $dataArr['input_value'] = $dataArr['count_elements'];
            $dataArr['input_lable'] = 'К-ство элементов';
            $content .= Core::app()->getHtml()->createInput($dataArr);

            return $content;
        }
    }

    private function getDefaultNewsData($dataArr)
    {
        if (is_array($dataArr))
        {
            if (!isset($dataArr['count_elements']) || $this->isEmpty($dataArr['template_file']))
            {
                $dataArr['template_file'] = '';
            }

            if (!isset($dataArr['count_elements']) || $this->isEmpty($dataArr['count_elements']))
            {
                $dataArr['count_elements'] = 20;
            }
        }


        return $dataArr;
    }

    public function updateModuleFormFildsConfig($dataArr = null)
    {
        $this->loadModule('M_news_main', $this->getNameModule());

        $result = $this->M_news_main->updateNewsSettingsByModuleId($dataArr);
    }

    public function deleteModuleDataById($dataArr)
    {
        $id = $dataArr['id'];
        $this->loadModule('M_news_main', $this->getNameModule());

        $result = $this->M_news_main->deleteNewsSettingsByModuleId($id);
    }

}

?>