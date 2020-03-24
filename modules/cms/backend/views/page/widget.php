<?php $this->title = '页面片段'; ?>
<?php

$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson,true);


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
                    <table class="table table-bordered table-widget mb-3" id="pageTop">
                        <thead>
                        <tr>
                            <td class="text-center" width="40%">
                                【内容上方】组件类型
                            </td>
                            <td class="text-center" width="40%">
                                组件
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success mr-1"
                                   onclick="addWidget('pageTop')"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if ($widgetObject['top'] && sizeof($widgetObject['top']) > 0) {
                            foreach ($widgetObject['top'] as $widget) {
                                $widgetList = $this->context->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                                    ->bindParam(":fragmentType", $widget['widgetType'])
                                    ->bindParam(":themeId", $this->context->data['editThemeId'])
                                    ->queryAll();

                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="widgetType"
                                                onchange="loadWidgetIds(this.value,this)">
                                            <?php
                                            foreach ($widgets as $widgetitem) {
                                                if ($widget['widgetType'] == $widgetitem['optionValue']) {
                                                    ?>
                                                    <option selected="selected"
                                                            value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="widgetId">
                                            <option value='0'>无</option>
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
                                    <td width="20%">
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
                    <table class="table table-bordered table-widget  mb-3" id="pageMiddle">
                        <thead>
                        <tr>
                            <td class="text-center" width="40%">
                                【内容中部】组件类型
                            </td>
                            <td class="text-center" width="40%">
                                组件
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success mr-1"
                                   onclick="addWidget('pageMiddle')"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if ($widgetObject['middle'] && sizeof($widgetObject['middle']) > 0) {
                            foreach ($widgetObject['middle'] as $widget) {
                                $widgetList = $this->context->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                                    ->bindParam(":fragmentType", $widget['widgetType'])
                                    ->bindParam(":themeId", $this->context->data['editThemeId'])
                                    ->queryAll();

                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="widgetType"
                                                onchange="loadWidgetIds(this.value,this)">
                                            <?php
                                            foreach ($widgets as $widgetitem) {
                                                if ($widget['widgetType'] == $widgetitem['optionValue']) {
                                                    ?>
                                                    <option selected="selected"
                                                            value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="widgetId">
                                            <option value='0'>无</option>
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
                                    <td width="20%">
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
                    <table class="table table-bordered table-widget  mb-3" id="pageBottom">
                        <thead>
                        <tr>
                            <td class="text-center" width="40%">
                                【内容下方】组件类型
                            </td>
                            <td class="text-center" width="40%">
                                组件
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success mr-1"
                                   onclick="addWidget('pageBottom')"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if ($widgetObject['bottom'] && sizeof($widgetObject['bottom']) > 0) {
                            foreach ($widgetObject['bottom'] as $widget) {
                                $widgetList = $this->context->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                                    ->bindParam(":fragmentType", $widget['widgetType'])
                                    ->bindParam(":themeId", $this->context->data['editThemeId'])
                                    ->queryAll();

                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="widgetType"
                                                onchange="loadWidgetIds(this.value,this)">
                                            <?php
                                            foreach ($widgets as $widgetitem) {
                                                if ($widget['widgetType'] == $widgetitem['optionValue']) {
                                                    ?>
                                                    <option selected="selected"
                                                            value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select class="form-control" name="widgetId">
                                            <option value='0'>无</option>
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
                                    <td width="20%">
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
                                <select class="form-control" name="widgetType"
                                        onchange="loadWidgetIds(this.value,this)">
                                    <?php
                                    foreach ($widgets as $widget) {
                                        ?>
                                        <option value="<?php echo $widget['optionValue']; ?>"><?php echo $widget['optionDesc']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="widgetId">
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

    var dragger_top = null;
    var dragger_middle = null;
    var dragger_bottom = null;

    $(function () {
        bindEvent();
    });

    function loadProperties() {
        if (widgetJson.length != 0) {
            for (var i = 0; i < widgetJson.length; i++) {
                addLoadWidget(widgetJson[i]);
            }
        }
    }

    function addLoadWidget(widget) {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        $(clone).find("select[name=widgetType]").val(widget['widgetType']);
        $.post('index.php?r=cms-backend/page/getwidget', {
            "widgetType": widget['widgetType'],
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>'
        }, function (data) {
            if (data.length > 0) {

                var html = "";
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i]['id'] + '">' + data[i]['fragmentName'] + '</option>';
                }
                $(clone).find("select[name=widgetId]").html(html);
            } else {
                $(clone).find("select[name=widgetId]").html("<option value='0'>无</option>");
            }
            $("#page-widget tbody").append(clone);
            bindEvent();
        }, 'json');
    }

    function addWidget(tableId) {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        var widgetType = $(clone).find("select[name=widgetType]").val();

        $.post('index.php?r=cms-backend/page/getwidget', {
            "widgetType": widgetType,
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>'
        }, function (data) {
            if (data.length > 0) {

                var html = "";
                for (var i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i]['id'] + '">' + data[i]['fragmentName'] + '</option>';
                }
                $(clone).find("select[name=widgetId]").html(html);
            } else {
                $(clone).find("select[name=widgetId]").html("<option value='0'>无</option>");
            }
            $("#"+tableId+" tbody").append(clone);
            bindEvent();
        }, 'json');
    }

    function preView(pageId) {
        window.open("index.php?r=cms-frontend/page/index&pageType=<?php echo $page['pageType']; ?>&pageId="+pageId);
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

        dragger_top = resetDrag(dragger_top,"#pageTop");
        dragger_middle = resetDrag(dragger_middle,"#pageMiddle");
        dragger_bottom = resetDrag(dragger_bottom,"#pageBottom");
    }

    function resetDrag(dragger,pageId) {
        if (dragger == null) {
            if($(pageId).find("tbody tr").length>0){
                dragger = tableDragger(document.quresetDragerySelector(pageId), {
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
        var top = getWidget('Top');
        var middle = getWidget('Middle');
        var bottom = getWidget('Bottom');
        var propObject = {
            'top':top,
            'middle':middle,
            'bottom':bottom
        };
        var widgetsJSON = JSON.stringify(propObject);
        $("input[name=widgetJSON]").val(widgetsJSON);

        $("#from-edit").submit();

    }

    function getWidget(position) {
        //获取widgetLayout
        var trs = $("#page"+position+" tbody tr");

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
</script>
