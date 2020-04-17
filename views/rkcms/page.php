<section id="content">
    <div class="content-wrap nopadding" id="content-warp">
        <?php
        $editabled = false;
        if (isset($this->context->data['EDITABLED']) && $this->context->data['EDITABLED'] == 1) {
            $editabled = true;
        }

        $widgetJson = $this->context->data['CMS_PAGE']['widgetjson'];
        $widgetObject = json_decode($widgetJson, true);
        if ($widgetObject && sizeof($widgetObject) > 0) {
            foreach ($widgetObject as $widget) {
                if ($editabled) {
                    $wObject = \app\models\cms\backend\BKFragment::findOne($widget);
                    $cmsFragment = $this->context->query("select * from cms_fragment where fragmentKey = :fragmentKey")
                        ->bindParam(":fragmentKey", $wObject['fragmentType'])->queryOne();
                    ?>
                    <div class="editor-border" id="fragment-<?php echo $widget; ?>">
                        <div class="btn-group " style="position: absolute;right: 0px;z-index: 99;"
                             id="editor-content-tools-<?php echo $widget; ?>">
                            <?php
                            if ($cmsFragment['script'] == 'html') {
                                ?>
                                <button type="button" class="btn btn-primary "
                                        onclick="loadEditor(<?php echo $widget; ?>)"><i
                                        class="fa fa-pencil-square-o"></i></button>
                                <?php
                            }
                            ?>
                            <button type="button" class="btn btn-info" onclick="loadWidget(<?php echo $widget; ?>)"><i
                                    class="fa fa-plug"></i></button>
                            <button type="button" class="btn btn-success widget-handle"><i class="fa fa-arrows"></i>
                            </button>
                            <button type="button" class="btn btn-danger" onclick="delFragment(<?php echo $widget; ?>)">
                                <i class="fa fa-trash"></i></button>
                        </div>
                        <div class="editor-content-view" id="editor-content-view-<?php echo $widget; ?>">
                            <?php
                            $html = $this->context->renderFragment($widget);
                            echo $html;
                            ?>
                        </div>
                        <div class="editor-content-body" id="editor-content-body-<?php echo $widget; ?>">
                            <div id="editor-<?php echo $widget; ?>">
                                <?php
                                echo $html;
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                } else {
                    echo $this->context->renderFragment($widget);
                }

            }
        }
        ?>

    </div>
</section>