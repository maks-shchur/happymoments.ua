<?php
/* @var $this FreefotoController */
/* @var $model Freefoto */
?>
<div class="wrapper freefoto">
    <div class="container">
        <div class="col-6">
        
        </div>
        <div class="col-6">
            <div style="display: block; margin-bottom: 20px;">
                <span class="free1">Free</span> <span class="free2">Foto</span>
            </div>
            <div style="display: block; margin-bottom: 20px;">
                <span class="free3">Попали в объектив камеры фотографа на улицах города?<br /> 
                Заберите бесплатно свои лучшие фотографии на Free Foto</span>
            </div>
            <div style="display: block; margin-bottom: 20px;">
                <img src="/img/freefoto1.png" style="margin-right: 15px;" />
                <img src="/img/freefoto2.png" style="margin-right: 15px;" />
                <img src="/img/freefoto3.png" />
            </div>
        </div>
    </div>
</div>
<div class="wrapper" style="padding: 10px 0px 40px 0px; border-bottom: 1px solid #dddedf;">
    <div class="container">
        <?php $this->renderPartial('_form_add'); ?>
    </div>
</div>