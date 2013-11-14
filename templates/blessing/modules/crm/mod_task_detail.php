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
<br/><br/> <br/><br/> 
        <a href="/ru/crm/tasks/edite/?id=<?php echo $dataArr['id']; ?>">редактировать</a><br/><br/>
        <a href="/ru/crm/tasks/create/?id_parent=<?php echo $dataArr['id']; ?>">создать подзадачу</a> <br/><br/>  
        <a href="/ru/crm/tasks/delete/?id=<?php echo $dataArr['id']; ?>">удалить эту задачу</a>   <br/><br/>     
    </div>

</div>
<br /><br /><br /><br />
