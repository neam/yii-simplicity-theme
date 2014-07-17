<?php
/** @var SnapshotController|ItemController $this */
/** @var Snapshot|ItemTrait $model */
/** @var TbActiveForm|AppActiveForm $form */
?>
<?php echo $form->translateTextFieldControlGroup(
    $model,
    'title',
    $this->getTranslationLanguage(),
    $this->action->id,
    array('hint' => true)
); ?>
<?php echo $form->translateTextFieldControlGroup(
    $model,
    'slug',
    $this->getTranslationLanguage(),
    $this->action->id,
    array('hint' => true)
); ?>
<?php echo $form->translateTextAreaControlGroup(
    $model,
    'about',
    $this->getTranslationLanguage(),
    $this->action->id,
    array('hint' => true)
); ?>
<?php if ($this->actionUsesEditWorkflow()): ?>
    <div class="file-field-2cols">
        <div class="field-column">
            <?php echo $form->select2ControlGroup(
                $model,
                'thumbnail_media_id',
                $model->getThumbnailOptions(),
                array(
                    'thumbnails' => true,
                    'empty' => Yii::t('app', 'None'),
                )
            ); ?>
        </div>
        <div class="field-column">
            <div class="form-group">
                <label class="control-label"><?php echo Yii::t('account', '&nbsp;'); ?></label>
                <?php echo TbHtml::button(
                    Yii::t('app', 'Upload'),
                    array(
                        'block' => true,
                        'class' => 'upload-btn',
                        'data-toggle' => 'modal',
                        'data-target' => '#' . $form->id . '-modal',
                    )
                ); ?>
                <?php $this->renderPartial(
                    '//p3Media/_modal_form',
                    array(
                        'formId' => $form->id,
                        'inputSelector' => '#Snapshot_thumbnail_media_id',
                        'model' => new P3Media(),
                        'pk' => 'id',
                        'field' => 'itemLabel',
                    )
                ); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
