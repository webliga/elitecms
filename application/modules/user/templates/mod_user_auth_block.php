<div class="auth">
    <?php
    if (!Core::app()->getUser()->isAuth())
    {
        ?>
        <a href="<?php echo Core::app()->getHtml()->createUrl('auth'); ?>">Войти</a>
        <a href="<?php echo Core::app()->getHtml()->createUrl('register'); ?>">Регистрация</a>    

        <?php
    }
    else
    {
        ?>
        Привет, <?php echo Core::app()->getUser()->login; ?><br/>
        <a href="<?php echo Core::app()->getHtml()->createUrl('logout'); ?>">Выйти</a>
        <?php
    }
    
    ?>




</div>

