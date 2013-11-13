<?php
if (!isset($dataArr['link_edite']))
    $dataArr['link_edite'] = '';

if (!isset($dataArr['link_delete']))
    $dataArr['link_delete'] = '';

$link_edite = $dataArr['link_edite'];
$link_delete = $dataArr['link_delete'];
$name_hidden = $dataArr['name_hidden'];

unset($dataArr['link_edite']);
unset($dataArr['link_delete']);
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

            echo Core::app()->getHtml()->createBtn($link_edite, 'tools.png', $dataArr[$i]['id'], $name_hidden);
            echo Core::app()->getHtml()->createBtn($link_delete, 'delete.png', $dataArr[$i]['id'], $name_hidden);

            echo '</td></tr>';
        }
        ?>
    </tbody>
</table>
