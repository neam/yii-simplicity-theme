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
                        <?php if ($this->getCurrentWorkflowProgress() !== null): ?>
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
                        <?php endif; ?>
                    </div>
                    <div class="item-preview">
                        <?php echo $this->model->renderImage('item-workflow-preview'); ?>
                    </div>
                </div>
                <div class="content-secondary">
                    <div class="content-header">
                        <div class="action-title-row">
                            <div class="action-title">
                                <h2 class="action-heading"><?php echo $this->getStepCaption(); ?></h2>
                            </div>
                            <div class="action-stop">
                                <?php echo TbHtml::linkButton(
                                    Yii::t('app', 'Stop Editing'),
                                    array(
                                        'url' => array('browse'),
                                        'color' => TbHtml::BUTTON_COLOR_LINK,
                                        'icon' => TbHtml::ICON_REMOVE,
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
