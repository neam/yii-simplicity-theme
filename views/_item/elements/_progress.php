<?php
// TODO: Refactor this view.
/* @var $this ChapterController */

$steps = $model->flowSteps();
$stepCaptions = $model->flowStepCaptions();
?>

<?php

die("NOT USED");
foreach ($this->workflowData["stepActions"] as $action) {
    $this->renderPartial("/_item/elements/_progress-item", $action);
}

?>

<?php /*
<div class="row-fluid">

    <div class="span12">

        <?php if ($this->action->id == "draft"): ?>
            <?php $publishingProgress = 100; ?>
            <?php $requiredFieldsMissing = "No"; ?>
        <?php endif; ?>

        <?php print $publishingProgress; ?>% Completed<br/>
        <?php print $requiredFieldsMissing; ?> required fields missing<br/>

        <!--
        Status: <?php $this->widget(
            '\TbEditableField',
            array(
                'type' => 'select',
                'model' => $model->qaState(),
                'attribute' => 'status',
                'url' => $this->createUrl('/' . lcfirst($model->tableName()) . 'QaState/editableSaver'),
                'source' => array(
                    array("value" => null, "text" => "Empty"),
                    array("value" => "new", "text" => "New"),
                    array("value" => "draft", "text" => "Draft"),
                    array("value" => "preview", "text" => "Preview"),
                    array("value" => "public", "text" => "Public"),
                ),
            )
        ); ?>
        -->

    </div>
</div>
*/ ?>
