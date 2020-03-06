<?php $this->title = '页面片段'; ?>
<?php
$widgetJson = $page['widgetjson'];
$widgetJsonObject = null;
if ($widgetJson!=null && $widgetJson!='') {
    $widgetJsonObject = json_decode($widgetJson, true);
}
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
                            <input type="hidden" name="widgetJSON" value="<?php echo $widgetJson; ?>">
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
                    <table class="table table-bordered table-widget" id="page-widget" >
                        <thead>
                        <tr>
                            <td class="text-center">
                                片段
                            </td>
                            <td width="40%">
                                <i class="fa fa-plus-circle fa-lg text-success"
                                   onclick="addWidget()"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if($widgetJsonObject!=null){
                            foreach ($widgetJsonObject as $widgetId) {
                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control">
                                            <?php
                                            foreach ($fragmentList as $fragment) {
                                                ?>
                                                <optgroup label="<?php echo $fragment['type']['optionDesc']; ?>">
                                                    <?php
                                                    foreach ($fragment['list'] as $item) {
                                                        if ($widgetId == $item['id']) {
                                                            ?>
                                                            <option selected="selected"
                                                                    value="<?php echo $item['id']; ?>"><?php echo $item['fragmentName']; ?></option>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <option value="<?php echo $item['id']; ?>"><?php echo $item['fragmentName']; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </optgroup>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                    <td>
                                        <i class="fa fa-arrow-up fa-lg text-success mr-1 tool-up" title="上移"></i>
                                        <i class="fa fa-arrow-down fa-lg text-warning  mr-1 tool-down" title="下移"></i>
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
                    <table class="table table-bordered " id="table-fragment-demo">
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control">
                                    <?php
                                    foreach ($fragmentList as $fragment) {
                                        ?>
                                        <optgroup label="<?php echo $fragment['type']['optionDesc']; ?>">
                                            <?php
                                            foreach ($fragment['list'] as $item) {
                                                ?>
                                                <option value="<?php echo $item['id']; ?>"><?php echo $item['fragmentName']; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </optgroup>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <i class="fa fa-arrow-up fa-lg text-success mr-1 tool-up" title="上移"></i>
                                <i class="fa fa-arrow-down fa-lg text-warning  mr-1 tool-down" title="下移"></i>
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
    $(function () {

    });

    function addWidget(widgetTable) {
        var demotr = $("#table-fragment-demo tbody tr:first");
        $("#page-widget tbody").append(demotr.clone());
        bindEvent();
    }

    function bindEvent() {
        $(".table-widget tbody .tool-delete").unbind("click");
        $(".table-widget tbody .tool-up").unbind("click");
        $(".table-widget tbody .tool-down").unbind("click");

        $(".table-widget tbody .tool-delete").bind("click", function () {
            $(this).closest("tr").remove();
        });
        $(".table-widget tbody .tool-up").bind("click", function () {
            var prevTr = $(this).closest("tr").prev("tr");
            var currentTr = $(this).closest("tr");
            if (prevTr) {
                prevTr.before(currentTr);
            }
        });
        $(".table-widget tbody .tool-down").bind("click", function () {
            var nextTr = $(this).closest("tr").next("tr");
            var currentTr = $(this).closest("tr");
            if (nextTr) {
                nextTr.after(currentTr);
            }
        });
    }

    function saveWidget() {
        //获取widgetLayout
        var tableWidgets = $(".table-widget");

        var widgets = new Array();
        var selects = $(tableWidgets[0]).find("select");
        for (var j = 0; j < selects.length; j++) {
            var value = $(selects[j]).val();
            widgets.push(value);
        }

        var widgetsJSON = JSON.stringify(widgets);
        $("input[name=widgetJSON]").val(widgetsJSON);

        $("#from-edit").submit();

    }
</script>
