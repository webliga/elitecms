<div class="widget widget_popular_posts">

    <h3 class="widget-title"><?php $dataArr['title']; ?></h3>
    <ul>
        <?php
        for ($i = 0; $i < count($dataArr['news_items']); $i++)
        {
            $lang = $dataArr['news_items'][$i];
            ?>
            <li>
                <?php
                if ($lang['show_img'] == 1)
                {
                    ?>
                    <div class="bordered alignleft">
                        <figure class="add-border">
                            <a class="single-image" href="#"><img src="images/temp/recent-img-1.jpg" alt=""><span class="curtain">&nbsp;</span></a>
                        </figure>
                    </div><!--/ .bordered-->

                    <?php
                }
                ?>



                <h6>
                    <a href="/ru/news/id/<?php echo $lang['id']; ?>">
                        <?php echo $lang['name']; ?>
                    </a>
                </h6>
                <div class="entry-meta">
                    <?php echo $lang['preview']; ?>
                </div>
            </li>
            <?php
        }
        ?>
    </ul>
</div>
