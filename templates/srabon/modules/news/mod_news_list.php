<div class="news_list">

    <?php
    for ($i = 0; $i < count($dataArr['news_items']); $i++)
    {
        $item = $dataArr['news_items'][$i];
        ?>

        <div class="news_item">
            <a href="/ru/news/?id=<?php echo $item['id']; ?>"><?php echo $item['name']; ?></a>

            <div class="preview">
                <?php echo $item['preview']; ?>
            </div>    
        </div>

        <?php
    }
    ?>

</div>
