<?php
/** @var string $content */
?>
<?php $this->beginContent(WebApplication::LAYOUT_MAIN); ?>
    <div class="layout-fluid">
        <div class="container-fluid">
            <?php $this->renderPartial('simplicity-theme.app-views.layout-elements._menu'); ?>
            <div class="content">
                <div class="row">
                    <?php //echo $this->renderBreadcrumbs(); // TODO: Move method. ?>
                </div>
                <?php echo $content; ?>
            </div>
        </div>
        <?php $this->renderPartial('simplicity-theme.app-views.layout-elements._footer'); ?>
    </div>
<?php $this->endContent(); ?>
