<?php
$multiple = '';

if (isset($dataArr['multiple']) && $dataArr['multiple'])
{
    $multiple = 'multiple="multiple"';
}
?>



<select class="form-control" name="<?= $dataArr['name_select'] ?>[]" id="id_module" <?= $multiple; ?>>
    <?php
    $dataArr['path'] = '';
    $dataArr['return'] = false;
    $dataArr['file_content_view'] = 'create_treeview_options.php';
    $dataArr['options'] = $dataArr['select_all_items'];
    $dataArr['space'] = '';
    Core::app()->getTemplate()->moduleContentView($dataArr, false);
    ?>
</select>
