<section id="contact">

    <form method="post" action="<?php echo Core::app()->getHtml()->createUrl($dataArr['form_action']); ?>" class="comments-form" id="contactform2">

        <p class="input-block">
            <?php
            echo $dataArr['content'];
            ?> 
        </p>

        <p class="input-block">
            <button class="button default" type="submit" id="submit">Отправить</button>
        </p>

        <div class="hidden" id="contact_form_responce"><p></p></div></form><!--/ .comments-form-->	

</section>
