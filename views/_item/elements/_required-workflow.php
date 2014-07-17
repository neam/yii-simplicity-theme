<?php
/* @var Controller|ItemController $this */
/* @var ActiveRecord|ItemTrait|QaStateBehavior $model */
/* @var AppActiveForm $form */
?>
<?php $validationScenario = $this->workflowData['validationScenario']; ?>
<?php $invalidFieldCount = $model->calculateInvalidFields($validationScenario); ?>
<?php $invalidFields = jsonEncode($model->getInvalidFields($validationScenario)); ?>
<div class="required-workflow">
    <div class="workflow-content">
        <div class="workflow-text">
            <h3 class="workflow-title">
                <?php echo $this->workflowData['caption']; ?>
            </h3>
        </div>
        <div class="workflow-missing" id="workflow-missing" data-model-class='<?php echo get_class($model); ?>' data-missing='<?php echo $invalidFields; ?>'>
            <?php // todo: move this somewhere else ?>
            <?php if ($invalidFieldCount > 0): ?>
                <span class="missing-text"><?php echo Yii::t('model', '* {invalidFields} required missing', array('{invalidFields}' => $invalidFieldCount)); ?></span>
                <?php $this->widget(
                    '\TbButton',
                    array(
                        'label' => Yii::t('button', 'Next'),
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                        'url' => '#',
                        'htmlOptions' => array(
                            'class' => 'required-button',
                            'id' => 'next-required',
                        ),
                    )
                ); ?>
                <?php $nextStep = $this->nextFlowStep("$validationScenario-", $model); ?>
                <?php if ($invalidFieldCount > 0 && empty($nextStep)): ?>
                    <?php throw new CException("The item's validation rules for $validationScenario are out of sync. Make sure that the step-based validation rules match those of the overall $validationScenario validation scenarios"); ?>
                <?php endif; ?>
                <?php if ($_GET['step'] != $nextStep): ?>
                    <?php echo CHtml::submitButton(
                        Yii::t('model', 'Next'),
                        array(
                            'class' => 'btn btn-primary',
                            'name' => 'next-required',
                        )
                    ); ?>
                    <input type="hidden" name="next-required-url" value="<?php echo CHtml::encode(
                       Yii::app()->createUrl(
                           lcfirst($this->modelClass) . '/' . $this->action->id,
                           array('id' => $model->id, 'step' => $nextStep)
                       )
                   ); ?>">
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="workflow-actions">
            <div class="btn-group">
                <?php foreach ($this->workflowData["flagTriggerActions"] as $action): ?>
                    <?php if ($action["requiredProgress"] < 100): ?>
                        <?php $this->widget(
                            '\TbButton',
                            array(
                                'label' => $action['label'],
                                'disabled' => true,
                            )
                        ); ?>
                    <?php else: ?>
                        <?php $this->widget(
                            '\TbButton',
                            array(
                                'label' => $action['label'],
                                'color' => 'success',
                                'url' => array($action['action'], 'id' => $model->{$model->tableSchema->primaryKey})
                            )
                        ); ?>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <div class="btn-group">
                <?php $this->widget(
                    '\TbButton',
                    array(
                        'label' => Yii::t('model', 'Cancel'),
                        'url' => array('cancel', 'id' => $model->{$model->tableSchema->primaryKey})
                    )
                ); ?>
            </div>
        </div>
    </div>
</div>
<?php publishJs('/themes/gapminder/js/workflow-validation-guide.js', CClientScript::POS_END); ?>