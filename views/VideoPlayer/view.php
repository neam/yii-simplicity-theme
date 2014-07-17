<?php
/** @var VideoPlayer $this */
/** @var string $flashPlayerUrl */
/** @var string $srcLang */
/** @var P3Media[] $p3MediaFiles */
?>
<?php if ($this->videoExists()): ?>
    <video width="604" height="340" controls="controls" style="<?php echo $this->getStyles(); ?>"><!-- Not used preload="none" -->
        <?php foreach ($p3MediaFiles as $p3Media): ?>
            <source type="<?php echo $p3Media->mime_type; ?>" src="<?php echo $this->getVideoUrl($p3Media->id); ?>">
        <?php endforeach; ?>
        <track src="<?php echo $this->getSubtitleUrl(); ?>" kind="subtitles" srclang="<?php echo e($srcLang); ?>" default></track>
        <object width="604" height="346" type="application/x-shockwave-flash" data="<?php echo e($flashPlayerUrl); ?>">
            <param movie="<?php echo e($flashPlayerUrl); ?>">
            <param flashvars="controls=true&amp;amp;file=<?php echo $this->getRawVideoUrl(); ?>">
        </object>
    </video>
<?php else: ?>
    <div class="alert">
        <?php echo Yii::t('error', 'No media file available.'); ?>
    </div>
<?php endif; ?>
