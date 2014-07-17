<?php
/** @var VideoFile|ItemTrait $model */
/** @var AppActiveForm|TbActiveForm $form */
// TODO: Remove unused code.
?>

<?php
$baseUrl = Yii::app()->request->baseUrl;

$noneLabel = Yii::t('app', 'None');
$chooseBelowLabel = Yii::t('app', 'Click to choose existing or upload new below');

$select2js = <<<EOF

function format(state) {
    if (!state.id && !state.text) return "<div class='select2-text'>{$noneLabel} - {$chooseBelowLabel}</div>";
    if (!state.id) return state.text;
    return "<div><img class='select2-thumb' src='{$baseUrl}/p3media/file/image?preset=select2-thumb&id=" + state.id.toLowerCase() + "'/></div><div class='select2-text'>" + state.text + "</div>";
}

var select2opts = {
    formatResult: format,
    formatSelection: format,
    //escapeMarkup: function(m) { return m; }
};

$("#VideoFile_subtitles_import_media_id").data('select2opts', select2opts);
$("#VideoFile_subtitles_import_media_id").select2($("#VideoFile_subtitles_import_media_id").data('select2opts'));

EOF;
?>
<div class="file-field-3cols">
    <div class="field-column">
        <?php echo $form->select2ControlGroup(
            $model,
            'subtitles_import_media_id',
            $model->getSubtitleOptions(),
            array(
                'empty' => Yii::t('app', 'None'),
            )
        ); ?>
    </div>
    <div class="field-column">
        <div class="form-group">
            <label class="control-label"><?php echo Yii::t('app', '&nbsp;'); ?></label>
            <?php echo TbHtml::submitButton(
                Yii::t('model', 'Import'),
                array(
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'block' => true,
                    'name' => 'import',
                )
            ); ?>
        </div>
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
        </div>
    </div>
</div>
<?php $this->renderPartial(
    '//p3Media/_modal_form',
    array(
        'formId' => $form->id,
        'inputSelector' => '#VideoFile_subtitles_import_media_id',
        'model' => new P3Media(),
        'pk' => 'id',
        'field' => 'itemLabel',
    )
); ?>
<?php publishJs('/themes/frontend/js/toggle-subtitle-translation-buttons.js', CClientScript::POS_END); ?>
