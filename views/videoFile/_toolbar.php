<div class="btn-toolbar">
    <div class="btn-group">
        <?php
        switch ($this->action->id) {
            case "index":
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Manage"),
                    "icon" => "glyphicon-edit",
                    "url" => array("admin"),
                    "visible" => Yii::app()->user->checkAccess("VideoFile.*")
                ));
                $this->widget("\TbButton", array(
                    "label" => Yii::t("model", "Add"),
                    "icon" => "glyphicon-plus",
                    "url" => array("add"),
                    "visible" => Yii::app()->user->checkAccess("Add")
                ));
                break;
        }
        ?>
    </div>
</div>
