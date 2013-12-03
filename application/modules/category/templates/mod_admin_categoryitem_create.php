<div class="mod_create">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Имя категории:</label>
        <div class="controls">
            <input type="hidden" name="id" value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
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
            ?>> Активная категория
        </label>
    </div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Описание:</label>
        <div class="controls">
            <textarea name="description"  class="form-control"><?php if (isset($dataArr['description'])) echo $dataArr['description']; ?></textarea>
        </div>
    </div>  

    <div class="control-group">
        <label class="control-label" for="inputPassword">картинка:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['img'])) echo $dataArr['img']; ?>" name="img">
        </div>
    </div>

        <div class="control-group">
        <label class="control-label" for="inputPassword">Модуль категории:</label>
        <div class="controls">
            <select class="form-control" name="id_module" id="id_module">
                <?php
                $selected = '';
                for ($i = 0; $i < count($dataArr['all_category_modules']); $i++)
                {
                    if ($dataArr['all_category_modules'][$i]['id'] == $dataArr['id_module'])
                    {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $dataArr['all_category_modules'][$i]['id'] . '">' . $dataArr['all_category_modules'][$i]['name'] . '</option>';
                    $selected = '';
                }
                ?>
            </select>
        </div>
    </div>
    
    
    <div class="control-group">
        <label class="control-label" for="inputPassword">Родительская категори</label>
        <div class="controls">
            <select class="form-control" name="id_parent" id="id_module">
                <?php
                $dataArr['path'] = '';
                $dataArr['return'] = false;
                $dataArr['file_content_view'] = 'create_treeview_options.php'; 
                $dataArr['options'] = $dataArr['select_all_items'];
                $dataArr['id_current'] = $dataArr['id'];
                $dataArr['space'] = '';
                Core::app()->getTemplate()->moduleContentView($dataArr, false);

                ?>
            </select>
            
            
        </div>
    </div>
    
</div>