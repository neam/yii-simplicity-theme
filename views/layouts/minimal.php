<?php
/** @var string $content */
?>
<?php $this->beginContent(WebApplication::LAYOUT_MAIN); ?>
    <div class="layout-minimal">
        <div class="container">
            <div class="content">
                <div class="row">
                    <?php //echo $this->renderBreadcrumbs(); // TODO: Move method. ?>
                </div>
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>