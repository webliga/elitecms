<div class="mod_create">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Название модуля:</label>
        <div class="controls">
            <input type="hidden" name="id_module" value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
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
                
                if(isset($dataArr['create']) && $dataArr['create'])
                {
                    echo 'disabled';
                }
                ?>> Активный модуль
            </label>
        </div>
    
    <div class="control-group">
        <label class="control-label" for="inputEmail">Системное название модуля:</label>
        <div class="controls">
            <select <?php if(isset($dataArr['id'])) echo 'disabled';   ?> class="form-control" name="name_system">
                <?php
                $selected = '';
                for ($i = 0; $i < count($dataArr['all_modules']); $i++)
                {
                    if ($dataArr['all_modules'][$i]['id'] == $dataArr['id'])
                    {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $dataArr['all_modules'][$i]['name_system'] . '">' . $dataArr['all_modules'][$i]['name_system'] . '</option>';
                    $selected = '';
                }
                ?>
            </select>
        </div>
    </div> 

    <div class="control-group">
        <label class="control-label" for="inputPassword">Описание:</label>
        <div class="controls">
            <textarea name="description"  class="form-control"><?php if (isset($dataArr['description'])) echo $dataArr['description']; ?></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputPassword">Позиция:</label>
        <div class="controls">
            <select class="form-control" name="id_position">
                <?php
                $selected = '';
                for ($i = 0; $i < count($dataArr['all_positions']); $i++)
                {
                    if ($dataArr['all_positions'][$i]['id'] == $dataArr['id_position'])
                    {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $dataArr['all_positions'][$i]['id'] . '">' . $dataArr['all_positions'][$i]['name'] . '</option>';
                    $selected = '';
                }
                ?>
            </select>
        </div>
    </div>       
</div>

