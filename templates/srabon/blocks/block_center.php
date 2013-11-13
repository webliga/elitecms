<div class="center">
    <div class="panel panel-default">

        <div class="panel-heading"><?php echo $title_page ?></div>
        <div class="panel-body">
            <p>
                <?php
                if (isset($createPath) && !$this->isEmpty($createPath))
                {
                    ?>

                    <a href="<?php echo Core::app()->getHtml()->createUrl('admin/' . $dublicatePath); ?>" title="<?php echo $dublicateTitle ?>"><img src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(false); ?>/img/add.png" alt="" width="50"></a>
                    <a href="<?php echo Core::app()->getHtml()->createUrl('admin/' . $createPath); ?>" title="<?php echo $createTitle ?>"><img src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(false); ?>/img/add.png" alt="" width="50"></a>

                    <?php
                }
                ?>
            </p>
        </div>

        
    </div>
</div>



<div id="main-content">
    <div class="container-fluid">
     <?php
        Core::app()->getTemplate()->getModulesByPosition('center_top');


        echo $content;




        Core::app()->getTemplate()->getModulesByPosition('center_bottom');
        ?>
    </div>
</div>



