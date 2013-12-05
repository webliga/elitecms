

<div id="main-content">
    <div class="container-fluid">
        <ul class="breadcrumb">
            <li><a href="#">Home</a><span class="divider">»</span></li>
            <li><a href="#">Library</a><span class="divider">»</span></li>
            <li class="active">Data</li>
        </ul>
        <!--
        <div class="center">
            <div class="panel panel-default">


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
        -->

        <div class="page-header"> <h1> <?= $title_page ?></h1></div>





        <?php
        Core::app()->getTemplate()->getModulesByPosition('center_top');

        echo $content;

        Core::app()->getTemplate()->getModulesByPosition('center_bottom');
        ?>
    </div>
</div>



