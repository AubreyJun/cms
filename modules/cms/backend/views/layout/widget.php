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
                        <h4 class="card-title">【HEAD】片段</h4>
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
                                <button type="button" class="btn btn-success btn-xs" onclick="saveWidget()"><i
                                            class="fa fa-save fa-lg"></i>保存布局
                                </button>
                                <button type="button" class="btn btn-primary btn-xs" onclick="addWidget('layout-header')"><i
                                            class="fa fa-plug fa-lg"></i>添加组件
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="layout-header">
                    <?php
                    if ($widgetObject['header'] != null && sizeof($widgetObject['header']) > 0) {
                        foreach ($widgetObject['header'] as $widget) {
                            ?>
                            <div class=" mb-2 clearfix">
                                <table class="table table-bordered rounded">
                                    <tbody>
                                    <td width="80%">
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
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">【内容上方】片段</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline " style="float: right;" >
                            <div class="form-group mr-2">

                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs" onclick="addWidget('content-top')"><i
                                            class="fa fa-plug fa-lg"></i>添加组件
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="content-top">
                    <?php
                    if ($widgetObject['top'] != null && sizeof($widgetObject['top']) > 0) {
                        foreach ($widgetObject['top'] as $widget) {
                            ?>
                            <div class=" mb-2 clearfix">
                                <table class="table table-bordered rounded">
                                    <tbody>
                                    <td width="80%">
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
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">【内容下方】片段</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline " style="float: right;" >
                            <div class="form-group mr-2">

                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs" onclick="addWidget('content-footer')"><i
                                            class="fa fa-plug fa-lg"></i>添加组件
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div id="content-footer">
                    <?php
                    if ($widgetObject['footer'] != null && sizeof($widgetObject['footer']) > 0) {
                        foreach ($widgetObject['footer'] as $widget) {
                            ?>
                            <div class=" mb-2 clearfix">
                                <table class="table table-bordered rounded">
                                    <tbody>
                                    <td width="80%">
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
            </div>
        </div>
    </div>
</div>
<div style="display: none;"  id="table-list-demo">
    <div class=" mb-2 clearfix">
        <table class="table table-bordered rounded">
            <tbody>
            <tr>
                <td width="80%">
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
                    <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="static/backend/lib/jquery-ui/jquery-ui.min.js"></script>
<script>

    var dragger_header = null;
    var dragger_top = null;
    var dragger_footer = null;

    $(function () {
        bindEvent("content-footer");
        bindEvent("content-top");
        bindEvent("layout-header");
    });


    function addWidget(obj) {
        var demotr = $("#table-list-demo div:first");
        var clone = demotr.clone();
        $("#"+obj).append(clone);
        bindEvent();
    }

    function bindEvent(object) {
        $("#"+object+" tbody .tool-delete").unbind("click");
        $("#"+object+" tbody .tool-delete").bind("click", function () {
            $(this).closest("div").remove();
        });

        $("#"+object).sortable();
        $("#"+object).disableSelection();
    }


    function getWidgets(id) {
        var trs = $("#"+id+" div");
        var widgets = new Array();
        if (trs.length > 0) {
            for (var j = 0; j < trs.length; j++) {
                var widgetId = $(trs[j]).find("select[name=widgetId]").val();
                widgets.push(widgetId);
            }
        }

        return widgets;
    }

    function saveWidget() {

        var headerWidgets = getWidgets("layout-header");
        var topWidgets = getWidgets("content-top");
        var footerWidgets = getWidgets("content-footer");

        var jsonObject = {
            'header': headerWidgets,
            'top':topWidgets,
            'footer': footerWidgets
        };
        var widgetsJSON = JSON.stringify(jsonObject);
        $("input[name=widgetJSON]").val(widgetsJSON);

        $("#from-edit").submit();

    }
</script>
