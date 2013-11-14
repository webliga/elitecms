<article class="entry">
<!--
    <div class="entry-meta">

        <span class="date">27</span>
        <span class="month">sep</span>

    </div>/ .entry-meta-->

    <div class="entry-body">

        <div class="entry-title">

            <?php
            if ($dataArr['show_title'] == 1)
            {
                ?>
                <h2 class="title"><?php echo $dataArr['name']; ?></h2> 
                <?php
            }
            if ($dataArr['show_date'] == 1)
            {
                ?>
                <span class="author">
                    Дата создания: <?php echo $dataArr['date_create']; ?>
                </span> 
                <br/>
                <span class="author">Posted by <a href="#">Admin</a></span>,
                <span class="comments">With <a href="#">2</a> Comments</span>  

                <?php
            }
            ?>


        </div><!--/ .entry-title-->					

        <?php echo $dataArr['text']; ?>


    </div><!--/ .entry-body -->
    <br/>
        <span class="author">
            Источник: <a href="<?php echo $dataArr['from_source']; ?>"> <?php echo $dataArr['from_source']; ?></a>
        </span> 
</article>