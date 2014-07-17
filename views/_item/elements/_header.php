<?php
/* @var Controller|ItemController $this */
/* @var ActiveRecord|ItemTrait $model */
?>
<div class="item-header">
    <div class="header-text">
        <?php echo $model->itemLabel; ?>
        <?php if ($this->action->id !== 'browse'): ?>
            <small class="header-icon"><?php echo $this->itemDescriptionTooltip(); ?></small>
        <?php endif; ?>
        <small class="header-version">
            <?php echo Yii::t('app', 'Version') ?>: <?php echo $model->version; ?>
        </small>
        <small class="header-status">
            <?php echo Yii::t('app', 'Status'); ?>: <?php echo Yii::t('statuses', $model->qaStateBehavior()->statusLabel); ?>
        </small>
    </div>
    <?php if ($this->action->id !== 'evaluate'): ?>
        <div class="header-actions">
            <div class="btn-group">
                <?php if ($this->action->id === 'browse'): ?>
                    <?php $this->widget(
                        '\TbButton',
                        array(
                            'label' => Yii::t('model', 'View'),
                            'icon' => 'glyphicon-eye-open',
                            'url' => array('view', 'id' => $model->{$model->tableSchema->primaryKey}),
                        )
                    ); ?>
                <?php endif; ?>
                <?php if ($this->action->id === "preview" || $this->action->id === "browse"): ?>
                    <?php $this->widget(
                        '\TbButton',
                        array(
                            'label' => Yii::t('model', 'Edit'),
                            'icon' => 'glyphicon-edit',
                            'color' => $this->action->id !== 'edit' ? TbHtml::BUTTON_COLOR_PRIMARY : TbHtml::BUTTON_COLOR_DEFAULT,
                            'url' => !empty($_GET['editingUrl']) ? $_GET['editingUrl'] : array(
                                'continueAuthoring',
                                'id' => $model->{$model->tableSchema->primaryKey}
                            ),
                            'visible' => Yii::app()->user->checkModelOperationAccess($model, 'Edit'),
                        )
                    ); ?>
                <?php elseif ($this->actionUsesEditWorkflow()): ?>
                    <?php $this->widget(
                        '\TbButton',
                        array(
                            'label' => Yii::t('model', 'Preview'),
                            'icon' => 'glyphicon-eye-open',
                            'color' => $this->action->id !== 'preview' ? TbHtml::BUTTON_COLOR_PRIMARY : TbHtml::BUTTON_COLOR_DEFAULT,
                            'url' => array(
                                'preview',
                                'id' => $model->{$model->tableSchema->primaryKey},
                                'editingUrl' => $this->action->id === 'view' ? null : Yii::app()->request->url
                            ),
                            'visible' => Yii::app()->user->checkModelOperationAccess($model, 'Preview'),
                        )
                    ); ?>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
</div>
