<section class="page-header">
    <div class="container">
        <h1> <?php echo $title_page; ?></h1>
    </div>
</section>

<section class="main container sbr clearfix">
    <div class="breadcrumbs">
        здесь крошки
    </div>
    <section id="content" class="ten columns">
        <?php
        Core::app()->getTemplate()->getModulesByPosition('center_top');

        echo $content;

        Core::app()->getTemplate()->getModulesByPosition('center_bottom');
        ?>
    </section>

    <?php
    Core::app()->getTemplate()->showBlock('sidebar_right');
    ?>


</section>



