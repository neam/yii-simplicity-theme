<?php
if (!isset($_GET['parent_form'])) {
    $this->renderPartial('vendor.phundament.p3media.views.import.upload');
    return;
}
?>

<ol>
    <li>
        <?php echo Yii::t('app', 'Drag & drop the file you wish to upload or use the select button below'); ?>
    </li>
    <li>
        <?php echo Yii::t('app', 'Click Start upload'); ?>
    </li>
    <li>
        <?php echo Yii::t('app', 'When upload has been completed, click Close to return to the previous form'); ?>
    </li>
</ol>

<style type="text/css">
    /* Some CSS hacks to clarify upload form */
    #fileupload form {
        margin-bottom: 0;
    }

    .fileupload-content {
        min-height: 100px;
    }

    td.progress {
        min-width: 100px;
    }

    .container {
        margin: 0;
        width: 100%;
    }

    body {
        margin: 0;
        padding-top: 0;
        padding-bottom: 60px;
    }

    .files .name {
        max-width: 85px;
        overflow-x: hidden;
    }
</style>

<script>

    $(function () {
        // Signal to parent window when a new p3 media object has been created
        $('#fileupload').bind('fileuploaddone', function (event, data) {
            var result = data.result[0];
            parent.window.$('#<?php echo $_GET['parent_form']; ?>-upload-iframe').trigger('done', result);

            var type = result.type;

            /**
             * Only add to queue if it's video
             */
            if(  type.split('/')[0] === 'video' && result.toQueue === true ){
                var url = '<?php echo Yii::app()->createAbsoluteUrl("/mq/addmovietoqueue") ?>',
                    queueData = {
                        movie_id : result['movie_id']
                    }
                $.get( url , queueData);
            }
        });

    });

</script>

<?php
$this->widget('jquery-file-upload-widget.EFileUpload');
?>
