<div class="mod_create">
    <form class="form-horizontal" action="<?php echo Core::app()->getHtml()->createUrl($dataArr['form_action']); ?>" method="post">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Название модуля:</label>
            <div class="controls">
                <input type="hidden" name="id_module" value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
                <input type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Системное название модуля:</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php if (isset($dataArr['name_system'])) echo $dataArr['name_system']; ?>" name="name_system">
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="inputPassword">Файл отображения:</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php if (isset($dataArr['template_file'])) echo $dataArr['template_file']; ?>" name="template_file">
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


        <div class="control-group">
            <div class="controls">
                <label class="checkbox">

                </label>
                <button type="submit" class="btn btn-default">Обновить</button>
            </div>
        </div>
    </form>
</div>