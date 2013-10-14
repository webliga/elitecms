<?php
if (!isset($dataArr['form_action_edite']))
    $dataArr['form_action_edite'] = '';

if (!isset($dataArr['form_action_delete']))
    $dataArr['form_action_delete'] = '';

$form_action_edite = $dataArr['form_action_edite'];
$form_action_delete = $dataArr['form_action_delete'];
$name_hidden = $dataArr['name_hidden'];

unset($dataArr['form_action_edite']);
unset($dataArr['form_action_delete']);
unset($dataArr['name_hidden']);
unset($dataArr['btn_title']);
?>

<table class="table table-striped table-bordered table-hover">

    <tbody>
        <?php
        for ($i = 0; $i < count($dataArr); $i++)
        {
            if ($i == 0)
            {
                echo '<tr>';

                foreach ($dataArr[$i] as $key => $value)
                {
                    echo '<th>' . $key . '</th>';
                }

                echo '<th>actions</th>';

                echo '</tr>';
            }

            echo '<tr>';

            foreach ($dataArr[$i] as $value)
            {
                echo '<td>' . $value . '</td>';
            }

            echo '<td>';

            echo Core::app()->getHtml()->createBtn($form_action_edite, 'tools.png', $dataArr[$i]['id'], $name_hidden);
            echo Core::app()->getHtml()->createBtn($form_action_delete, 'delete.png', $dataArr[$i]['id'], $name_hidden);

            echo '</td></tr>';
        }
        ?>
    </tbody>
</table>