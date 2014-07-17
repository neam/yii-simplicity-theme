<?php // TODO: Refactor this view. ?>
<?php
/** @var ItemController|Controller $this */
/** @var ItemTrait|ActiveRecord $model */
?>
<?php $this->setPageTitle(
    Yii::t('model', $this->modelClass)
    . ' - '
    . Yii::t('app', 'Choose language')
); ?>
<div class="<?php echo $this->getCssClasses($model); ?>">
    <?php $this->renderPartial(
        '/_item/elements/_flowbar',
        compact('model', 'workflowCaption', 'form')
    ); ?>
    <div class="after-flowbar">
        <?php $_lang = Yii::app()->language; ?>
        <?php foreach (Yii::app()->user->getTranslatableLanguages() as $languageCode => $languageLabel): ?>
            <?php if ($languageCode === Yii::app()->sourceLanguage): ?>
                <?php continue; ?>
            <?php endif; ?>
            <?php $options = array(
                'icon' => 'globe',
            ); ?>
            <div class="language-content">
                <div class="language-actions">
                    <?php echo TbHtml::linkButton(
                        Yii::t('app', 'Translate into {language}', array('{language}' => $languageLabel)),
                        array(
                            'block' => true,
                            'size' => TbHtml::BUTTON_SIZE_SM,
                            'url' => array(
                                'translate',
                                'id' => $model->{$model->tableSchema->primaryKey},
                                'step' => $model->firstTranslationFlowStep(),
                                'translateInto' => $languageCode,
                            ),
                        )
                    ); ?>
                </div>
                <div class="language-progress">
                    <?php
                    try {
                        // Use db-stored qa state for efficiency since we are listing many languages
                        $progress = (float) $model->qaState()->{'translate_into_' . $languageCode . '_validation_progress'};
                        $this->widget(
                            '\TbProgress',
                            array(
                                'color' => 'success', // 'info', 'success' or 'danger'
                                'percent' => $progress,
                            )
                        );
                    } catch (QaStateBehaviorNoAssociatedRulesException $e) {
                        echo Yii::t('exceptions', $e->getMessage());
                    }
                    ?>
                </div>
            </div>
        <?php endforeach; ?>
        <?php Yii::app()->language = $_lang; ?>
    </div>
</div>
