<div class="control-group">
    <label class="control-label" for="inputEmail"><?php if (isset($dataArr['input_lable'])) echo $dataArr['input_lable']; ?>:</label>
    <div class="controls">

        <?php
        $input_type = 'text';
        $input_checked = '';
        $input_value = '';
        $input_name = ''; 
        
        if (isset($dataArr['input_type']))
        {
            $input_type = $dataArr['input_type'];
        }
        if (isset($dataArr['input_checked']))
        {
            $input_checked = $dataArr['input_checked'];
        }
        if (isset($dataArr['input_value']))
        {
            $input_value = $dataArr['input_value'];
        }
        if (isset($dataArr['input_name']))
        {
            $input_name =  $dataArr['input_name'];
        }
            
        ?>

        <input  name="<?= $input_name; ?>" type="<?= $input_type; ?>"  class="form-control" value="<?= $input_value; ?>"  <?= $input_checked; ?>>

    </div>
</div>
