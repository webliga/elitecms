<div class="news_list">

        
<?php  

for ($i = 0; $i < count($dataArr['statuses']); $i++)
{
    $lang = $dataArr['statuses'][$i];
    ?> 
        <div class="news_item">    
            <a href="/ru/crm/status/?id=<?php echo $lang['id'];  ?>"><?php echo $lang['name'];  ?></a>
        </div>    
    <?php 
}

?>   
        

</div>
<br/><br/><br/>