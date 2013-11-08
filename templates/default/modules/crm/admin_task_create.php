<div class="mod_news_create">
    <div class="panel panel-success checkbox-group">
        <div class="panel-heading">Настройка элементов</div>
        <div class="panel-body">
            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail">Название задачи:</label>
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
            <!--
            <div class="control-group news-select">
                <label class="control-label" for="inputPassword">Категория:</label>
                <div class="controls">
                    <select class="form-control" name="id_category_items" id="id_module">
                        <?php
                        $selected = '';

                        If ($dataArr['id_category_items'] == 0)
                        {
                            $selected = 'selected';
                        }

                        $options = '<option ' . $selected . ' value="0">' . $dataArr['root'] . '</option>';
                        $selected = '';

                        for ($i = 0; $i < count($dataArr['all_categories']); $i++)
                        {
                            $item = $dataArr['all_categories'][$i];

                            if ($item['id'] == $dataArr['id_category_items'])
                            {
                                $selected = 'selected';
                            }
                            $options .= '<option ' . $selected . ' value="' . $item['id'] . '">' . $item['name'] . '</option>';
                            $selected = '';
                        }

                        echo $options;
                        ?>
                    </select>
                </div>
            </div>
            
            -->
        </div>
    </div>
    <div class="both"></div>

    <div class="control-group">
        <label class="control-label" for="inputPassword">Описание задачи:</label>
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