<div class="mod_create">
    <div class="both"></div>
    <div class="control-group news-select">
        <label class="control-label" for="inputPassword">Показывать для групп:</label>
        <div class="controls">
            <?php
            for ($i = 0; $i < count($dataArr['all_groups']); $i++)
            {
                $item = $dataArr['all_groups'][$i];
                $checked = '';
                
                if(isset($item['is_active']) && $item['is_active'] == 1)
                {
                    $checked = 'checked';
                }
                echo '<input name="groups[' . $item['id'] . ']" type="checkbox" ' . $checked . ' />' . $item['name'] . ' <br>';
            }
            ?>
        </div>
    </div>
    <div class="both"></div>
</div>
<div class="both"></div>

