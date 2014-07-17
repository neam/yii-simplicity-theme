<?php // TODO: Refactor this view. ?>
<?php
/* @var $this ChapterController */
/* @var $execution ezcWorkflowDatabaseExecution */
?>

<?php
//var_dump($model->getAttributes(), $model->qaState()->getAttributes());

$validationProgress = ($model->qaState()->draft_validation_progress + $model->qaState()->reviewable_validation_progress + $model->qaState()->publishable_validation_progress) / 3;
$evaluationProgress = 0; //($model->qaState()->draft_evaluation_progress + $model->qaState()->preview_evaluation_progress + $model->qaState()->public_evaluation_progress) / 3;
$publishingProgress = ($validationProgress + $evaluationProgress + $model->qaState()->approval_progress + $model->qaState()->proofing_progress) / 5;
$translationProgress = ($model->qaState()->translations_draft_validation_progress + $model->qaState()->translations_reviewable_validation_progress + $model->qaState()->translations_publishable_validation_progress + $model->qaState()->translations_approval_progress + $model->qaState()->translations_proofing_progress) / 5;

$requiredFieldsCount = count($model->qaStateBehavior()->qaAttributes("public"));
$requiredFieldsMissing = $requiredFieldsCount - round($requiredFieldsCount * $model->qaState()->publishable_validation_progress / 100);

?>

<?php $this->beginWidget(
    '\TbModal',
    array('id' => 'other-options-modal')
); ?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>

    <h2>Other actions</h2>
</div>

<div class="modal-body">

    <div class="row-fluid">

        <div class="span12">

            <h3>Edit contents</h3>

            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $model->qaState()->draft_validation_progress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("crud", "Draft"),
                        "type" => strpos($this->action->id, "draft") !== false ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-pencil" . ($this->action->id == "draft" ? " icon-white" : null),
                        "url" => array("draft", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $model->qaState()->reviewable_validation_progress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("crud", "Previewable"),
                        "type" => strpos($this->action->id, "prepPreshow") !== false ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-edit" . ($this->action->id == "prepPreshow" ? " icon-white" : null),
                        "url" => array("prepPreshow", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $model->qaState()->publishable_validation_progress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Public"),
                        "type" => strpos($this->action->id, "prepPublish") !== false ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-edit" . ($this->action->id == "prepPublish" ? " icon-white" : null),
                        "url" => array("prepPublish", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">

                    N/A

                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "All"),
                        "type" => $this->action->id == "edit" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-thumbs-up" . ($this->action->id == "edit" ? " icon-white" : null),
                        "url" => array("edit", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>

            <h3>QA</h3>

            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $evaluationProgress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("crud", "Evaluate"),
                        "type" => $this->action->id == "evaluate" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-comment" . ($this->action->id == "evaluate" ? " icon-white" : null),
                        "url" => array("evaluate", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $model->qaState()->approval_progress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("crud", "Review"),
                        "type" => $this->action->id == "review" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-check" . ($this->action->id == "review" ? " icon-white" : null),
                        "url" => array("review", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $model->qaState()->proofing_progress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Proofread"),
                        "type" => $this->action->id == "proofRead" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-certificate" . ($this->action->id == "proofRead" ? " icon-white" : null),
                        "url" => array("proofRead", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>

            <h3>Ready?</h3>

            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $model->qaState()->reviewable_validation_progress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Mark as previewable"),
                        "type" => $this->action->id == "preshow" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-thumbs-up" . ($this->action->id == "preshow" ? " icon-white" : null),
                        "url" => array("preshow", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>
            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $publishingProgress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Publish"),
                        "type" => $this->action->id == "publish" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-thumbs-up" . ($this->action->id == "publish" ? " icon-white" : null),
                        "url" => array("publish", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>

            <h3>Translate</h3>

            <div class="row-fluid">
                <div class="span4">

                    <?php
                    $this->widget(
                        '\TbProgress',
                        array(
                            'color' => 'success', // 'info', 'success' or 'danger'
                            'percent' => $translationProgress,
                        )
                    );
                    ?>
                </div>
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Translate"),
                        "type" => $this->action->id == "translate" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-globe" . ($this->action->id == "translate" ? " icon-white" : null),
                        "url" => array("translate", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>

            <h3>Misc</h3>

            <div class="row-fluid">
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Clone"),
                        "type" => $this->action->id == "clone" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-plus" . ($this->action->id == "clone" ? " icon-white" : null),
                        "url" => array("clone", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>


            <div class="row-fluid">
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Remove"),
                        "type" => $this->action->id == "remove" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-eye-close" . ($this->action->id == "remove" ? " icon-white" : null),
                        "url" => array("remove", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>

            <div class="row-fluid">
                <div class="span8">

                    <?php
                    $this->widget("\TbButton", array(
                        "label" => Yii::t("model", "Replace"),
                        "type" => $this->action->id == "replace" ? "inverse" : null,
                        "size" => "small",
                        "icon" => "glyphicon-random" . ($this->action->id == "replace" ? " icon-white" : null),
                        "url" => array("replace", "id" => $model->{$model->tableSchema->primaryKey})
                    ));
                    ?>

                </div>
            </div>


        </div>
    </div>

</div>

<div class="modal-footer">
    <?php $this->widget(
        '\TbButton',
        array(
            'label' => 'Close',
            'url' => '#',
            'htmlOptions' => array('data-dismiss' => 'modal'),
        )
    ); ?>
</div>

<?php $this->endWidget(); ?>
<?php $this->widget(
    '\TbButton',
    array(
        'label' => 'Other actions',
        'color' => '',
        'size' => '',
        'htmlOptions' => array(
            'class' => 'span12',
            'data-toggle' => 'modal',
            'data-target' => '#other-options-modal',
        ),
    )
);
?>


