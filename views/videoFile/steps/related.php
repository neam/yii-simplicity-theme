<?php
/**
 * @var VideoFile $model
 * @var VideoFileController $this
 * @var AppActiveForm $form
 */
?>

<?php echo $form->select2ControlGroup(
    $model,
    'related',
    CHtml::listData(
        Item::model()->findAll('node_id != :self_node_id', array(':self_node_id' => $model->node_id)),
        'node_id',
        'itemLabel'
    ),
    array(
        'multiple' => true,
        'unselectValue' => '', // Anything that empty() evaluates as true
        'options' => $form->selectRelated($model, 'related'),
    )
); ?>

