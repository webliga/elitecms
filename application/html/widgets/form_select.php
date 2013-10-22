    <div class="control-group">
        <label class="control-label" for="inputPassword"><?php  echo $dataArr['select_lable'];  ?></label>
        <div class="controls">
            <select class="form-control" name="<?php  echo $dataArr['select_name'];  ?>" id="<?php  echo $dataArr['select_name'];  ?>">
                <?php
                $selected = '';
                for ($i = 0; $i < count($dataArr['select_data']); $i++)
                {
                    if ($dataArr['select_data'][$i]['option_value'] == $dataArr['option_value_selected'])
                    {
                        $selected = 'selected';
                    }
                    echo '<option ' . $selected . ' value="' . $dataArr['select_data'][$i]['option_value'] . '">' . $dataArr['select_data'][$i]['option_text'] . '</option>';
                    $selected = '';
                }
                ?>
            </select>
        </div>
    </div>
