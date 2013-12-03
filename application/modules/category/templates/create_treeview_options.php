<?php

$selected = '';


for ($i = 0; $i < count($dataArr['options']); $i++)
{
    $item = $dataArr['options'][$i];
    $space = $dataArr['space'];

    if ($item['id'] == $dataArr['id_parent'])
    {
        $selected = 'selected';
    }
    echo '<option ' . $selected . ' value="' . $item['id'] . '">' . $space . $item['name'] . '</option>';
    $selected = '';


    // если есть подкатегории, то выводи их
    if ($item['children'] != null && is_array($item['children']))
    {
        $optionArr = $dataArr;
        $optionArr['space'] .= "-";
        $optionArr['options'] = $item['children'];
        Core::app()->getTemplate()->moduleContentView($optionArr);
    }
}
?>
