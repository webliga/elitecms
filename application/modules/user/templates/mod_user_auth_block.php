<div class="auth">
    <?php
    if (!Core::app()->getUser()->isAuth())
    {
        ?>
    Группа, <?php echo Core::app()->getUser()->getField('group_name'); ?><br/>
        <a href="<?php echo Core::app()->getHtml()->createUrl('auth'); ?>">Войти</a>
        <a href="<?php echo Core::app()->getHtml()->createUrl('register'); ?>">Регистрация</a>    

        <?php
    }
    else
    {
        ?>
        Привет, <?php echo Core::app()->getUser()->getField('login'); ?><br/>
        группа, <?php echo Core::app()->getUser()->getField('group_name'); ?><br/>        
        <a href="<?php echo Core::app()->getHtml()->createUrl('logout'); ?>">Выйти</a>
        <?php
    }
    
    ?>




</div>

