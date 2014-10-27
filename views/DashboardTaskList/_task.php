<?php
/** @var DashboardTaskList $this */
/** @var array $data */
?>
<li class="tasks-list-item">
    <div class="task" id="<?php echo $this->createTaskId($data); ?>">
        <?php $this->render("_{$data['task']}Task", array('data' => $data)); ?>
    </div>
</li>
