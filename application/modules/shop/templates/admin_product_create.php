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
            <form class="form-horizontal well white-box" action="<?= $dataArr['form_action']; ?>" method="post">
                <input name="id" type="hidden" value="<?= $dataArr['id']; ?>" class="input-xlarge text-tip" id="input501" data-original-title="Название товара">

                <div class="tab-content">
                    <div class="tab-pane active" id="tab1">

                        <fieldset>
                            <!-- langs --->
                            <div class="row-fluid">
                                <div class="span6">
                                    <div class="box-tab">
                                        <div class="tabbable"> 
                                            <!-- Only required for left/right tabs -->
                                            <ul class="nav nav-tabs">
                                                <?php
                                                for ($i = 0; $i < count($dataArr['all_langs']); $i++)
                                                {
                                                    $item = $dataArr['all_langs'][$i];
                                                    $active = '';
                                                    if ($item['id'] == $dataArr['lang_site_default'])
                                                    {
                                                        $active = ' class="active"';
                                                    }

                                                    echo '<li ' . $active . '><a href="#' . $i . '" data-toggle="tab">' . $item['title'] . '</a></li>';
                                                }
                                                ?>

                                            </ul>
                                            <div class="tab-content">
                                                <?php
                                                for ($i = 0; $i < count($dataArr['all_langs']); $i++)
                                                {
                                                    $item = $dataArr['all_langs'][$i];
                                                    $active = '';
                                                    if ($item['id'] == $dataArr['lang_site_default'])
                                                    {
                                                        $active = ' active';
                                                    }
                                                    ?>
                                                    <div class="tab-pane <?= $active; ?>" id="<?= $i; ?>">

                                                        <div>
                                                            <div class="control-group">
                                                                <p class="help-block">
                                                                    Название
                                                                </p>
                                                                <input name="shop_products_content[<?= $i; ?>][id_lang]" type="hidden"  value="<?= $item['id']; ?>" class="input-xlarge text-tip" id="input501" data-original-title="Название товара">
                                                                <input name="shop_products_content[<?= $i; ?>][title]" type="text" class="input-xlarge text-tip" id="input501" data-original-title="Название товара (<?= $item['title']; ?>)">

                                                            </div>
                                                            <p class="help-block">
                                                                Краткое описание
                                                            </p>
                                                            <textarea name="shop_products_content[<?= $i; ?>][preview]" class="input-xlarge" rows="3"></textarea>
                                                            <p></p>
                                                            <p class="help-block">
                                                                Полное описание
                                                            </p>
                                                            <textarea name="shop_products_content[<?= $i; ?>][description]"  class="input-xlarge" rows="7"></textarea>

                                                        </div>

                                                    </div>
                                                    <?php
                                                }
                                                ?>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="span6 well">
                                    <div class="control-group">
                                        <label class="control-label">Показывать в модулях:</label>
                                        <div class="controls">
                                            <label class="checkbox ">
                                                <input name="shop_products[hit]" type="checkbox" value="1">
                                                хит продаж </label>
                                            <label class="checkbox ">
                                                <input name="shop_products[is_active]" type="checkbox" value="1">
                                                активный </label>
                                            <label class="checkbox ">
                                                <input name="shop_products[on_order]" type="checkbox" value="1">
                                                под заказ </label>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Выберите категории:<br>(для выбора нескольких зажмите ctrl )</label>
                                        <div class="controls">
                                            <?= $dataArr['all_categories']; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- end langs  --->



                            <div class="control-group">
                                <label class="control-label">Uneditable input</label>
                                <div class="controls">
                                    <span class="input-xlarge uneditable-input">Some value here</span>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label" for="input504">Disable Input</label>
                                <div class="controls">
                                    <input type="text" class="input-xlarge disabled" disabled="disabled" placeholder="Disabled input here…" id="input504">
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Checkbox</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <input type="checkbox" value="option1">
                                        Option one</label>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Disabled checkbox</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <input type="checkbox" disabled="" value="option1">
                                        This is a disabled checkbox </label>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Checkboxes</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <input type="checkbox" value="option1" name="optionsCheckboxList1">
                                        Option one</label>
                                    <label class="checkbox">
                                        <input type="checkbox" value="option2" name="optionsCheckboxList2">
                                        Option two</label>
                                    <label class="checkbox">
                                        <input type="checkbox" value="option3" name="optionsCheckboxList3">
                                        Option three</label>
                                    <p class="help-block">
                                        <strong>Note:</strong> Labels surround all the options for much larger click areas and a more usable form.
                                    </p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Select list</label>
                                <div class="controls">
                                    <select>
                                        <option>something</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">File input</label>
                                <div class="controls">
                                    <div class="uni-uploader" id="uniform-undefined"><input class="input-file" type="file" size="19" style="opacity: 0;"><span class="filename">No file selected</span><span class="action">Choose File</span></div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Textarea</label>
                                <div class="controls">
                                    <textarea class="input-xlarge" rows="3"></textarea>
                                </div>
                            </div>

                        </fieldset>


                    </div>
                    <div class="tab-pane" id="tab2">
                        <?= $dataArr['access']; ?>
                    </div>
                </div>



                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button class="btn">Cancel</button>
                </div>
            </form>    
        </div>
    </div>
</div>


