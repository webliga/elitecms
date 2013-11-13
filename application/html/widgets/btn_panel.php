<form action=" <?php echo Core::app()->getHtml()->createUrl($dataArr['form_action']); ?>" method ="post">
    <fieldset>
        <input type="hidden" name="<?php echo $dataArr['name_hidden']; ?>" value="<?php echo $dataArr['id_hidden']; ?>">
        <button>
            <img src="/<?php echo Core::app()->getTemplate()->getCurrentTemplatePath(false); ?>/img/<?php echo $dataArr['img']; ?>"  width="20" />
        </button> 
    </fieldset>
</form>



