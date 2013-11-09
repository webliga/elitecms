<div class="mod_news_create">
    <div class="panel panel-success checkbox-group">
        <div class="panel-heading">Настройка элементов</div>
        <div class="panel-body">
            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail">Название статуса:</label>
                <div class="controls">
                    <input type="hidden" name="id" value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
                </div>
            </div>
            <div class="control-group datapicker">
                <label class="control-label" for="inputPassword">Дата создания:</label>
                <div class="controls">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['date_create'])) echo $dataArr['date_create']; ?>" name="date_create">
                </div>
            </div>
            <div class="both"></div>      

            <div class="checkbox">
                <label>
                    <input type="checkbox" name="is_complete"  <?php
                    if (isset($dataArr['is_complete']) && $dataArr['is_complete'])
                    {
                        echo 'checked';
                    }
                    else
                    {
                        '';
                    }
                    ?>> Отвечает за завершение
                </label>
            </div>

        </div>
    </div>
    <div class="both"></div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Описание статуса:</label>
        <div class="controls">
            <textarea name="description"  class="form-control"><?php if (isset($dataArr['description'])) echo $dataArr['description']; ?></textarea>
        </div>
    </div>

    <div class="both"></div>

</div>

<script>
    CKEDITOR.replace('description', {
        toolbar: 'Basic',
        height: '300',
    });
</script>

<div class="both"></div>