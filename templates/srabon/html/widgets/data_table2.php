<?php
if (!isset($dataArr['link_edite']))
    $dataArr['link_edite'] = '';

if (!isset($dataArr['link_edite']))
    $dataArr['link_delete'] = '';

$link_edite = $dataArr['link_edite'];
$link_delete = $dataArr['link_delete'];
$link_access = $dataArr['link_access'];


unset($dataArr['link_access']);
unset($dataArr['link_edite']);
unset($dataArr['link_delete']);
unset($dataArr['name_hidden']);
unset($dataArr['btn_title']);
?>


<div class="span12 widget-block">
    <div class="widget-head">
        <h5><i class="icon-file"></i> Exportable Data Table</h5>
    </div>
    <div class="widget-content">
        <div class="widget-box">
            <table class="data-tbl-boxy table">
                <?php
                for ($i = 0; $i < count($dataArr); $i++)
                {
                    if ($i == 0)
                    {
                        echo '<thead><tr>';

                        foreach ($dataArr[$i] as $key => $value)
                        {
                            echo '<th>' . $key . '</th>';
                        }

                        echo '<th>actions</th>';

                        echo '</tr></thead>';
                    }

                    echo '<tr>';

                    foreach ($dataArr[$i] as $value)
                    {
                        echo '<td>' . $value . '</td>';
                    }

                    echo '<td>';

                    
                    
                    echo Core::app()->getTemplate()->getWidget('link_btn2', array(
                        'access' => $link_access.'?id='.$dataArr[$i]['id'],
                        'edite' => $link_edite.'?id='.$dataArr[$i]['id'],
                        'delete' => $link_delete.'?id='.$dataArr[$i]['id'],
                    ) );

                    echo '</td></tr>';
                }
                ?>
            </table>
        </div>
    </div>
</div>

