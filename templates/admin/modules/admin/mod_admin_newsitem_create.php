<div class="mod_news_create">
    <div class="control-group  input-news">
        <label class="control-label" for="inputEmail">Заголовок:</label>
        <div class="controls">
            <input type="hidden" name="id" value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
        </div>
    </div>
    <div class="control-group datapicker">
        <label class="control-label" for="inputPassword">Дата создания:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['date_create'])) echo $dataArr['date_create']; ?>" name="date_create">
        </div>
    </div>
    <div class="both"></div>

        <div class="panel panel-success checkbox-group">
            <div class="panel-heading">Настройка показа элементов</div>
            <div class="panel-body">

                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="show"  <?php
                        if (isset($dataArr['show']) && $dataArr['show'])
                        {
                            echo 'checked';
                        }
                        else
                        {
                            '';
                        }
                        ?>> Публиковать
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="show_title"  <?php
                        if (isset($dataArr['show_title']) && $dataArr['show_title'])
                        {
                            echo 'checked';
                        }
                        else
                        {
                            '';
                        }
                        ?>> Показывать заголовок
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="show_preview"  <?php
                        if (isset($dataArr['show_preview']) && $dataArr['show_preview'])
                        {
                            echo 'checked';
                        }
                        else
                        {
                            '';
                        }
                        ?>> Показывать анонс
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="show_img"  <?php
                        if (isset($dataArr['show_img']) && $dataArr['show_img'])
                        {
                            echo 'checked';
                        }
                        else
                        {
                            '';
                        }
                        ?>> Показывать картинку
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="show_date"  <?php
                        if (isset($dataArr['show_date']) && $dataArr['show_date'])
                        {
                            echo 'checked';
                        }
                        else
                        {
                            '';
                        }
                        ?>> Показывать дату
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="show_author"  <?php
                        if (isset($dataArr['show_author']) && $dataArr['show_author'])
                        {
                            echo 'checked';
                        }
                        else
                        {
                            '';
                        }
                        ?>> Показывать автора
                    </label>
                </div>

            </div>
        </div>
    <div class="both"></div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Анонс:</label>
        <div class="controls">
            <textarea name="preview"  class="form-control"><?php if (isset($dataArr['preview'])) echo $dataArr['preview']; ?></textarea>
        </div>
    </div>
    <div class="both"></div>
    <div class="control-group ">
        <label class="control-label" for="inputPassword">Основной текст:</label>
        <div class="controls">
            <textarea row="100" name="text"  class="form-control textarea-text"><?php if (isset($dataArr['text'])) echo $dataArr['text']; ?></textarea>
        </div>
    </div>
    <div class="both"></div>
    <div class="control-group input-news">
        <label class="control-label" for="inputEmail">Источник статьи / новости (ссылка):</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php
            if (isset($dataArr['from_source']) && !$this->isEmpty($dataArr['from_source']))
            {
                echo $dataArr['from_source'];
            }
            else
            {
                echo 'http://';
            }
            ?>" name="from_source">
        </div>
    </div>  
    <div class="both"></div>

    <div class="both"></div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Модуль меню:</label>
        <div class="controls">
            <select class="form-control" name="id_module" id="id_module">
                <?php
                $selected = '';
                for ($i = 0; $i < count($dataArr['all_menu_modules']); $i++)
                {
                    if ($dataArr['all_menu_modules'][$i]['id'] == $dataArr['id_module'])
                    {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $dataArr['all_menu_modules'][$i]['id'] . '">' . $dataArr['all_menu_modules'][$i]['name'] . '</option>';
                    $selected = '';
                }
                ?>
            </select>
        </div>
    </div>

</div>

<script>
    CKEDITOR.replace('preview', {
        toolbar: 'Basic',
        height: '100',
    });
    CKEDITOR.replace('text', {
        height: '300',
    });
</script>

<div class="both"></div>