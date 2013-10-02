<div class="header_menu_block">
    <ul class="header_menu_ul">
Верхнее меню в шапке
        <?php
        for($i = 0;$i < count($menu_items);$i++)
        {
            echo '<li><a href="'.$menu_items[$i]['link'].'">'.$menu_items[$i]['name'].'</a></li>';
        }
        
        ?>
    </ul>

</div>


