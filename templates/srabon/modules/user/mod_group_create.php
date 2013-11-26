<div class="span12">
    <div class="box-tab">
        <div class="tabbable"> 
            <!-- Only required for left/right tabs -->
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#tab1" data-toggle="tab"><i class="black-icons pencil"></i>Основные данные</a>
                </li>
                <li>
                    <a href="#tab2" data-toggle="tab"><i class="black-icons key"></i>Права доступа</a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab1">
                    <div class="control-group">
                        <label class="control-label" for="input01">Имя группы:</label>
                        <div class="controls">
                            <input name="id"  type="hidden"value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
                            <input  name="name" type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>">
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="input01">Описание:</label>
                        <div class="controls">
                            <textarea name="description"  class="form-control"><?php if (isset($dataArr['description'])) echo $dataArr['description']; ?></textarea>
                        </div>
                    </div>                    

                </div>
                <div class="tab-pane" id="tab2">
                    <?= $dataArr['access']; ?>
                </div>
            </div>
        </div>
    </div>
</div>


