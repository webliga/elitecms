<!DOCTYPE html>
<html>
    <?php
    Core::app()->getTemplate()->showBlock('head');
    ?>

    <body>
        <div align="center">
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
        </div>
    </body>
</html>
