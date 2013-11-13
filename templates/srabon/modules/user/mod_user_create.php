<div class="mod_create">
    <div class="control-group">
        <label class="control-label" for="inputEmail">Имя:</label>
        <div class="controls">
            <input type="hidden" name="id" value="<?php if (isset($dataArr['id'])) echo $dataArr['id']; ?>">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['name'])) echo $dataArr['name']; ?>"  name="name">
        </div>
    </div>
    <div class="both"></div>
    <div class="control-group">
        <label class="control-label" for="inputEmail">Фамилия:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['surname'])) echo $dataArr['surname']; ?>"  name="surname">
        </div>
    </div>
    <div class="both"></div>    
    <div class="control-group">
        <label class="control-label" for="inputEmail">Отчество:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['lastname'])) echo $dataArr['lastname']; ?>"  name="lastname">
        </div>
    </div>
    <div class="both"></div>    
    <div class="control-group">
        <label class="control-label" for="inputEmail">Email:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['email'])) echo $dataArr['email']; ?>"  name="email">
        </div>
    </div>

    <div class="input-append date" id="datepicker" data-date="<?php if (isset($dataArr['birthday'])) echo $dataArr['birthday']; ?>" data-date-format="dd-mm-yyyy">
        <div class="control-group">
            <label for="appendedInput" class="control-label">Дата рождения:</label>
            <div class="controls">
                <div class="input-append">
                    <input size="16" type="text" value="<?php if (isset($dataArr['birthday'])) echo $dataArr['birthday']; ?>" class="add-on  "  value="<?php if (isset($dataArr['birthday'])) echo $dataArr['birthday']; ?>"  name="birthday">
                </div>
            </div>
        </div>
    </div>

    <div class="both"></div>    
    <div class="control-group">
        <label class="control-label" for="inputEmail">Пароль:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['password'])) echo $dataArr['password']; ?>"  name="password">
        </div>
    </div>
    <div class="both"></div>    
    <div class="control-group">
        <label class="control-label" for="inputEmail">Повторить пароль:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['confirm_password'])) echo $dataArr['confirm_password']; ?>"  name="confirm_password">
        </div>
    </div>
    <div class="both"></div>     
    <div class="both"></div>

</div>
<div class="both"></div>

