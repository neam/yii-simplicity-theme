<?php
/* @var string $content */
?>
<!DOCTYPE html>
<html lang="<?php echo Yii::app()->language ?>"
      data-view="app"
      data-config='<?php echo app()->clientConfigJson(); ?>'>
<head>
    <meta charset="utf-8">
    <meta name="language" content="en"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link rel="icon" href="<?php echo baseUrl('favicon.ico'); ?>" type="image/x-icon"/>
    <?php app()->registerCss(); ?>
    <?php app()->registerScripts(); ?>
    <?php app()->yiistrap->fixPanningAndZooming(); ?>
    <?php app()->clientScript->registerCoreScript('jquery', CClientScript::POS_END); ?>
    <?php /* TODO: Move this into the js-app feature branch and remove from develop ?>
    <?php js('js/lib/requirejs/require.js', CClientScript::POS_HEAD);
    <script type="text/javascript">
        // Set up the application through RequireJS.
        require(['require', '<?php echo baseUrl('js/config.js?_=' . app()->resolveCacheBuster()); ?>'], function(require) {
            require(['main']);
        });
    </script>
    */ ?>
</head>
<body>
<?php echo $content; ?>
</body>
</html>
