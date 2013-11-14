<div class="news_list">

        
<?php  

for ($i = 0; $i < count($dataArr['statuses']); $i++)
{
    $item = $dataArr['statuses'][$i];
    ?> 
        <div class="news_item">    
            <a href="/ru/crm/status/?id=<?php echo $item['id'];  ?>"><?php echo $item['name'];  ?></a>
        </div>    
    <?php 
}

?>   
        

</div>
<br/><br/><br/>