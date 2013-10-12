<div class="mod_create">
    <form class="form-horizontal" action="<?php echo Core::app()->getHtml()->createUrl($dataArr['formAction']); ?>" method="post">
        <div class="control-group">
            <label class="control-label" for="inputEmail">Текст пункта меню:</label>
            <div class="controls">
                <input type="hidden" name="id" value="<?php if(isset($dataArr['id'])) echo $dataArr['id']; ?>">
                <input type="text"  class="form-control" value="<?php if(isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Путь (без слеша спереди):</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php if(isset($dataArr['link'])) echo $dataArr['link'];?>" name="link">
            </div>
        </div>  

        <div class="control-group">
            <label class="control-label" for="inputPassword">Текст при наведении:</label>
            <div class="controls">
                <input type="text"  class="form-control" value="<?php  if(isset($dataArr['title'])) echo $dataArr['title'];?>" name="title">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="inputPassword">Меню к которому принадлежит:</label>
            <div class="controls">
                <input type="hidden"  class="form-control" value="<?php  if(isset($dataArr['id_module'])) echo $dataArr['id_module'];?>" name="id_module">
                <input type="text"  class="form-control" value="<?php  if(isset($dataArr['name_module'])) echo $dataArr['name_module'];?>" name="name_module">
            </div>
        </div>
        <div class="checkbox">
            <label>
                <input type="checkbox" name="is_active"  <?php
                if (isset($dataArr['is_active']) && $dataArr['is_active'])
                {
                    echo 'checked';
                }
                else
                {
                    '';
                }
                ?>> Активное
            </label>
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