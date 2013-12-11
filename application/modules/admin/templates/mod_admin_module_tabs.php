<!-- Only required for left/right tabs -->
<ul class="nav nav-tabs">
    <?php
    for ($i = 0; $i < count($dataArr['tabs']); $i++)
    {
        $tab = $dataArr['tabs'][$i];
        $active = '';

        if ($i == 0)
        {
            $active = 'class="active"';
        }
        ?>

        <li <?= $active; ?>>
            <a href="#tab<?= $i; ?>" data-toggle="tab"><i class="black-icons pencil"></i><?= $tab['tab_title']; ?></a>
        </li>

        <?php
    }
    ?>               
</ul>

<div class="tab-content">
    <?php
    for ($i = 0; $i < count($dataArr['tabs']); $i++)
    {
        $tab = $dataArr['tabs'][$i];
        $active = '';

        if ($i == 0)
        {
            $active = 'active';
        }
        ?>

        <div class="tab-pane <?= $active; ?>" id="tab<?= $i; ?>">
            <div class="row-fluid">
                <div class="span12">

                    <?= $tab['tab_content']; ?>
                </div>
            </div>

        </div>
        <?php
    }
    ?>
</div>