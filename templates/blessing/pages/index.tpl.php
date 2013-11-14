
<?php
Core::app()->getTemplate()->showBlock('head');
?>

<body  class="color-1 h-style-1 text-1">

    <?php
    Core::app()->getTemplate()->showBlock('header');

    Core::app()->getTemplate()->showBlock('center');

    Core::app()->getTemplate()->showBlock('footer');
    Core::app()->getTemplate()->showBlock('footer_script');    
    ?>

</body>
</html>
