<?php
/* @var ItemDetails $this */
?>
<div class="item-details">
    <?php foreach($this->attributes as $attribute): ?>
        <div class="item-attribute">
            <div class="attribute-label">
                <?php echo $this->getAttributeLabel($attribute); ?>
            </div>
            <div class="attribute-value">
                <?php echo $this->getAttributeValue($attribute); ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
