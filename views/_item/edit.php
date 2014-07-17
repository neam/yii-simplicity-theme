<?php
/* @var Controller|ItemController $this */
/* @var ActiveRecord|ItemTrait $model */
/* @var AppActiveForm $form */
/* @var string $step */
/* @var string $stepCaption */
/* @var string $controllerCssClass */
?>
<div class="<?php echo $this->getCssClasses($model); ?>">
    <?php $this->widget(
        'ItemEditUi',
        array(
            'model' => $model,
            'step' => $step,
        )
    ); ?>
</div>
