<div class="accesslist">

    <?php
    for ($x = 0, $y = 1; $x < count($dataArr['modules']); $x++, $y++)
    {
        $module = $dataArr['modules'][$x];

        if ($y == 1)
        {
            ?>
            <div class="access_blocks">
                <?php
            }
            ?>



            <div class="access">
                <div class="modulename">
                    <h3> Модуль: <?php echo $module['name']; ?> </h3> ( <?php echo $module['name_system']; ?> )
                </div>
                <div class="moduledesc">
                    <?php echo $module['description']; ?>
                </div>



                <div class="acces_type">
                    <table>
                        <?php
                        $z = 0; //индексное число екшена данного модуля 
                        foreach ($module['access']['controller'] as $key => $value)
                        {
                            foreach ($value['action'] as $keyAction => $valueAction)
                            {
                                ?>
                                <tr>
                                    <td width="250"><?= $valueAction['desc']; ?><br/> <span> ( <?= $module['name_system']; ?> ->  <?= $key; ?> -> <?= $keyAction; ?> )</span></td> 
                                    <td> 
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][id]" type="hidden" value="<?= (isset($valueAction['id'])?$valueAction['id']:0); ?>" />
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][id_group]" type="hidden" value="<?= $dataArr['id_group']; ?>" />
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][id_module]" type="hidden" value="<?= $module['id_module']; ?>" />
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][controller]" type="hidden" value="<?= $key; ?>" />                                     
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][action]" type="hidden" value="<?= $keyAction; ?>"  />  
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][access_type]" type="hidden" value="<?= $valueAction['access_type']; ?>"  />                                 
                                        <input name="access[<?= $x; ?>][<?= $z; ?>][access_type_value]" type="checkbox" <?= (isset($valueAction['access_type_value']) && $valueAction['access_type_value'] == 1)?'checked':'' ; ?> /> 
                                    </td>
                                </tr>

                                <?php
                                $z++;
                            }
                        }
                        ?>
                    </table>
                </div>
            </div>
            <?php
            if ($y == 3 || ($x + 1) == count($dataArr['modules']))
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
</div>

<style>
    .accesslist
    {
        width: 100%;
        float: left;
    }

    .access_blocks
    {
        width: 1000px;
        float: left;
    }      

    .access
    {
        border: 1px solid #666666;
        width: 280px;
        float: left;
        margin: 0px  30px 30px 0px;
        padding: 10px;
        border-radius: 15px;
    }  

    .modulename
    {
        width: 100%;
        float: left;
        color: #669900;
    }    
    .moduledesc
    {
        width: 100%;
        float: left;
        margin: 0px  0px 20px 0px;
    }      
    .acces_type
    {
        float: left;
        margin: 0px  0px 0px 0px;
        color: #006699;
        font-size: 16px;
    } 
    .acces_type span
    {
        color: #000;
        font-size: 11px;
    }    
</style>