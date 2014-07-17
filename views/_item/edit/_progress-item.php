<?php
/* @var Controller|ItemController $this */
/* @var ActiveRecord|ItemTrait $model */
/* @var AppActiveForm $form */
/* @var string $caption */
/* @var string $stepCaption */
/* @var float $progress */
/* @var string $editAction */
/* @var string $translateInto */
?>
<div class="progress-item">
    <div class="item-bar">
        <?php $this->widget(
            '\TbProgress',
            array(
                'color' => TbHtml::PROGRESS_COLOR_SUCCESS,
                'percent' => $progress,
            )
        ); ?>
    </div>
    <div class="item-action">
        <?php $this->widget(
            '\TbButton',
            array(
                'block' => true,
                'htmlOptions' => array(
                    'disabled' => $this->isStep($step),
                ),
                'label' => Yii::t('model', $caption),
                'size' => TbHtml::BUTTON_SIZE_XS,
                'url' => $model->getActionRoute($this->action->id, $step, $translateInto),
            )
        ); ?>
    </div>
</div>
