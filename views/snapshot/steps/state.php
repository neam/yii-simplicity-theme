<?php
/** @var SnapshotController|ItemController $this */
/** @var Snapshot|ItemTrait $model */
/** @var TbActiveForm|AppActiveForm $form */
?>
<?php echo $form->textAreaControlGroup($model, 'vizabi_state', array(
    'class' => Html::ITEM_FORM_FIELD_CLASS,
    'rows' => 6,
    'cols' => 50,
    'labelOptions' => array(
        'label' => Html::attributeLabelWithTooltip($model, 'vizabi_state'),
    ),
)); ?>
<?php echo $form->select2ControlGroup(
    $model,
    'tool_id',
    CHtml::listData(Tool::model()->findAll(), 'id', 'itemLabel'),
    array(
        'empty' => Yii::t('app', 'None'),
    )
); ?>
<?php echo $form->textAreaControlGroup($model, 'embed_override', array(
    'class' => Html::ITEM_FORM_FIELD_CLASS,
    'rows' => 6,
    'cols' => 50,
    'labelOptions' => array(
        'label' => Html::attributeLabelWithTooltip($model, 'embed_override'),
    ),
)); ?>
