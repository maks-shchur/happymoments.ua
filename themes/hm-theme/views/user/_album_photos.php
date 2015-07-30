<figure class="accaunt-gallery__thumbnail">
      <a href="<?=$this->createUrl('user/album',array('id'=>Yii::app()->getRequest()->getParam('id'),'photo'=>'photo'.$data->id))?>"> 
        <img src="/users/<?=$data->uid;?>/370_<?=$data->file;?>" alt="<?=Users::model()->findByPk($data->uid)->name?> - Фотограф - <?=Portfolio::model()->findByPk(Yii::app()->getRequest()->getParam('id'))->title;?>" />
      </a>
</figure>