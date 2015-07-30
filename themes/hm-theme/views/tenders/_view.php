<script>
function getPhone(arg) {
    $.ajax({
      url: '/user/getphone',
      type: "POST",
      data: {'id':arg},
      success: function (data) {
        var res='#res_' + arg;
        
        $('#phone_'+arg).hide();
        $(res).css('padding-left','35px');
        $(res).css('margin-top','-20px');
        $(res).html(data);
      },
    });
}
</script>
<div class="wrapper bread-crumbs">
     <div class="container">
       <a class="bread-crumbs-link" href="#">Главная</a>
       Тендеры
     </div>
  </div>
  <div class="container open__tender">
    <div class="col-1">
        <a href="/id<?=$model->user->id;?>">
            <figure class="open__tender__user-img">
                <?php
                if($model->user->photo!='' && is_file('./users/'.$model->user->id.'/'.$model->user->photo)):
                ?>
                <img src="/users/<?=$model->user->id?>/<?=$model->user->photo?>" alt="" />
                <?php else: ?>
                <img src="/img/zaglushka.png" alt="" />
                <?php endif; ?>
            </figure>
        </a>
    </div>
    <div class="col-8 open__tender__middle">
      <a href="/id<?=$model->user->id;?>" class="full__tender__info__user-name"><?=$model->user->name;?></a>
              <div class="full__tender__item__title">
                <a href="/tenders/<?=$model->id;?>"><h3>Мне нужен: <?php echo Occupation::getName($model->occupation); ?></h3></a>
              </div>
              <div class="full__tender__item__text">
                <?=CHtml::encode($model->description);?>
              </div>
    </div>
    <div class="col-3">   
        <?php
        if(Yii::app()->user->id!=$model->user->id):
        ?>   
        <div class="add__full__tender">
            <button type="clear" class="cabinet__profile__btn" data-toggle="modal" data-target="#__add-albom-cover">УЧАСТВОВАТЬ В ТЕНДЕРЕ</button>
            <p>Только для аккунтов Pro, Plus</p>
        </div>
        <?php endif; ?>
    </div>
    <div class="clfx"></div>
    <div class="full__tender__response-col">
      <?=$model->ordersCount;?><small>ответов</small>
    </div>
      <div class="full__tender__info">
              <div class="full__tender__item__price">
          <span>Цена:</span><?=CHtml::encode($model->price);?> грн
        </div>
        <div class="full__tender__item__time">
          <i></i>осталось: <?=Settings::getTimer($model->date_end);?>
        </div>
        <div class="full__tender__item__date">
          <i></i><?=Settings::dateFormat($model->date_end);?>
        </div>
            <div class="tender__reply__list clfx">
            <?php
            if($model->ordersCount > 0): 
            ?>
            <div class="tender__reply__list clfx">
                <?php
                    $i=1;
                    foreach($model->orders as $item) {
                        echo Settings::smallAva($item->uid);
                        $i++;
                        if($i==11) break;
                    }
                ?>
            </div>
            <?php
            endif;
            ?>
            <!-- <a href="#" class="tender__reply__all">все ответы</a> -->
            </div>
    </div>
  </div>
  <?php
  if($model->ordersCount > 0): 
  ?>
  <div class="container tender__proposal">
    <h3 class="title__full__tender">Предложения: </h3>
    
    <?php
        foreach($model->orders as $item) {
            $this->renderPartial('_order',array('user'=>Users::model()->findByPk($item->uid),'model'=>$item));
        }
    ?>    
       
  </div>
  <?php
  endif;
  ?>
  <!-- Участвовать в тендерах могут только -->
<?php
if(Yii::app()->user->isGuest || Yii::app()->user->member_type=='basic' || Yii::app()->user->member_type=='client'):
?>
<div class="modal fade" id="__add-albom-cover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content tender">
      <header class="modal__header"><h6>Участвовать в тендерах могут только <br>
аккаунты Plus  и Pro</h6><a href="#0" data-dismiss="modal" class=""></a></header>
      <div class="modal__content">
      <button type="button" class="cabinet__profile__btn" data-toggle="modal" data-target="#__add-albom-cover" onclick="document.location.href='/accounts'">КУПИТЬ АККАУНТ PLUS</button>

      <a href="/accounts" class="about_accaunt">Подробнее об аккаунте</a>
      </div>
    </div>
  </div>
</div>
<?php else: 
        if(count(TenderOrders::model()->findByAttributes(array('tender_id'=>$_GET['id'],'uid'=>Yii::app()->user->id)))>0):
?>
<div class="modal fade" id="__add-albom-cover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content tender">
      <header class="modal__header"><h6>Участвовать в тендерах могут только <br>
аккаунты Plus  и Pro</h6><a href="#0" data-dismiss="modal" class=""></a></header>
      <div class="modal__content">
        <div align="center" style="font-size:14px;"><?=Yii::t('tender','Already in tender')?></div>
      </div>
    </div>
  </div>
</div>
<?php   else: ?>
<div class="modal fade" id="__add-albom-cover" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content tender">
      <header class="modal__header"><h6>Участие в тендере</h6><a href="#0" data-dismiss="modal" class=""></a></header>
      <div class="modal__content">
        <form action="<?=$this->createUrl('/tenders/addorder')?>" method="post">
            <input type="hidden" name="tender_id" value="<?=$model->id?>" />
            <input type="hidden" name="uid" value="<?=Yii::app()->user->id?>" />
            <textarea name="description" class="default__textarea" placeholder="Ваше предложение. Данная информаця будет видна другим авторам и потенциальным клиентам"></textarea>
            <button type="submit" class="cabinet__profile__btn" data-toggle="modal" data-target="#__add-albom-cover">ПОДАТЬ ЗАЯВКУ НА УЧАСТИЕ В ТЕНДЕРЕ</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php   endif; 
endif; ?>