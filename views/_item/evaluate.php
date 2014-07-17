<?php
/** @var Controller|ItemController $this */
/** @var ActiveRecord|ItemTrait $model */
?>
<?php $workflowCaption = Yii::t('app', 'Evaluate'); ?>
<?php $this->setPageTitle(
    Yii::t('model', $this->modelClass)
    . ' - '
    . $workflowCaption
); ?>
<?php $this->renderPartial(
    'view',
    array(
        'model' => $model,
        'workflowCaption' => $workflowCaption,
    )
); ?>
