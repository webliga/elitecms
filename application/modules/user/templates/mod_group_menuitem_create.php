<div class="mod_create">
    <div class="both"></div>
    <div class="control-group news-select">
        <label class="control-label" for="inputPassword">Показывать для групп:</label>
        <div class="controls">
            <?php
            for ($i = 0; $i < count($dataArr['all_groups']); $i++)
            {
                $lang = $dataArr['all_groups'][$i];
                $checked = '';
                
                if(isset($lang['is_active']) && $lang['is_active'] == 1)
                {
                    $checked = 'checked';
                }
                echo '<input name="groups[' . $lang['id'] . ']" type="checkbox" ' . $checked . ' />' . $lang['name'] . ' <br>';
            }
            ?>
        </div>
    </div>
    <div class="both"></div>
</div>
<div class="both"></div>

