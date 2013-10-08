<div class="center_menu_block">
    <ul class="center_menu_ul">
Верхнее меню в центре
        <?php
        for($i = 0;$i < count($menu_items);$i++)
        {
            echo '<li><a href="'.$menu_items[$i]['link'].'"><span>'.$menu_items[$i]['name'].'</span></a></li>';
        }
        
        ?>
    </ul>

</div>
