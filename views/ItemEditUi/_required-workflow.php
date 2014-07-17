<?php
/* @var Controller|ItemController $this */
/* @var ActiveRecord|ItemTrait|QaStateBehavior $model */
/* @var AppActiveForm $form */
?>
<?php $validationScenario = $this->controller->workflowData['validationScenario']; ?>
<?php $invalidFieldCount = $model->calculateInvalidFields($validationScenario); ?>
<?php $invalidFields = jsonEncode($model->getInvalidFields($validationScenario)); ?>
<div class="required-workflow">
    <div class="workflow-content">
        <div class="workflow-actions" id="workflow-missing" data-model-class='<?php echo get_class($model); ?>' data-missing='<?php echo $invalidFields; ?>'>
            <?php // todo: move this somewhere else ?>
            <?php if ($invalidFieldCount > 0): ?>
                <span class="missing-text">
                    <?php echo Yii::t(
                        'model', '<strong>{n}</strong> required field missing|<strong>{n}</strong> required fields missing',
                        $invalidFieldCount
                    ); ?>
                </span>
                <?php $nextStep = $this->controller->nextFlowStep("$validationScenario-", $model); ?>
                <?php if ($invalidFieldCount > 0 && empty($nextStep)): ?>
                    <?php throw new CException("The item's validation rules for $validationScenario are out of sync. Make sure that the step-based validation rules match those of the overall $validationScenario validation scenarios"); ?>
                <?php endif; ?>
                <?php if ($_GET['step'] != $nextStep): ?>
                    <?php echo TbHtml::submitButton(
                        Yii::t('button', 'Go to next field'),
                        array(
                            'id' => 'next-required',
                            'class' => 'required-button',
                            'name' => 'next-required',
                            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                            'size' => TbHtml::BUTTON_SIZE_SM,
                        )
                    ); ?>
                    <input type="hidden" name="next-required-url" value="<?php echo CHtml::encode(
                       Yii::app()->createUrl(
                           lcfirst($this->controller->modelClass) . '/' . $this->actionId,
                           array('id' => $model->id, 'step' => $nextStep)
                       )
                   ); ?>">
                <?php else: ?>
                    <?php echo TbHtml::submitButton(
                        Yii::t('button', 'Go to next field'),
                        array(
                            'url' => '#',
                            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                            'size' => TbHtml::BUTTON_SIZE_SM,
                            'id' => 'next-required',
                            'class' => 'required-button',
                        )
                    ); ?>
                <?php endif; ?>
            <?php endif; ?>
            <?php foreach ($this->controller->workflowData['flagTriggerActions'] as $action): ?>
                <?php if ($action['requiredProgress'] < 100): ?>
                    <?php echo TbHtml::button(
                        $action['label'],
                        array(
                            'size' => TbHtml::BUTTON_SIZE_SM,
                            'disabled' => true,
                        )
                    ); ?>
                <?php else: ?>
                    <?php echo TbHtml::linkButton(
                        $action['label'],
                        array(
                            'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                            'size' => TbHtml::BUTTON_SIZE_SM,
                            'url' => array(
                                $action['action'],
                                'id' => $model->{$model->tableSchema->primaryKey}
                            ),
                        )
                    ); ?>
                <?php endif; ?>
            <?php endforeach; ?>
            <?php echo TbHtml::linkButton(
                Yii::t('model', 'Cancel'),
                array(
                    'color' => TbHtml::BUTTON_COLOR_LINK,
                    'size' => TbHtml::BUTTON_SIZE_SM,
                    'url' => array(
                        'cancel',
                        'id' => $model->{$model->tableSchema->primaryKey},
                    ),
                )
            ); ?>
        </div>
    </div>
</div>
<?php publishJs('/themes/gapminder/js/workflow-validation-guide.js', CClientScript::POS_END); ?>