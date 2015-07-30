        <div class="col-12 text_center">
            <div class="btn__group clfx">
                <div class="col-179">
                    <button type="clear" class="cabinet__profile__btn" data-dismiss="modal">ОТМЕНА</button>
                </div>
                <div class="col-179">
                  <?php echo CHtml::beginForm('/my/files/crop'); ?>
                    <input type="hidden" name="img" value="/users/<?=Yii::app()->user->id?>/<?=$item->file?>" />
                    <input type="hidden" name="img_name" value="<?=$item->file?>" />
                    <input type="hidden" id="x_<?=$item->id?>" name="x" />
        			<input type="hidden" id="y_<?=$item->id?>" name="y" />
        			<input type="hidden" id="w_<?=$item->id?>" name="w" />
        			<input type="hidden" id="h_<?=$item->id?>" name="h" />
                    <input type="hidden" name="back" value="<?=Yii::app()->request->requestUri?>" />
                    <button type="submit" class="cabinet__profile__btn cabinet__profile__btn-submit">СОХРАНИТЬ</button>
                  <?php echo CHtml::endForm(); ?>    
                </div>
            </div>
        </div> 