<?php
/** @var integer $currentStepNumber */
/** @var integer $totalStepCount */
?>
<div class="step-progress">
    <div class="progress-dots">
        <ul class="step-progress-dots">
            <?php for ($i = 1; $i <= $totalStepCount; $i++): ?>
                <?php if ((int) $i <= (int) $currentStepNumber): ?>
                    <li class="active"></li>
                <?php else: ?>
                    <li></li>
                <?php endif; ?>
            <?php endfor; ?>
        </ul>
    </div>
    <div class="progress-text">
        <?php echo Yii::t(
            'app', 'Step {currentStep} of {totalSteps}',
            array(
                '{currentStep}' => $currentStepNumber,
                '{totalSteps}' => $totalStepCount,
            )
        ); ?>
    </div>
</div>
