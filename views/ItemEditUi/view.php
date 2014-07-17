<?php /* @var ItemEditUi $this */ ?>
<div class="item-top-actions">
    <?php echo TbHtml::linkbutton(
        Yii::t('app', 'Preview'),
        array(
            'class' => 'preview-button',
            'url' => array(
                'preview',
                'id' => $this->model->{$this->model->tableSchema->primaryKey},
                'editingUrl' => Yii::app()->request->url,
            ),
            'visible' => Yii::app()->user->checkModelOperationAccess($model, 'Preview'),
        )
    ); ?>
</div>
<?php $this->form = $this->beginWidget(
    'AppActiveForm',
    array(
        'action' => $this->getFormAction(),
        'id' => 'item-form',
        'enableAjaxValidation' => true,
        'clientOptions' => array( //'validateOnSubmit' => true,
        ),
        'htmlOptions' => array(
            'class' => 'dirtyforms',
            'enctype' => 'multipart/form-data',
        ),
    )
); ?>
    <input type="hidden" name="form-url" value="<?php echo CHtml::encode(Yii::app()->request->url); ?>"/>
    <div class="item-header">
        <div class="header-text">
            <h1 class="item-heading"><?php echo $this->model->itemLabel; ?></h1>
        </div>
    </div>
    <?php if (in_array($this->actionPartialView, array('_prepareForPublishing', '_prepareForReview'))): ?>
        <?php if (in_array($this->actionPartialView, array('_prepareForPublishing', '_prepareForReview'))): ?>
            <?php $this->render('_required-workflow', array(
                'model' => $this->model,
            )); ?>
        <?php endif; ?>
        <?php $this->render('actions/_edit'); ?>
    <?php else: ?>
        <?php $this->render("actions/$this->actionPartialView"); ?>
    <?php endif; ?>
    <?php /*
    <input type="hidden" name="form-url" value="<?php echo CHtml::encode(Yii::app()->request->url); ?>"/>
    <?php $this->renderPartial('/_item/edit/_flowbar', compact('model')); ?>
    <div class="after-flowbar">
        <div class="alerts">
            <div class="alerts-content">
                <?php $this->widget('\TbAlert'); ?>
            </div>
        </div>
        <div class="item-content">
            <div class="item-progress">
                <?php foreach ($this->controller->workflowData["stepActions"] as $action): ?>
                    <?php $this->renderPartial("/_item/edit/_progress-item", $action); ?>
                <?php endforeach; ?>
                // todo: remove if unused
                <!--
                <div class="well well-white">
                    <?php //echo $this->renderPartial('/_item/elements/actions', compact("model", "execution")); ?>
                </div>
                -->
            </div>
            <div class="item-form">
                <h2 class="form-title"><?php echo $stepCaption; ?></h2>
                <div class="form-content">
                    <?php $this->renderPartial('steps/' . $step, array(
                        'model' => $this->model,
                        'form' => $form,
                        'step' => $step,
                    )); ?>
                </div>
            </div>
        </div>
    </div>
    */ ?>
<?php $this->endWidget(); ?>
<?php // Include previously rendered content for modals. ?>
<?php // These need to be rendered outside the <form> since they contain form elements of their own. ?>
<?php foreach (array_reverse($this->controller->clips->toArray(), true) as $key => $clip): // Reverse order for recursive modals to render properly ?>
    <?php if (strpos($key, "modal:") === 0): ?>
        <?php echo $clip; ?>
    <?php endif; ?>
<?php endforeach; ?>
