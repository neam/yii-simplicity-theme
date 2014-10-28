<?php
/** @var PageControls $this */
?>
<div class="page-controls">
    <div class="controls-left">
        <?php echo $this->renderItem($this->left); ?>
    </div>
    <div class="controls-center">
        <?php echo $this->renderItem($this->center); ?>
    </div>
    <div class="controls-right">
        <?php echo $this->renderItem($this->right); ?>
    </div>
</div>
