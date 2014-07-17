<?php
/* @var VideoFileController|ItemController $this */
/* @var VideoFile $data */
?>
<div class="view">
    <?php $this->widget('VideoPlayer', array('videoFile' => $data)); ?>
    <?php if ($this->actionIsEvaluate()): ?>
        <?php $this->widget(
            'ModalCommentsWidget',
            array(
                'model' => $data,
                'attribute' => 'clip',
            )
        ); ?>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('VideoFile.*')): ?>
        <div class="admin-container hide">
            <?php echo TbHtml::link('<i class="glyphicon-edit"></i> ' . Yii::t('model', 'Edit {model}', array('{model}' => Yii::t('model', 'Video File'))), array('videoFile/continueAuthoring', 'id' => $data->id, 'returnUrl' => Yii::app()->request->url), array('class' => 'btn')); ?>
        </div>
    <?php endif; ?>

    <?php if (Yii::app()->user->checkAccess('Developer')): ?>
        <div class="admin-container hide">
            <h3>Developer access</h3>
            <?php echo TbHtml::link('<i class="glyphicon-edit"></i> ' . Yii::t('model', 'Update {model}', array('{model}' => Yii::t('model', 'Video File'))), array('videoFile/update', 'id' => $data->id, 'returnUrl' => Yii::app()->request->url), array('class' => 'btn')); ?>
        </div>
    <?php endif; ?>
</div>

<?php // TODO: Refactor this. ?>
<?php if (isset($step)): ?>
    <?php switch ($this->action->id . '-' . $step) {
        case 'translate-subtitles':
            $this->widget('\TbButton', array(
                'label' => Yii::t('model', 'Load current translations into media player'),
                'url' => Yii::app()->request->url,
                'color' => 'primary',
            ));
            break;

        default:
            echo TbHtml::submitButton(Yii::t('model', 'Save changes'), array(
                'class' => 'btn btn-primary btn-dirtyforms',
                'name' => 'save-changes',
            ));
            $this->widget('\TbButton', array(
                'label' => Yii::t('model', 'Reset'),
                'url' => Yii::app()->request->url,
                'htmlOptions' => array(
                    'class' => 'btn-dirtyforms ignoredirty',
                ),
            ));
    } ?>
<?php endif; ?>