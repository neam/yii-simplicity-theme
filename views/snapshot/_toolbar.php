<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        // TODO: Render these buttons more elegantly.
        switch ($this->action->id) {
            case "index":
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Manage"),
                    "icon" => "glyphicon-edit",
                    "url" => array("admin")
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Add"),
                    "icon" => "glyphicon-plus",
                    "url" => array("add")
                ));
                break;
            case "view":
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Manage"),
                    "icon" => "glyphicon-edit",
                    "url" => array("admin")
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Edit"),
                    "icon" => "glyphicon-edit",
                    "url" => array("continueAuthoring", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Update"),
                    "icon" => "glyphicon-edit",
                    "url" => array("update", "id" => $model->{$model->tableSchema->primaryKey})
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Delete"),
                    "color" => TbHtml::BUTTON_COLOR_DANGER,
                    "icon" => "glyphicon-remove icon-white",
                    "htmlOptions" => array(
                        "submit" => array("delete", "id" => $model->{$model->tableSchema->primaryKey}, "returnUrl" => (Yii::app()->request->getParam("returnUrl")) ? Yii::app()->request->getParam("returnUrl") : $this->createUrl("admin")),
                        "confirm" => Yii::t("model", "Do you want to delete this item?"))
                ));
                break;
        }
        ?>
    </div>
</div>
