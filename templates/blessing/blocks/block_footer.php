<footer id="footer">
    <div class="container clearfix">
        <?php
        Core::app()->getTemplate()->getModulesByPosition('footer_top');
        ?>
    </div>
</footer>
<footer id="bottom-footer" class="clearfix">
    <div class="container">
        <?php
        Core::app()->getTemplate()->getModulesByPosition('footer_bottom');
        ?>
    </div>
</footer>

