<?php
/** @var DashboardTaskList $this */
?>
<div class="tasks-top-bar">
    <div class="top-bar-title">
        <h2 class="tasks-heading">
            <?php echo ($this->type === DashboardTaskList::TYPE_NEW)
                ?  Yii::t('app', 'New Tasks ({count})', array('{count}' => $this->dataProvider->totalItemCount))
                :  Yii::t('app', 'Started Tasks ({count})', array('{count}' => $this->dataProvider->totalItemCount)); ?>
        </h2>
    </div>
</div>
<div class="row">
    <div class="tasks">
        <ul class="tasks-list">
            <?php $this->widget(
                'yiistrap.widgets.TbListView',
                array(
                    'dataProvider' => $this->dataProvider,
                    'itemView' => '_task',
                    'template' => '{items} {pager}',
                )
            ); ?>
        </ul>
    </div>
</div>