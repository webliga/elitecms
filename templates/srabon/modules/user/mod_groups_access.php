<?php
for ($x = 0, $y = 1; $x < count($dataArr['modules']); $x++, $y++)
{
    $module = $dataArr['modules'][$x];

    if ($y == 1)
    {
        ?>
        <div class="row-fluid">
            <?php
        }
        ?>
        <div class="span6">
            <div class="widget-block">
                <div class="widget-head">
                    <h5><i class="black-icons cog_2"></i> <?php echo $module['name']; ?> ( <?php echo $module['name_system']; ?> )</h5>
                </div>
                <div class="widget-content">
                    <div class="widget-description">
                        <p>
                            <?php echo $module['description']; ?>
                        </p>
                    </div>
                    <div class="widget-box">
                        <table class="table user-tbl">
                            <thead>
                                <tr>
                                    <th class="center"> 
                                    </th>
                                    <th class="center"> Описание </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $z = 0; //индексное число екшена данного модуля 
                                foreach ($module['access']['controller'] as $key => $value)
                                {
                                    foreach ($value['action'] as $keyAction => $valueAction)
                                    {
                                        ?>
                                        <tr>
                                            <td  class="center tr-user-check"> 
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][id]" type="hidden" value="<?= (isset($valueAction['id']) ? $valueAction['id'] : 0); ?>" />
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][id_group]" type="hidden" value="<?= $dataArr['id_group']; ?>" />
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][id_module]" type="hidden" value="<?= $module['id_module']; ?>" />
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][controller]" type="hidden" value="<?= $key; ?>" />                                     
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][action]" type="hidden" value="<?= $keyAction; ?>"  />  
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][access_type]" type="hidden" value="<?= $valueAction['access_type']; ?>"  />                                 
                                                <input name="access[<?= $x; ?>][<?= $z; ?>][access_type_value]" type="checkbox" <?= (isset($valueAction['access_type_value']) && $valueAction['access_type_value'] == 1) ? 'checked' : ''; ?> /> 
                                            </td>
                                            <td><?= $valueAction['desc']; ?><br/> <span> ( <?= $module['name_system']; ?> ->  <?= $key; ?> -> <?= $keyAction; ?> )</span></td> 

                                        </tr>

                                        <?php
                                        $z++;
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="widget-bottom">
                        
                    </div>
                </div>
            </div>
        </div>
        <?php
        if ($y == 2 || ($x + 1) == count($dataArr['modules']))
        {
            $y = 0;
            ?>
        </div>

        <?php
    }
    ?>            

    <?php
}
?>
