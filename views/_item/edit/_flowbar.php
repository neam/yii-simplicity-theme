<?php
/* @var Controller|ItemController $this */
/* @var ActiveRecord|ItemTrait $model */
/* @var AppActiveForm $form */
/* @var array $requiredCounts */
?>
<?php $this->beginWidget('Flowbar'); ?>
    <div class="flowbar-head">
        <div class="item-header">
            <div class="header-text">
                <h1 class="header-title">
                    <?php echo $model->itemLabel; ?>
                    <small class="header-icon"><?php echo $this->itemDescriptionTooltip(); ?></small>
                    <small class="header-version">
                        <?php echo Yii::t('app', 'Version') ?>: <?php echo $model->version; ?>
                    </small>
                    <small class="header-status">
                        <?php echo Yii::t('app', 'Status'); ?>: <?php echo Yii::t(
                            'statuses',
                            $model->qaStateBehavior()->statusLabel
                        ); ?>
                    </small>
                </h1>
            </div>
            <div class="header-actions">
                <div class="btn-group">
                    <?php $this->widget(
                        '\TbButton',
                        array(
                            'label' => Yii::t('model', 'Preview'),
                            'color' => TbHtml::BUTTON_COLOR_DEFAULT,
                            'url' => array(
                                'preview',
                                'id' => $model->{$model->tableSchema->primaryKey},
                                'editingUrl' => Yii::app()->request->url,
                            ),
                            'visible' => Yii::app()->user->checkModelOperationAccess($model, 'Preview'),
                        )
                    ); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="flowbar-content">
        <?php if ($this->actionUsesEditWorkflow()): ?>
            <?php $this->renderPartial('/_item/elements/_action-buttons', compact('model')); ?>
        <?php else: ?>
            <?php $this->renderPartial('/_item/elements/_required-workflow', compact('model')); ?>
        <?php endif; ?>
    </div>
    <div class="flowbar-foot">
        <div class="foot-text">
            <?php
            // TODO: Ensure $requireCounts is always passed to this view.
            $this->renderPartial('/_item/elements/_required-counts', compact('model'));
            ?>
        </div>
        <div class="foot-actions">
            <?php $this->widget(
                '\TbButton',
                array(
                    'color' => TbHtml::BUTTON_COLOR_LINK,
                    'label' => Yii::t('model', 'Reset'),
                    'url' => Yii::app()->request->url,
                    'htmlOptions' => array(
                        'class' => 'btn-dirtyforms ignoredirty',
                    ),
                )
            ); ?>
            <?php echo TbHtml::submitButton(
                Yii::t('model', 'Save changes'),
                array(
                    'class' => 'btn-dirtyforms',
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'name' => 'save-changes',
                )
            ); ?>
        </div>
    </div>
<?php $this->endWidget(); ?>
