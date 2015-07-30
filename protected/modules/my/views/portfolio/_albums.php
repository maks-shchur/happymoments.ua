<main class="cabinet__portfolio">
    <div class="col-12 global__plus__btn-container">
        <?php
        echo CHtml::link('<i></i><span>Добавить файл</span>', '#', array('onclick'=>'$("#mydialog").dialog("open"); return false;','class'=>'global__plus__btn'));
        ?>
        <!--a href="/portfolio/addfile" class="global__plus__btn"><i></i><span>Добавить файл</span></a-->
    </div>
    <?php
    $this->beginWidget('zii.widgets.jui.CJuiDialog',array(
        'id'=>'mydialog',
        // additional javascript options for the dialog plugin
        'options'=>array(
            'title'=>'Добавление файла',
            'autoOpen'=>false,
            'width'=>'80%',
        ),
    ));
    
        $this->renderPartial('/files/create', array('model'=>$model,'file'=>Files::model())); 
    
    $this->endWidget('zii.widgets.jui.CJuiDialog');
    ?>
    
  <header class="cabinet__portfolio__title clfx">
            <div class="col-4 albom-name"><a href="/portfolio/files">Все файлы</a></div>
            <div class="col-4"><h3>Альбомы</h3></div>
            <div class="col-4"></div>
  </header>
              
    <?php $this->widget('zii.widgets.CListView', array(
    	'dataProvider'=>$dataProvider,
        'itemView'=>'_view',
    )); ?>
          
</main>