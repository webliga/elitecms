<div class="admin_form">
    <form class="form-horizontal" action="<?php echo Core::app()->getHtml()->createUrl($dataArr['form_action']); ?>" method="post">

        <?php
        echo $dataArr['content'];
        ?>   

        <div class="control-group">
            <div class="controls">
                <label class="checkbox">

                </label>
                <button type="submit" class="btn btn-default">Обновить</button>
            </div>
        </div>
    </form>
</div>



