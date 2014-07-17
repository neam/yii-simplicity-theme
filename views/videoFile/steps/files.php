<?php
/* @var VideoFileController|ItemController $this */
/* @var VideoFile|ItemTrait $model */
/* @var AppActiveForm|TbActiveForm $form */
?>
<div class="file-field-2cols webm">
    <div class="field-column">
        <?php echo $form->select2ControlGroup(
            $model,
            'clip_webm_media_id',
            $model->getVideoOptions(VideoFile::MIME_TYPE_VIDEO_WEBM),
            array(
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
                    'data-target' => '#' . $form->id . '-webm-modal',
                )
            ); ?>
            <?php $this->renderPartial(
                '//p3Media/_modal_form',
                array(
                    'formId' => $form->id . '-webm',
                    'inputSelector' => '#VideoFile_clip_webm_media_id',
                    'model' => new P3Media(),
                    'pk' => 'id',
                    'field' => 'itemLabel',
                )
            ); ?>
        </div>
    </div>
</div>
<div class="file-field-2cols mp4">
    <div class="field-column">
        <?php echo $form->select2ControlGroup(
            $model,
            'clip_mp4_media_id',
            $model->getVideoOptions(VideoFile::MIME_TYPE_VIDEO_MP4),
            array(
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
                    'data-target' => '#' . $form->id . '-mp4-modal',
                )
            ); ?>
            <?php $this->renderPartial(
                '//p3Media/_modal_form',
                array(
                    'formId' => $form->id . '-mp4',
                    'inputSelector' => '#VideoFile_clip_mp4_media_id',
                    'model' => new P3Media(),
                    'pk' => 'id',
                    'field' => 'itemLabel',
                )
            ); ?>
        </div>
    </div>
</div>


<?php echo $form->textFieldControlGroup(
    $model,
    'youtube_url'
); ?>
