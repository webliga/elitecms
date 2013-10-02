<!DOCTYPE html>
<html>
    <?php
    Core::app()->getTemplate()->showBlock('head');
    ?>
    <head>
        <title></title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <div class="main">
            <?php
            Core::app()->getTemplate()->showBlock('header');
            ?>
            <?php
            Core::app()->getTemplate()->showBlock('center');
            ?>
            <?php
            Core::app()->getTemplate()->showBlock('footer');
            ?>
        </div>
    </body>
</html>
