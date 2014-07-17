<?php
/* @var AccountController $this */
/* @var Account $model */
/* @var CActiveDataProvider $dataProvider */
/* @var array $columns */
?>
<?php
$this->setPageTitle(
    Yii::t('model', 'Accounts')
    . ' - '
    . Yii::t('model', 'Manage')
);
?>
<div class="account-controller admin-action">
    <h1>
        <?php echo Yii::t('model', 'Accounts'); ?>
        <small><?php echo Yii::t('model', 'Manage'); ?></small>
    </h1>
    <?php $this->widget(
        'TbGridView',
        array(
            'id' => 'account-grid',
            'dataProvider' => $dataProvider,
            'template' => '{pager}{items}{pager}',
            'pager' => array(
                'class' => '\TbPager',
                'hideFirstAndLast' => false,
            ),
            'columns' => $columns,
        )
    ); ?>
</div>