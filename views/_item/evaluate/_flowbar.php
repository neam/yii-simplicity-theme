<?php $this->beginWidget('Flowbar'); ?>
    <div class="flowbar-head">
        <div class="item-header">
            <div class="header-text">
                <h1 class="header-title">
                    <?php echo $model->itemLabel; ?>
                    <small class="header-icon"><?php echo $this->itemDescriptionTooltip(); ?></small>
                    <small class="header-version">
                        <?php echo Yii::t('app', 'Version') ?>: <?php echo $model->version; ?>
                    </small>
                    <small class="header-status">
                        <?php echo Yii::t('app', 'Status'); ?>: <?php echo Yii::t(
                            'statuses',
                            $model->qaStateBehavior()->statusLabel
                        ); ?>
                    </small>
                </h1>
            </div>
        </div>
    </div>
    <div class="flowbar-content">
    </div>
    <div class="flowbar-foot">
        <div class="foot-workflow">
            <div class="workflow-content">
                <div class="workflow-text">
                    <h3 class="workflow-title"><?php echo Yii::t('model', 'Evaluate'); ?></h3>
                </div>
                <div class="workflow-actions">
                    <div class="btn-group">
                        <?php $this->widget(
                            "\TbButton",
                            array(
                                "label" => Yii::t("model", "Cancel"),
                                "url" => array("cancel", "id" => $model->{$model->tableSchema->primaryKey})
                            )
                        ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>