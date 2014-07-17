<?php
/* @var ActiveRecord $model */

?>
<div class="browsebar">
    <div class="browsebar-actions">
        <?php if (get_class($model) !== 'Section'): ?>
            <?php $this->widget(
                '\TbButton',
                array(
                    'label' => Yii::t('model', 'Add'),
                    'url' => array('add'),
                    'color' => TbHtml::BUTTON_COLOR_PRIMARY,
                    'visible' => Yii::app()->user->checkAccess('Add'),
                    'htmlOptions' => array('id' => 'addButton'),
                )
            ); ?>
        <?php endif; ?>
    </div>
</div>