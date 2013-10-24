<script type="text/javascript">

<?php
$arr = 'var ar_result = {';
for ($i = 0; $i < count($dataArr['select_all_items']); $i++)
{
    $arr .= "$i:{'id': '" . $dataArr['select_all_items'][$i]['id'] . "'
                ,'name': '" . $dataArr['select_all_items'][$i]['name'] . "'
                ,'id_module':'" . $dataArr['select_all_items'][$i]['id_module'] . "'
                ,'name_module':'" . $dataArr['select_all_items'][$i]['name_module'] . "'                            
                    },";
    //$arr .= "ar_result[$i] = new Array('name':'" . $dataArr['select_all_items'][$i]['name'] . "');";
}
$arr .= '};';
echo $arr;


$currItem = "var currItem = " . $dataArr['id'] . ";";
echo $currItem;
?>

    $('#id_module').change(
            function()
            {
                var id_menu = $(this).val();
                var options = '<option value="0">Корень меню</option>';

                jQuery.each(ar_result, function()
                {// Показываем в списке родителя меню все пункты модуля кроме текущего
                    if (id_menu == this['id_module'] && currItem != this['id'])
                    {
                        options += '<option value="' + this['id'] + '">' + this['name'] + '</option>';

                    }

                });

                $('#id_parent').html(options);
            }
    );

</script>
