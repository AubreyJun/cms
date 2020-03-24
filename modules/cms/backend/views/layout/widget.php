<?php $this->title = '布局组件设置'; ?>
<?php

$widgetjson = $layout['widgetjson'];
$widgetObject = json_decode($widgetjson, true);

$widgetList = $this->context->query("select * from cms_theme_fragment where themeId = :themeId")
    ->bindParam(":themeId", $this->context->data['editThemeId'])
    ->queryAll();


?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">布局组件设置</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" id="from-edit" style="float: right;" method="post"
                              action="index.php?r=cms-backend/layout/savewidget">
                            <input type="hidden" name="id" value="<?= $layout['id']; ?>">
                            <input type="hidden" name="widgetJSON" value="">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                            <div class="form-group mr-2">

                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs" onclick="saveWidget()"><i
                                            class="fa fa-save fa-lg"></i>保存
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <table class="table table-bordered table-widget mb-3" id="headWidget">
                        <thead>
                        <tr>
                            <td class="text-center" width="80%">
                                【头部片段】片段
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success"
                                   onclick="addWidget(this)"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($widgetObject && sizeof($widgetObject['header']) > 0) {
                            foreach ($widgetObject['header'] as $widget) {
                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="widgetId">
                                            <?php
                                            foreach ($widgetList as $witem) {
                                                if ($witem['id'] == $widget['widgetId']) {
                                                    ?>
                                                    <option selected="selected"
                                                            value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <i class="fa fa-arrows fa-lg text-success mr-1 handle" title="顺序"></i>
                                        <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <table class="table table-bordered table-widget mb-3" id="footerWidget">
                        <thead>
                        <tr>
                            <td class="text-center" width="80%">
                                【底部片段】组件
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success"
                                   onclick="addWidget(this)"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($widgetObject && sizeof($widgetObject['footer']) > 0) {
                            foreach ($widgetObject['footer'] as $widget) {
                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="widgetId">
                                            <?php
                                            foreach ($widgetList as $witem) {
                                                if ($witem['id'] == $widget['widgetId']) {
                                                    ?>
                                                    <option selected="selected"
                                                            value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <i class="fa fa-arrows fa-lg text-success mr-1 handle" title="顺序"></i>
                                        <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                                    </td>
                                </tr>
                                <?php
                            }
                        }

                        ?>
                        </tbody>
                    </table>
                </div>

                <div style="display: none;">
                    <table class="table table-bordered " id="table-list-demo">
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="widgetId">
                                    <?php
                                    foreach ($widgetList as $witem) {
                                        ?>
                                        <option value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <i class="fa fa-arrows fa-lg text-success mr-1 handle" title="顺序"></i>
                                <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>

    var dragger_header = null;
    var dragger_footer = null;

    $(function () {
        bindEvent();
    });

    // function loadProperties() {
    //     if(widgetJson.length!=0){
    //         for(var i=0;i<widgetJson.length;i++){
    //             addLoadWidget(widgetJson[i]);
    //         }
    //     }
    // }

    function resetDrag(dragger, pageId) {
        if (dragger == null) {
            if ($(pageId).find("tbody tr").length > 0) {
                dragger = tableDragger(document.querySelector(pageId), {
                    mode: "row",
                    onlyBody: true,
                    dragHandler: ".handle"
                });
            }
        } else {
            dragger.destroy();
            dragger = tableDragger(document.querySelector(pageId), {
                mode: "row",
                onlyBody: true,
                dragHandler: ".handle"
            });
        }
        return dragger;
    }

    function addWidget(obj) {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        $(obj).closest("table").find("tbody").append(clone);
        bindEvent();
    }

    function loadWidgetIds(widgetType, object) {
        $.post('index.php?r=cms-backend/page/getwidget', {
            "widgetType": widgetType,
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>'
        }, function (data) {
            if (data.length > 0) {

                var html = "";
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i]['id'] + '">' + data[i]['fragmentName'] + '</option>';
                }
                $(object).closest("tr").find("select[name=widgetId]").html(html);
            } else {
                $(object).closest("tr").find("select[name=widgetId]").html("<option value='0'>无</option>");
            }
        }, 'json');
    }

    function bindEvent() {
        $(".table-widget tbody .tool-delete").unbind("click");
        $(".table-widget tbody .tool-delete").bind("click", function () {
            $(this).closest("tr").remove();
        });

        dragger_header = resetDrag(dragger_header, "#headWidget");
        dragger_footer = resetDrag(dragger_footer, "#footerWidget");
    }


    function getWidgets(id) {
        var trs = $("#" + id + " tbody tr");

        var widgets = new Array();
        if (trs.length > 0) {
            for (var j = 0; j < trs.length; j++) {
                var widgetType = $(trs[j]).find("select[name=widgetType]").val();
                var widgetId = $(trs[j]).find("select[name=widgetId]").val();
                widgets.push({
                    'widgetType': widgetType,
                    'widgetId': widgetId
                });
            }
        }

        return widgets;
    }

    function saveWidget() {
        var headerWidgets = getWidgets("header-widget");
        var footerWidgets = getWidgets("footer-widget");

        var jsonObject = {
            'header': headerWidgets,
            'footer': footerWidgets
        };
        var widgetsJSON = JSON.stringify(jsonObject);
        $("input[name=widgetJSON]").val(widgetsJSON);

        $("#from-edit").submit();

    }
</script>
