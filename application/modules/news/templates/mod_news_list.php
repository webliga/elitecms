<div class="news_list">

    <?php
    for ($i = 0; $i < count($dataArr['news_items']); $i++)
    {
        $lang = $dataArr['news_items'][$i];
        ?>

        <div class="news_item">
            <a href="/ru/news/id/<?php echo $lang['id']; ?>"><?php echo $lang['name']; ?></a>

            <div class="preview">
                <?php echo $lang['preview']; ?>
            </div>    
        </div>

        <?php
    }
    ?>






</div>
