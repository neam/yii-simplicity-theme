<?php
/* @var ActiveRecord|ItemTrait $model */
/* @var Controller $this */
?>
<div class="flowbar">
    <h1 class="flowbar-title">
        <?php $this->renderPartial('/_item/elements/_header', array('model' => $model)); ?>
    </h1>
    <?php if ($this->action->id == "edit"): ?>
        <?php $this->renderPartial('/_item/elements/_action-buttons', compact('model')); ?>
    <?php elseif ($this->action->id != "preview" && $this->action->id != "view" && $this->action->id != "browse"): ?>
        <div class="well well-small">
            <div class="row">
                <div class="col-md-4">
                    <h3>
                        <?php echo $this->workflowData["caption"]; ?>
                    </h3>
                </div>
                <div class="col-md-5">
                    <?php
                    $validationScenario = $this->workflowData["validationScenario"];
                    $invalidFields = $model->calculateInvalidFields($validationScenario);
                    if ($invalidFields > 0):
                        ?>
                        <div class="pull-left" style="margin-right: 1em;">
                            <h4 class="required-missing">* <?php echo $invalidFields; ?> required missing</h4>
                        </div>
                        <?php
                        $nextStep = $this->nextFlowStep("$validationScenario-", $model);

                        // Sanity check
                        if ($invalidFields > 0 && empty($nextStep)) {
                            throw new CException("The item's validation rules for $validationScenario are out of sync. Make sure that the step-based validation rules match those of the overall $validationScenario validation scenarios");
                        }

                        if ($_GET['step'] != $nextStep): ?>
                            <div class="btn-group">

                                <?php
                                echo CHtml::submitButton(Yii::t('model', 'Next'), array(
                                        'class' => 'btn btn-primary',
                                        'name' => 'next-required',
                                    )
                                );
                                ?>
                                <input type="hidden" name="next-required-url"
                                       value="<?php echo CHtml::encode(Yii::app()->createUrl(lcfirst($this->modelClass) . '/' . $this->action->id, array('id' => $model->id, 'step' => $nextStep))); ?>"/>

                            </div>
                        <?php endif; ?>

                    <?php
                    endif;
                    ?>
                </div>
                <div class="col-md-3">
                    <div class="pull-right">
                        <div class="btn-group">
                            <?php
                            foreach ($this->workflowData["flagTriggerActions"] as $action):
                                if ($action["requiredProgress"] < 100) {
                                    $this->widget("\TbButton", array(
                                        "label" => $action["label"],
                                        "type" => "",
                                        "disabled" => true,
                                    ));
                                } else {
                                    $this->widget("\TbButton", array(
                                        "label" => $action["label"],
                                        "type" => "success",
                                        "url" => array($action["action"], "id" => $model->{$model->tableSchema->primaryKey})
                                    ));
                                }
                            endforeach;
                            ?>
                        </div>
                        <div class="btn-group">
                            <?php $this->widget('\TbButton', array(
                                'label' => Yii::t('model', 'Cancel'),
                                'url' => array('cancel', 'id' => $model->{$model->tableSchema->primaryKey})
                            )); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php if (!empty($requiredCounts) && $requiredCounts['remaining'] > 0): ?>
        <div class="required-counts">
            <div class="row">
                <div class="col-md-5 col-md-offset-3">
                    <span class="missing">
                        <?php echo Yii::t('app', '* <em id="remaining-count">{remaining}</em> required fields missing.', array(
                            '{remaining}' => $requiredCounts['remaining'],
                        )); ?>
                    </span>
                    <?php $this->widget('\TbButton', array(
                        'label' => Yii::t('button', 'Next'),
                        'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                        'url' => '#',
                        'htmlOptions' => array(
                            'id' => 'next-required',
                        ),
                    )); ?>
                </div>
                <?php $this->widget('\TbButton', array(
                    'label' => Yii::t('button', 'Translation Done'),
                    'color' => TbHtml::BUTTON_COLOR_DEFAULT,
                    'url' => '#',
                    'htmlOptions' => array(
                        'id' => 'translation-done',
                    ),
                )); ?>
                    <?php $this->widget('\TbButton', array(
                    'label' => Yii::t('button', 'Cancel'),
                    'color' => TbHtml::BUTTON_COLOR_DEFAULT,
                    'url' => '#',
                    'htmlOptions' => array(
                        'id' => 'translation-cancel',
                    ),
                )); ?>
            </div>
        </div>
        <?php publishJs('/themes/gapminder/js/workflow-validation-guide.js', CClientScript::POS_END); ?>
    <?php endif; ?>
</div>
