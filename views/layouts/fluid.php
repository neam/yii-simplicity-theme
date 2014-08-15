<?php
/** @var string $content */
?>
<?php $this->beginContent(WebApplication::LAYOUT_MAIN); ?>
    <div class="layout-fluid">
        <div class="container-fluid">
            <?php $this->renderPartial('simplicity-theme.views.layouts._menu'); ?>
            <div class="content">
                <div class="row">
                    <?php //echo $this->renderBreadcrumbs(); // TODO: Move method. ?>
                </div>
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>