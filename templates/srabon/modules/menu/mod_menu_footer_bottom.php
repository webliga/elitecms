<div class="footer_menu_block">
    <ul class="footer_menu_ul">
Нижнее меню в футере
        <?php
        for($i = 0;$i < count($menu_items);$i++)
        {
            echo '<li><a href="'.$menu_items[$i]['link'].'"><span>'.$menu_items[$i]['name'].'</span></a></li>';
        }
        
        ?>
    </ul>

</div>
