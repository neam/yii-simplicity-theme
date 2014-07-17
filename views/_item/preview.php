<?php
/** @var Controller|ItemController $this */
/** @var ActiveRecord|ItemTrait $model */
?>
<?php $workflowCaption = Yii::t('app', 'Preview'); ?>
<?php $this->setPageTitle(Yii::t('model', $this->modelClass) . ' - ' . $workflowCaption); ?>
<?php $this->renderPartial(
    'view',
    array(
        'preview' => true,
        'model' => $model,
    )
); ?>
<?php if ($this->showBackToTranslationButton()): ?>
    <?php echo TbHtml::linkButton(
        Yii::t('app', 'Go Back'),
        array(
            'size' => TbHtml::BUTTON_SIZE_SM,
            'url' => $this->getBackToTranslationUrl(),
        )
    ); ?>
<?php endif; ?>
