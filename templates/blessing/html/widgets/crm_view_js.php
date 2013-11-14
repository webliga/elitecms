<script type="text/javascript">


    $('.img_arrow').click(function() {

        if ($(this).siblings('ul').hasClass("displaynone"))
        {
            $(this).attr('src', '/img/green_arrow.png');
            $(this).siblings('ul').removeClass("displaynone");
        }
        else
        {
            $(this).attr('src', '/img/red_arrow.png');
            $(this).siblings('ul').addClass("displaynone");
        }

    });


</script>
