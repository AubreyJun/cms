<?php $this->title = '页面片段'; ?>
<?php

$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson,true);

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
                        <h4 class="card-title">页面</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" id="from-edit" style="float: right;" method="post"
                              action="index.php?r=cms-backend/page/savewidget">
                            <input type="hidden" name="id" value="<?= $page['id']; ?>">
                            <input type="hidden" name="widgetJSON" value="">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                            <div class="form-group mr-2">

                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-success btn-xs" onclick="preView(<?= $page['id']; ?>)"><i
                                            class="fa fa-eye fa-lg"></i>预览
                                </button>
                                <button type="button" class="btn btn-primary btn-xs" onclick="saveWidget()"><i
                                            class="fa fa-save fa-lg"></i>保存
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <table class="table table-bordered table-widget  mb-3" id="pageWidgets">
                        <thead>
                        <tr>
                            <td class="text-center" width="80%">
                                组件
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success mr-1"
                                   onclick="addWidget('pageWidgets')"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        foreach ($widgetObject as $widget) {
                            ?>
                            <tr>
                                <td>
                                    <select class="form-control" name="widgetId">
                                        <?php
                                        foreach ($widgetList as $witem) {
                                            if ($witem['id'] == $widget) {
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
                                <td width="20%">
                                    <i class="fa fa-arrows fa-lg text-success mr-1 handle" title="顺序"></i>
                                    <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                                </td>
                            </tr>
                            <?php
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
                                    <option value='0'>无</option>
                                    <?php
                                    foreach ($widgetList as $witem) {
                                        ?>
                                        <option value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td width="20%">
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

    var dragger = null;

    $(function () {
        bindEvent();
    });


    function addWidget(tableId) {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        $("#"+tableId+" tbody").append(clone);
        bindEvent();
    }

    function preView(pageId) {
        window.open("index.php?r=cms-backend/page/preview&pageId="+pageId);
    }


    function bindEvent() {
        $(".table-widget tbody .tool-delete").unbind("click");
        $(".table-widget tbody .tool-delete").bind("click", function () {
            $(this).closest("tr").remove();
        });

        dragger = resetDrag(dragger,"#pageWidgets");
    }

    function resetDrag(dragger,pageId) {
        if (dragger == null) {
            if($(pageId).find("tbody tr").length>0){
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

    function saveWidget() {
        var widgets = getWidget('Widgets');
        var widgetsJSON = JSON.stringify(widgets);
        $("input[name=widgetJSON]").val(widgetsJSON);
        $("#from-edit").submit();

    }

    function getWidget(position) {
        //获取widgetLayout
        var trs = $("#page"+position+" tbody tr");

        var widgets = new Array();
        if (trs.length > 0) {
            for (var j = 0; j < trs.length; j++) {
                var widgetId = $(trs[j]).find("select[name=widgetId]").val();
                widgets.push(widgetId);
            }
        }

        return widgets;
    }
</script>
