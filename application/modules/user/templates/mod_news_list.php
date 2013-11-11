<div class="Crm_list">

    <?php
    for ($i = 0; $i < count($dataArr['Crm_items']); $i++)
    {
        $item = $dataArr['Crm_items'][$i];
        ?>

        <div class="Crm_item">
            <a href="/ru/Crm/?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a>

            <div class="preview">
                <?php echo $item['preview']; ?>
            </div>    
        </div>

        <?php
    }
    ?>






</div>
