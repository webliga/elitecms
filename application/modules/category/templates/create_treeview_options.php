<?php

$selected = '';

for ($i = 0; $i < count($dataArr['options']); $i++)
{
    $lang = $dataArr['options'][$i];
    $space = $dataArr['space'];
    
    // Если есть список выбранных категорий 
    if(isset($dataArr['selected_category']) && is_array($dataArr['selected_category']) && count($dataArr['selected_category']) > 0 )
    {
        // пробегаемся по списку выбранных категорий и ставим для них selected
        for ($y = 0; $y < count($dataArr['selected_category']); $y++)
        {
            $selectItem = $dataArr['selected_category'][$y];
            
            if($lang['id'] == $selectItem['id_category'])
            {
                $selected = 'selected';
                break;
            }
        }
    }
    else
    {
        if ($lang['id'] == $dataArr['id_parent'])
        {// ставим родителем корень
            $selected = 'selected';
        }
    }
    
    echo '<option ' . $selected . ' value="' . $lang['id'] . '">' . $space . $lang['name'] . '</option>';
    $selected = '';


    // если есть подкатегории, то выводи их
    if ($lang['children'] != null && is_array($lang['children']))
    {
        $optionArr = $dataArr;
        $optionArr['space'] .= "-";
        $optionArr['options'] = $lang['children'];
        Core::app()->getTemplate()->moduleContentView($optionArr);
    }
}
?>
