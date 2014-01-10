<div class="mod_create">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Имя группы:</label>
        <div class="controls">
            <input name="id"  type="hidden"value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
            <input  name="name" type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>">
        </div>
    </div>
    <div class="both"></div>
    <div class="control-group news-select">
        <label class="control-label" for="inputPassword">Унаследовать права от группы:</label>
        <div class="controls">
            <select name="id_parent" class="form-control" id="id_parent">
                <?php
                $selected = '';

                If ($dataArr['id_parent'] == 0)
                {
                    $selected = 'selected';
                }

                $options = '<option ' . $selected . ' value="0">' . $dataArr['root'] . '</option>';
                $selected = '';

                for ($i = 0; $i < count($dataArr['all_groups']); $i++)
                {
                    $lang = $dataArr['all_groups'][$i];

                    if($dataArr['id'] != $lang['id'])
                    {
                        if ($lang['id'] == $dataArr['id_parent'])
                        {
                            $selected = 'selected';
                        }
                        $options .= '<option ' . $selected . ' value="' . $lang['id'] . '">' . $lang['name'] . '</option>';
                        $selected = '';
                    }
                }

                echo $options;
                ?>
            </select>
        </div>
    </div>
    <div class="both"></div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Описание:</label>
        <div class="controls">
            <textarea name="description"  class="form-control"><?php if (isset($dataArr['description'])) echo $dataArr['description']; ?></textarea>
        </div>
    </div>
</div>
<div class="both"></div>
<?= $dataArr['access']; ?>
