<?php /** @var string $content */ ?>
<?php $this->beginContent(WorkflowUi::LAYOUT_MAIN); ?>
    <div class="layout-regular">
        <?php $this->renderPartial('vendor.neam.yii-simplicity-theme.views.layouts._menu'); ?>
        <div class="container">
            <div class="content">
                <div class="row">
                    <?php echo $this->renderBreadcrumbs(); ?>
                </div>
                <?php $this->widget('\TbAlert'); ?>
                <?php echo $content; ?>
            </div>
        </div>
        <?php $this->renderPartial('vendor.neam.yii-simplicity-theme.views.layouts._footer'); ?>
    </div>
<?php $this->endContent(); ?>
