<div class="mod_news_create">
    <div class="panel panel-success checkbox-group">
        <div class="panel-heading"><?php if (isset($dataArr['lang']['title_setting'])) echo $dataArr['lang']['title_setting']; ?></div>
        <div class="panel-body">
            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail"><?php if (isset($dataArr['lang']['title_name_site'])) echo $dataArr['lang']['title_name_site']; ?></label>
                <div class="controls">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['name_site'])) echo $dataArr['name_site']; ?>"  name="name_site">
                </div>
            </div>
            <div class="both"></div>

            <div class="checkbox2">
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
                    ?>> <?php if (isset($dataArr['lang']['title_is_active'])) echo $dataArr['lang']['title_is_active']; ?>
                </label>
            </div>

            <div class="both"></div>

            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail"><?php if (isset($dataArr['lang']['title_path_to_main'])) echo $dataArr['lang']['title_path_to_main']; ?></label>
                <div class="controls">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['path_to_main'])) echo $dataArr['path_to_main']; ?>"  name="path_to_main">
                </div>
            </div>
            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail"><?php if (isset($dataArr['lang']['title_template_main'])) echo $dataArr['lang']['title_template_main']; ?></label>
                <div class="controls">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['template_main'])) echo $dataArr['template_main']; ?>"  name="template_main">
                </div>
            </div>
            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail"><?php if (isset($dataArr['lang']['title_template_admin'])) echo $dataArr['lang']['title_template_admin']; ?></label>
                <div class="controls">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['template_admin'])) echo $dataArr['template_admin']; ?>"  name="template_admin">
                </div>
            </div>
            <div class="both"></div>

            <div class="control-group news-select">
                <label class="control-label" for="inputPassword"><?php if (isset($dataArr['lang']['title_lang_site_default'])) echo $dataArr['lang']['title_lang_site_default']; ?></label>
                <div class="controls">
                    <select class="form-control" name="lang_site_default" id="id_module">
                        <?php
                        $selected = '';

                        for ($i = 0; $i < count($dataArr['langs_all']); $i++)
                        {
                            $item = $dataArr['langs_all'][$i];

                            if ($item['id'] == $dataArr['lang_site_default'])
                            {
                                $selected = 'selected';
                            }
                            $options .= '<option ' . $selected . ' value="' . $item['id'] . '">' . $item['desc'] . '</option>';
                            $selected = '';
                        }

                        echo $options;
                        ?>
                    </select>
                </div>
            </div>
            <div class="both"></div>

            <div class="control-group news-select">
                <label class="control-label" for="inputPassword"><?php if (isset($dataArr['lang']['title_lang_admin_default'])) echo $dataArr['lang']['title_lang_admin_default']; ?></label>
                <div class="controls">
                    <select class="form-control" name="lang_admin_default" id="id_module">
                        <?php
                        $selected = '';
                        $options = '';
                        for ($i = 0; $i < count($dataArr['langs_all']); $i++)
                        {
                            $item = $dataArr['langs_all'][$i];

                            if ($item['id'] == $dataArr['lang_admin_default'])
                            {
                                $selected = 'selected';
                            }
                            $options .= '<option ' . $selected . ' value="' . $item['id'] . '">' . $item['desc'] . '</option>';
                            $selected = '';
                        }

                        echo $options;
                        ?>
                    </select>
                </div>
            </div>
            <div class="both"></div>

            <div class="control-group  news-input">
                <label class="control-label" for="inputEmail"><?php if (isset($dataArr['lang']['title_log_email'])) echo $dataArr['lang']['title_log_email']; ?></label>
                <div class="controls">
                    <input type="text"  class="form-control" value="<?php if (isset($dataArr['log_email'])) echo $dataArr['log_email']; ?>"  name="log_email">
                </div>
            </div>
            <div class="both"></div>

        </div>
    </div>
    <div class="both"></div>
</div>