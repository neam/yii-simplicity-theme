<?php /* @var ItemEditUi $this */ ?>
<div class="item-row <?php echo $this->cssClass; ?>">
    <div class="row-column">
        <div class="item-well">
            <div class="item-content">
                <div class="content-primary">
                    <div class="content-header">
                        <h2 class="action-heading">
                            <?php echo $this->getActionHeading(); ?>
                        </h2>
                        <div class="action-progress">
                            <div class="progress-bar-container">
                                <?php $this->widget(
                                    '\TbProgress',
                                    array(
                                        'color' => TbHtml::PROGRESS_COLOR_SUCCESS,
                                        'percent' => $this->getCurrentWorkflowProgress(),
                                    )
                                ); ?>
                            </div>
                            <div class="progress-percentage-container">
                                <?php echo Yii::t(
                                    'app', '{percentage}% done',
                                    array('{percentage}' => $this->getCurrentWorkflowProgress())
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="item-preview">
                        <?php if (get_class($this->model) === 'VideoFile' && $this->step === $this::STEP_SUBTITLES): ?>
                            <?php $currentLang = Yii::app()->language; ?>
                            <?php Yii::app()->language = $this->controller->workflowData['translateInto']; ?>
                            <?php $this->widget('VideoPlayer', array('videoFile' => $this->model, 'stretch' => true)); ?>
                            <?php Yii::app()->language = $currentLang; ?>
                        <?php else: ?>
                            <?php echo $this->model->renderImage('item-workflow-preview'); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="content-secondary">
                    <div class="content-header">
                        <div class="action-title-row">
                            <div class="action-title">
                                <h2 class="action-heading"><?php echo $this->getStepCaption(); ?></h2>
                            </div>
                            <div class="action-stop">
                                <?php echo Html::linkButtonWithIcon(
                                    TbHtml::ICON_REMOVE,
                                    Yii::t('app', 'Stop Translating'),
                                    array(
                                        'url' => array('/dashboard/index'),
                                        'color' => TbHtml::BUTTON_COLOR_LINK,
                                        'size' => TbHtml::BUTTON_SIZE_XS,
                                    )
                                ); ?>
                            </div>
                        </div>
                        <?php $this->render(
                            '_step-progress',
                            array(
                                'currentStepNumber' => $this->getCurrentStepNumber(),
                                'totalStepCount' => $this->getTotalStepCount(),
                            )
                        ); ?>
                    </div>
                    <div class="item-fields">
                        <?php $this->controller->renderPartial('steps/' . $this->step, array(
                            'model' => $this->model,
                            'form' => $this->form,
                            'step' => $this->step,
                        )); ?>
                    </div>
                    <div class="item-actions">
                        <?php $this->render(
                            '_step-action-buttons',
                            array(
                                'model' => $this->model,
                                'form' => $this->form,
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
