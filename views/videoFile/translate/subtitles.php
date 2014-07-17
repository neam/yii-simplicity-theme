<?php
/** @var VideoFileController|ItemController $this */
/** @var VideoFile|ItemTrait $model */
/** @var AppActiveForm $form */
/** @var CArrayDataProvider $dataProvider */
?>
<?php $this->widget(
    'yiistrap.widgets.TbListView',
    array(
        'dataProvider' => $this->getSubtitleTranslationDataProvider($model),
        'viewData' => array(
            'model' => $model,
        ),
        'template' => '{items} {pager}',
        'itemView' => 'translate/_subtitle-field',
        'htmlOptions' => array(
            'class' => 'translate-subtitles-list-view',
        ),
    )
); ?>
