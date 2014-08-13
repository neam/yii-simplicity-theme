<?php
/** @var DashboardTaskList $this */
/** @var array $data */
?>
<div class="task-thumbnail">
    <div class="thumbnail-container">
        <?php echo $this->getTaskModel($data)->renderImage(); ?>
    </div>
    <div class="skip-link-container"></div>
</div>
<div class="task-info">
    <div class="task-top-bar">
        <div class="task-action-text">
            <span class="action-heading">
                <?php echo Yii::t('app', 'Translate a {itemType}:', array('{itemType}' => $data['model_class'])); // TODO: Get action heading dynamically. ?>
            </span>
        </div>
        <div class="task-facts">
            <ul class="facts-list">
                <?php /*
                <li class="facts-list-item">
                    <?php echo Yii::t('app', '{viewCount} views', array(
                        '{viewCount}' => 0, // TODO: Get view count dynamically.
                    )); ?>
                </li>
                <li class="facts-list-item">
                    <?php echo Yii::t('app', 'In {languageCount} languages', array(
                        '{languageCount}' => 0, // TODO: Get language count dynamically.
                    )); ?>
                </li>
                <li class="facts-list-item">
                    <?php echo Yii::t('app', '+{pointCount} pts', array(
                        '{pointCount}' => 0, // TODO: Get point count dynamically.
                    )); ?>
                </li>
                */ ?>
            </ul>
        </div>
    </div>
    <div class="task-title">
        <h3 class="task-heading">
            <?php echo Html::encode($data['_title']); ?>
        </h3>
    </div>
    <div class="task-bottom-bar">
        <div class="task-progress">
            <div class="progress-info">
                <span class="progress-title">
                    <?php echo Html::encode(LanguageHelper::getName($data['language'])); ?>
                </span>
                <span class="progress-percentage">
                    <?php echo (int)$data['progress'] . '%'; ?>
                </span>
            </div>
            <div class="progress-bar-container">
                <?php echo TbHtml::progressBar(
                    (int)$data['progress'],
                    array('color' => TbHtml::LABEL_COLOR_SUCCESS)
                ); ?>
            </div>
        </div>
        <div class="task-actions">
            <?php echo TbHtml::linkButton(
                ($this->type === DashboardTaskList::TYPE_NEW)
                    ?  Yii::t('app', 'Start Translating')
                    :  Yii::t('app', 'Continue Translating'),
                array(
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'url' => $this->createTaskUrl('translate', $data),
                )
            ); ?>
        </div>
    </div>
</div>
