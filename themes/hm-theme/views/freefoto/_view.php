<div class="data_<?=$data->id?> freefoto-gallery__thumbnail">
                  <figure class="freefoto-gallery__thumbnail">
                    <a href="/freefotos/<?=$data->uid?>/<?=$data->photo?>" rel="gallery1" class="photo__zoom">
                        <img src="/freefotos/<?=$data->uid?>/370_<?=$data->photo?>" alt="Free Foto - Найди свое фото">
                    </a>
                    <?php if(!Yii::app()->user->isGuest): 
                            $user=Users::model()->findByPk(Yii::app()->user->id);
                            if($user->freefoto==1 && $data->uid==Yii::app()->user->id):
                    ?>
                    <a href="javascript:void(0)" class="message__item-delete_photo"><span class="cabinet__photo__item-delete"></span></a>
                    <div class="delete__hidden">
                        <div class="delete__hidden-title">Хотите удалить?</div>
                        <div class="delete__hidden-yes" id="<?=$data->id?>">ДА</div>
                        <div class="delete__hidden-no">нет</div>
                    </div>
                            <?php endif; ?>
                    <?php endif; ?>
                    <a href="/freefoto/download?pic=<?=$data->id?>" class="freefoto_download"></a>
                    <?php if(!Yii::app()->user->isGuest): 
                            $user=Users::model()->findByPk(Yii::app()->user->id);
                            if($user->freefoto==1):
                    ?>
                    <span class="freefoto_calc"><?=$data->downloads?></span>
                            <?php endif; ?>                    
                    <?php endif; ?>
                  </figure>
           <?php if(!Yii::app()->user->isGuest): 
                    if($user->freefoto==1 && $data->uid==Yii::app()->user->id):
           ?>
            <script>
            $("#<?=$data->id?>").click(function(){
                $(".delete__hidden").hide();
                $.ajax({
                    url: "/freefoto/delete/?id=<?=$data->id?>",          
                    type : "get",                    
                    success: function (data, textStatus) {
                        $(".data_<?=$data->id?>").fadeOut(400);
                    }               
                });
            });
            </script>
                    <?php endif; ?> 
           <?php endif; ?> 
</div>