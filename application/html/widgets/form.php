<div class="row-fluid">
    <div class="span12">

        <form class="form-horizontal" action="<?php echo Core::app()->getHtml()->createUrl($dataArr['form_action']); ?>" method="post">
            <div class="box-tab">


                <?php
                echo $dataArr['content'];
                ?>   
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Сохранить</button>
                    <button class="btn">Отмена</button>
                </div>
            </div>
        </form>
    </div>
</div>


