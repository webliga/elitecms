<div class="mod_create">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Текст пункта меню:</label>
            <div class="controls">
                <input type="hidden" name="id" value="<?php if(isset($dataArr['id'])) echo $dataArr['id']; ?>">
                <input type="text"  class="form-control" value="<?php if(isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Путь (без слеша спереди):</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php if(isset($dataArr['link'])) echo $dataArr['link'];?>" name="link">
            </div>
        </div>  

        <div class="control-group">
            <label class="control-label" for="inputPassword">Текст при наведении:</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php  if(isset($dataArr['title'])) echo $dataArr['title'];?>" name="title">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputPassword">Модуль меню:</label>
            <div class="controls">
                <select class="form-control" name="id_module">
                    <?php
                    $selected = '';
                    for ($i = 0; $i < count($dataArr['all_menu_moduless']); $i++)
                    {
                        if ($dataArr['all_menu_moduless'][$i]['id'] == $dataArr['id_module'])
                        {
                            $selected = 'selected';
                        }
                        echo '<option ' . $selected . ' value="' . $dataArr['all_menu_moduless'][$i]['id'] . '">' . $dataArr['all_menu_moduless'][$i]['name'] . '</option>';
                        $selected = '';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_active"  <?php
                if (isset($dataArr['is_active']) && $dataArr['is_active'])
                {
                    echo 'checked';
                }
                else
                {
                    '';
                }
                ?>> Активное
            </label>
        </div>
</div>