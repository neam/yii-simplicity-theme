<div class="map">
    <?php // TODO: Refactor this cluster of code. ?>
    <?php if (!is_null($data->embed_override)): ?>
        <?php $markup = $data->embed_override; ?>
        <?php echo str_replace("{language}", Yii::app()->language, $markup); ?>
    <?php elseif (!is_null($data->tool) && !is_null($data->tool->embed_template)): ?>
    <?php
    parse_str($data->vizabi_state, $foo);
    $vizabi_state = substr(json_encode($foo), 1, -1);
    $markup = $data->tool->embed_template;
    ?>
    <?php $lang = str_replace("{language}", Yii::app()->language, $markup); ?>
    <?php $viz = str_replace("{vizabi_state}", $vizabi_state, $lang); ?>
</div>
<?php else: ?>
    <div class="alert">
        <?php echo Yii::t('app', 'No markup to render'); ?>
    </div>
<?php
endif; ?>

<?php if ($this->actionIsEvaluate()): ?>
    <?php $this->widget(
        'ModalCommentsWidget',
        array(
            'model' => $data,
            'attribute' => 'vizualization',
        )
    ); ?>
<?php endif; ?>

<?php if (Yii::app()->user->checkAccess('Snapshot.*')): ?>
    <div class="admin-container hide">
        <?php echo CHtml::link(
            '<i class="glyphicon-edit"></i> ' . Yii::t('model', 'Edit {model}', array('{model}' => Yii::t('model', 'Snapshot'))),
            array(
                'snapshot/continueAuthoring',
                'id' => $data->id,
                'returnUrl' => Yii::app()->request->url
            ),
            array('class' => 'btn')
        ); ?>
    </div>
<?php endif; ?>

<?php if (Yii::app()->user->checkAccess('Developer')): ?>
    <div class="admin-container hide">
        <h3>Developer access</h3>
        <?php echo CHtml::link(
            '<i class="glyphicon-edit"></i> ' . Yii::t('model', 'Update {model}', array('{model}' => Yii::t('model', 'Snapshot'))),
            array(
                'snapshot/update',
                'id' => $data->id,
                'returnUrl' => Yii::app()->request->url
            ),
            array('class' => 'btn')
        ); ?>
    </div>
<?php endif; ?>
