<!-- langs --->
<div class="row-fluid  well">
    <form action="<?= $dataArr['form_action']; ?>" method="post">

        <div class="span12">
            <div class="span5">
                <div class="box-tab">
                    <div class="tabbable"> 
                        <!-- Only required for left/right tabs -->
                        <ul class="nav nav-tabs">
                            <?php
                            for ($i = 0; $i < count($dataArr['all_langs']); $i++)
                            {
                                $lang = $dataArr['all_langs'][$i];
                                $active = '';
                                if ($lang['id'] == $dataArr['lang_site_default'])
                                {
                                    $active = ' class="active"';
                                }

                                echo '<li ' . $active . '><a href="#' . $i . '" data-toggle="tab">' . $lang['title'] . '</a></li>';
                            }
                            ?>

                        </ul>
                        <div class="tab-content">
                            <?php
                            for ($i = 0; $i < count($dataArr['all_langs']); $i++)
                            {
                                $lang = $dataArr['all_langs'][$i];
                                $active = '';
                                if ($lang['id'] == $dataArr['lang_site_default'])
                                {
                                    $active = ' active';
                                }
                                ?>
                                <div class="tab-pane <?= $active; ?>" id="<?= $i; ?>">
                                    <div>
                                        <div class="control-group">
                                            <p class="help-block">
                                                Название цены
                                            </p>
                                            <?php
                                            $contentTitle = '';
                                            $contentDescription = '';
                                            
                                            if (isset($dataArr['price_content']))
                                            {
                                                for ($y = 0; $y < count($dataArr['price_content']); $y++)
                                                {
                                                    $priceContent = $dataArr['price_content'][$y];

                                                    if ($lang['id'] == $priceContent['id_lang'])
                                                    {
                                                        $contentTitle = $priceContent['title'];
                                                        $contentDescription = $priceContent['description'];                                                        
                                                        
                                                        break;
                                                    }
                                                }
                                            }
                                            ?>

                                            <input name="shop_prices_content[<?= $i; ?>][id_lang]" type="hidden"  value="<?= $lang['id']; ?>" class="input-xlarge text-tip" id="input501" data-original-title="Название товара">
                                            <input name="shop_prices_content[<?= $i; ?>][title]" type="text" value="<?= $contentTitle; ?>" class="input-xlarge text-tip" id="input501" data-original-title="Название товара (<?= $contentTitle; ?>)">
                                            <p class="help-block">
                                                Описание цены
                                            </p>
                                            <textarea name="shop_prices_content[<?= $i; ?>][description]" type="text" value="<?= $contentDescription; ?>" class="input-xlarge text-tip" id="input501" data-original-title="" rows="6"><?= $contentDescription; ?></textarea>

                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>
            </div>
            <div class="span6">
                <div class="control-group">
                    <label class="checkbox ">

                        <?php
                        $is_strikethrough = '';
                        $is_activeChecked = '';
                        $is_purchase = '';
                        $show_title = '';                        
                        $priority = '';
                        
                        if (isset($dataArr['is_strikethrough']) && $dataArr['is_strikethrough'] == 1)
                        {
                            $is_strikethrough = 'checked';
                        }

                        if (isset($dataArr['is_active']) && $dataArr['is_active'] == 1)
                        {
                            $is_activeChecked = 'checked';
                        }

                        if (isset($dataArr['is_purchase']) && $dataArr['is_purchase'] == 1)
                        {
                            $is_purchase = 'checked';
                        }

                        if (isset($dataArr['show_title']) && $dataArr['show_title'] == 1)
                        {
                            $show_title = 'checked';
                        }
                        
                        if (isset($dataArr['priority']))
                        {
                            $priority = $dataArr['priority'];
                        }                        
                        
                        ?>

                        <input name="shop_prices[is_strikethrough]" type="checkbox" value="1" <?= $is_strikethrough; ?>>
                        зачеркнуто 
                    </label>
                    <label class="checkbox ">
                        <input name="shop_prices[is_active]" type="checkbox" value="1" <?= $is_activeChecked; ?>>
                        активный 
                    </label>
                    <label class="checkbox ">
                        <input name="shop_prices[show_title]" type="checkbox" value="1" <?= $show_title; ?>>
                        Показывать название на сайте 
                    </label>                    
                    <label class="checkbox ">
                        <input name="shop_prices[is_purchase]" type="checkbox" value="1" <?= $is_purchase; ?>>
                        закупочная 
                    </label>
                    <label>
                        <input name="shop_prices[priority]" type="text" value="<?= $priority; ?>" style="width:30px;height:15px;" >
                        очередность
                    </label>
                </div>
            </div>

        </div>
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Сохранить</button>
        </div>
    </form>
</div>

<!-- end langs  --->