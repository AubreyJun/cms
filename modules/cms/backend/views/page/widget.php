<?php $this->title = '页面片段'; ?>
<?php

$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson, true);

$pageId = $page['id'];

$widgetList = $this->context->query("select * from cms_theme_fragment where themeId = :themeId and (pageId = 0 or pageId = :pageId)")
    ->bindParam(":pageId",$pageId)
    ->bindParam(":themeId", $this->context->data['editThemeId'])
    ->queryAll();
?>
<style>
    .ui-sortable-handle{
        clear: both;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">页面</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" id="form-edit" style="float: right;" method="post"
                              action="index.php?r=cms-backend/page/savewidget">
                            <input type="hidden" name="id" value="<?= $page['id']; ?>">
                            <input type="hidden" name="viewThemeId" value="<?= $page['themeId']; ?>">
                            <input type="hidden" name="widgetJSON" value="">
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                            <div class="form-group mr-2">
                                <select class="form-control form-control-sm select2"  name="pageId"
                                        onchange="changeType(this.value)">
                                    <?php
                                    foreach ($pagelist as $item) {
                                        if ($item['id'] == $page['id']) {
                                            ?>
                                            <option selected="selected"
                                                    value="<?php echo $item['id']; ?>"><?php echo $item['pageName']; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $item['id']; ?>"><?php echo $item['pageName']; ?></option>
                                            <?php
                                        }

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-info btn-xs" onclick="addWidget()"><i
                                            class="fa fa-plug fa-lg"></i>增加组件
                                </button>
                                <button type="button" class="btn btn-success btn-xs"
                                        onclick="preView('<?= $page['pagePath']; ?>')"><i
                                            class="fa fa-desktop fa-lg"></i>预览
                                </button>
                                <button type="button" class="btn btn-primary btn-xs" onclick="saveWidget()"><i
                                            class="fa fa-save fa-lg"></i>保存
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="pageWidgets">
                    <?php
                    if ($widgetObject != null && sizeof($widgetObject) > 0) {
                        foreach ($widgetObject as $widget) {
                            ?>
                            <div class=" mb-2 clearfix">
                                <table class="table table-bordered rounded">
                                    <tbody>
                                    <td width="80%">
                                        <select class="form-control select2" name="widgetId">
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
                                    <td  width="20%">
                                        <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                                    </td>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <div style="display: none;"  id="table-list-demo">
                    <div class=" mb-2 clearfix">
                        <table class="table table-bordered rounded">
                            <tbody>
                            <tr>
                                <td width="80%">
                                    <select class="form-control " name="widgetId">
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
</div>
<script src="static/backend/lib/jquery-ui/jquery-ui.min.js"></script>
<script>

    var dragger = null;

    $(function () {
        bindEvent();
    });


    function addWidget(tableId) {
        var demotr = $("#table-list-demo div:first");
        var clone = demotr.clone();
        $("#pageWidgets").append(clone);
        $("#pageWidgets").find("div:last").find("select").select2();
        bindEvent();
    }

    function preView(pagePath) {
        // var widgets = getWidget();
        // var widgetsJSON = JSON.stringify(widgets);
        // $("input[name=widgetJSON]").val(widgetsJSON);
        $("#form-edit").attr("action", pagePath+".html");
        $("#form-edit").attr("target", "_blank");
        $("#form-edit").submit();
    }


    function bindEvent() {
        $("#pageWidgets tbody .tool-delete").unbind("click");
        $("#pageWidgets tbody .tool-delete").bind("click", function () {
            $(this).closest("div").remove();
        });

        $("#pageWidgets").sortable();
        $("#pageWidgets").disableSelection();
    }

    function saveWidget() {
        var widgets = getWidget();
        var widgetsJSON = JSON.stringify(widgets);
        $("input[name=widgetJSON]").val(widgetsJSON);
        $("#form-edit").attr("action", "index.php?r=cms-backend/page/savewidget");
        $("#form-edit").attr("target", "");
        $("#form-edit").submit();

    }

    function getWidget() {
        //获取widgetLayout
        var trs = $("#pageWidgets div");

        var widgets = new Array();
        if (trs.length > 0) {
            for (var j = 0; j < trs.length; j++) {
                var widgetId = $(trs[j]).find("select[name=widgetId]").val();
                widgets.push(widgetId);
            }
        }

        return widgets;
    }

    function changeType(pageId) {
        window.location.href = "index.php?r=cms-backend/page/widget&id="+pageId;
    }
</script>
