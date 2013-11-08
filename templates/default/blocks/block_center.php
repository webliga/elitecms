<div class="center">
    <?php
    Core::app()->getTemplate()->getModulesByPosition('center_top');

    echo $content;

    Core::app()->getTemplate()->getModulesByPosition('center_bottom');
    ?>

</div>