<?php

$selected = '';

for ($i = 0; $i < count($dataArr['options']); $i++)
{
    $item = $dataArr['options'][$i];
    $space = $dataArr['space'];
    
    // Если есть список выбранных категорий 
    if(isset($dataArr['selected_category']) && is_array($dataArr['selected_category']) && count($dataArr['selected_category']) > 0 )
    {
        // пробегаемся по списку выбранных категорий и ставим для них selected
        for ($y = 0; $y < count($dataArr['selected_category']); $y++)
        {
            $selectItem = $dataArr['selected_category'][$y];
            
            if($item['id'] == $selectItem['id_category'])
            {
                $selected = 'selected';
                break;
            }
        }
    }
    else
    {
        if ($item['id'] == $dataArr['id_parent'])
        {// ставим родителем корень
            $selected = 'selected';
        }
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
