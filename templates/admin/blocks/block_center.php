<div class="center">
    <div class="panel panel-default">

        <div class="panel-heading"><?php echo $title_page ?></div>
        <div class="panel-body">
            <p>
                <a href="<?php echo Core::app()->getHtml()->createUrl('admin/' . $createPath); ?>" title="Создать"><img src="<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(false); ?>img/add.png" alt="" width="50"></a>

            </p>
        </div>

        <?php
        Core::app()->getTemplate()->getModulesByPosition('center_top');


        echo $content;



        Core::app()->getTemplate()->getModulesByPosition('center_bottom');
        ?>
    </div>
</div>