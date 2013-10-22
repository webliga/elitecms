<div class="control-group">
    <label class="control-label" for="inputEmail"><?php if (isset($dataArr['input_lable'])) echo $dataArr['input_lable']; ?>:</label>
    <div class="controls">
        <input type="text"  class="form-control" value="<?php if (isset($dataArr['input_value'])) echo $dataArr['input_value']; ?>"  name="<?php if (isset($dataArr['input_name'])) echo $dataArr['input_name']; ?>">
    </div>
</div>
