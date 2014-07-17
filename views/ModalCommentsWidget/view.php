<?php /** @var $this ModalCommentsWidget */ ?>
<?php echo TbHtml::button(
    Yii::t('app', 'Comments'),
    array(
        'data-toggle' => 'modal',
        'data-target' => "#$this->modalId",
    )
); ?>
<?php $this->widget('yiistrap.widgets.TbModal', array(
    'id' => $this->modalId,
    'header' => Yii::t(
        'app', 'Comments on {target}',
        array(
            '{target}' => $this->model->getAttributeLabel($this->attribute) . ' (' . Yii::t('app', $this->model->getModelLabel(), 1) . ')',
        )
    ),
    'content' => '<div id="' . $this->modalId . '-commentSection"></div>',
)); ?>
