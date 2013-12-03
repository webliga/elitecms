<div class="news_detail">

    <?php
    if ($dataArr['show_title'] == 1)
    {
        ?>
        <h1 class="title"><?php echo $dataArr['name']; ?></h1> 
        <?php
    }
    if ($dataArr['show_date'] == 1)
    {
        ?>

        <div class="text">
            Дата создания: <?php echo $dataArr['date_create']; ?>
        </div>   

        <?php
    }
    ?>
    <div class="text">
        Источник: <a href="<?php echo $dataArr['from_source']; ?>"> <?php echo $dataArr['from_source']; ?></a>

    </div>    
    <br /><br />

    <div class="text">

        <?php
        if ($dataArr['show_img'] == 1)
        {
            ?>
            <img src="<?php echo $dataArr['img']; ?>" width="200" alt="" />

            <?php
        }
        ?>

        <?php echo $dataArr['text']; ?>
    </div>


</div>




<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
