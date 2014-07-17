<?php
/* @var VideoFileController $this */
/* @var VideoFile|ItemTrait $model */
/* @var TbActiveForm|AppActiveForm $form */
?>
<?php if ($this->action->id === 'translate'): ?>
    <?php $this->renderPartial(
        'translate/subtitles',
        array(
            'model' => $model,
            'form' => $form,
        )
    ); ?>
<?php else: ?>
    <?php echo $form->textAreaControlGroup($model, "subtitles", array(
        'class' => Html::ITEM_FORM_FIELD_CLASS,
        'disabled' => !$this->canEditSourceLanguage(),
        'rows' => 12,
        'cols' => 50,
        'labelOptions' => array(
            'label' => Html::attributeLabelWithTooltip($model, "subtitles", 'subtitles'),
        ),
    )); ?>
    <?php $this->renderPartial('steps/fields/subtitles_import', compact('form', 'model')); ?>
    <?php echo TbHtml::linkButton(
        Yii::t('app', 'Download SRT files'),
        array(
            'block' => true,
            'color' => TbHtml::BUTTON_COLOR_LINK,
            'url' => array('/videoFile/downloadSubtitles', 'id' => $model->id),
        )
    ); ?>
<?php endif; ?>
