<?php
/** @var string $content */
?>
<?php $this->beginContent(WorkflowUi::LAYOUT_MAIN); ?>
    <div class="layout-narrow">
        <div class="container">
            <div class="content">
                <?php echo $content; ?>
            </div>
        </div>
    </div>
<?php $this->endContent(); ?>