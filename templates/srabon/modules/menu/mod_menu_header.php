<div class="accordion-group">
    <div class="accordion-header"> <a class="accordion-toggle" data-toggle="collapse" data-parent="#side-accordion" href="#components-plugins<?php  echo $id; ?>"><i class="white-icons dropbox"></i> <?php  echo $name_menu; ?></a> </div>
    <div id="components-plugins<?php  echo $id; ?>" class="in collapse" >
        <div class="accordion-content">

            <?php
// Пункты меню создаются в методе createMenuTreeView модуля menu, контроллер C_menu_main
// там же и задаются дефолтные  класы стилей
// Используются стандартные классы для всех пунктов меню
// Если нужно переопределить, то это можно сделать через цсс
// поставив приставку .header  спереди, так как они лежат в этом блоке
// для каждого меню имеется свой блок, настраиваемый в админке
            echo $menu_items;
            ?>


        </div>
    </div>
</div>


