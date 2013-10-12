<div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
        <?php
        for ($i = 0; $i < count($menu_items); $i++)
        {
            echo '<li><a href="' . Core::app()->getHtml()->createUrl('admin/' . $menu_items[$i]['link']) . '">' . $menu_items[$i]['name'] . '</a></li>';
        }
        ?>
    </ul>
</div><!--/.nav-collapse <li class="active"><a href="#">Home</a></li>-->



