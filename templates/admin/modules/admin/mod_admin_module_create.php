<div class="mod_create">
    <form class="form-horizontal" action="<?php echo  Core::app()->getHtml()->createUrl('admin/modules/update/');?>" method="post">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Название модуля:</label>
            <div class="controls">
                <input type="hidden" name="id_module" value="<?php echo $dataArr['id']; ?>">
                <input type="text"  class="form-control" value="<?php echo $dataArr['name']; ?>"  name="name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Системное название модуля:</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php echo $dataArr['name_system']; ?>" name="name_system">
            </div>
        </div>  
        <div class="control-group">
            <label class="control-label" for="inputPassword">Файл отображения:</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php echo $dataArr['template_file']; ?>" name="template_file">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <label class="checkbox">
                    
                </label>
                <button type="submit" class="btn btn-default">Обновить</button>
            </div>
        </div>
    </form>
</div>