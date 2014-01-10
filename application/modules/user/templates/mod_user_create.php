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
    <div class="control-group">
        <label class="control-label" for="inputEmail">Дата рождения:</label>
        <div class="controls">
            <input type="text"  class="form-control" value="<?php if (isset($dataArr['birthday'])) echo $dataArr['birthday']; ?>"  name="birthday">
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
                <div class="control-group news-select">
                <label class="control-label" for="inputPassword">Группа пользователя</label>
                <div class="controls">
                    <select class="form-control" name="id_group" id="id_module">
                        <?php
                        $selected = '';
                        $options = '';
                        for ($i = 0; $i < count($dataArr['all_groups']); $i++)
                        {
                            $lang = $dataArr['all_groups'][$i];

                            if ($lang['id'] == $dataArr['id_group'])
                            {
                                $selected = 'selected';
                            }
                            $options .= '<option ' . $selected . ' value="' . $lang['id'] . '">' . $lang['name'] . '</option>';
                            $selected = '';
                        }

                        echo $options;
                        ?>
                    </select>
                </div>
            </div>
            <div class="both"></div>

</div>
<div class="both"></div>

