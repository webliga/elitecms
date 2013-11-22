<header id="header">
    <div class="container">
        <a href="/" id="logo">
            <h1>VitagroCMS.com</h1>
        </a>
        
        <?php
        Core::app()->getTemplate()->getModulesByPosition('header_auth');
        Core::app()->getTemplate()->getModulesByPosition('header_auth2');
        ?>

        <div class="clear"></div>
        <?php
        Core::app()->getTemplate()->getModulesByPosition('header_top');
        ?>
    </div>
</header>


