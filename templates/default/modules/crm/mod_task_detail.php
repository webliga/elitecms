<div class="news_detail">

    <h1 class="title"><?php echo $dataArr['name']; ?></h1> 

    <div class="text">
        Дата создания: <?php echo $dataArr['date_create']; ?>
    </div>   

    <br />

    <div class="text">


        <?php echo $dataArr['description']; ?>
    </div>

    <div class="text">

        <a href="/ru/crm/tasks/edite/?id=<?php echo $dataArr['id']; ?>">редактировать</a>
        
    </div>

</div>
<br /><br /><br /><br />
