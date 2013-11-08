<div class="news_list">

    <?php

    for ($i = 0; $i < count($dataArr['tasks']); $i++)
    {
        $item = $dataArr['tasks'][$i];
        ?>

        <div class="news_item">
            <a href="/ru/crm/tasks/?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a>

            <div class="preview">
                <?php //echo $item['description']; ?>
            </div>    
        </div>

        <?php
    }
    ?>
</div>
<br/><br/><br/>