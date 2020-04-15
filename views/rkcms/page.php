<section id="content">
    <div class="content-wrap " id="content-warp">
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
                    ?>
                    <div class="editor-border" id="fragment-<?php echo $widget; ?>">
                        <?php
                        echo $this->context->renderFragment($widget);
                        ?>
                    </div>
                    <?php
                } else {
                    echo $this->context->renderFragment($widget);
                }

            }
        }


        if ($editabled) {
            ?>
            <div id="editor-dialog" title="组件编辑" style="display: none;">
                <p>This is the default dialog which is useful for displaying information. The dialog window can be
                    moved, resized and closed with the 'x' icon.</p>
            </div>
            <script>
                function loadEditor(widget) {
                    $("#editor-dialog").dialog({
                        modal: true,
                        resizable: false,
                        width: '1000',
                        height: '618',
                        buttons: {
                            "保存": function () {
                                $(this).dialog("close");
                            },
                            "取消": function () {
                                $(this).dialog("close");
                            }
                        }
                    });
                }

            </script>
            <?php
        }
        ?>

    </div>
</section>