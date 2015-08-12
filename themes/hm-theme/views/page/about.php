<?php
/* @var $this PageController */

$this->breadcrumbs=array(
	'About',
);
?>
  <div class="container  about_us">
    
        <script>
        $(document).ready(function(){
            $('.contact_response').delay(5000).fadeOut();
        });    
        </script>
        <div class="contact_response">
        <?php if(Yii::app()->getRequest()->getParam('contact') && Yii::app()->getRequest()->getParam('contact')=='error'): ?>
        
        <div class="error">
        	<?php echo Yii::t('main','contact_error'); ?>
        </div>
        
        <?php elseif(Yii::app()->getRequest()->getParam('contact') && Yii::app()->getRequest()->getParam('contact')=='send'): ?>
        
        <div class="success">
        	<?php echo Yii::t('main','contact_send'); ?>
        </div>
        <?php
        endif;
        ?>
        </div>
    
    <h1 class="about_us__title">О проекте Happymoments.ua</h1>
    <div class="col-6 about_us__text"><span>Happymoments.ua</span> - это портал быстрого и удобного поиска профессионалов для проведения любого типа мероприятия, а также для удобного поиска фотостудии,банкетного зала, ивент агенств которые помогут создать праздник, которого Вы достойны. На нашем портале вы можете найти такие услуги как: аренда автомобилей,развлечения,шоу программы, фотографы, видеооператоры, музыканты, ведущий на ваш праздник, артистов разного жанра а так же многие другие услуги и участников,которые необходимы для проведения вашего праздника,которые порадует Вас и ваших гостей... 
В каком бы городе Вы не находились,участники нашего портала смогут организовать самый не забываемый и яркий праздник для Вас,вашей семьи,друзей,коллег... </div>
    <div class="col-6 about_us__video">
        <iframe width="100%" height="326" src="//www.youtube.com/embed/lv5uhe-EV5I" frameborder="0" allowfullscreen></iframe>
    <div class="text_under_video">C уважением администрация сайта Happymoments</div>
    </div>
    <div class="clfx"></div>
  </div>
<?php
    $this->renderPartial('contact',array('model'=>$model));
?>
  <!--div class="container about_us__help">
    <h3>Благодарим за помощь и продвижение проекта</h3>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="col-2"><a href="#"><img src="/img/skype.png" alt=""></a></div>
    <div class="clfx"></div>
  </div-->
