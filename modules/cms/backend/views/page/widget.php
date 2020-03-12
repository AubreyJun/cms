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
                                组件类型
                            </td>
                            <td class="text-center">
                                组件
                            </td>
                            <td width="20%">
                                <i class="fa fa-plus-circle fa-lg text-success"
                                   onclick="addWidget()"></i>
                            </td>
                        </tr>
                        </thead>
                        <tbody>
                        <?php

                        if($widgetObject && sizeof($widgetObject)>0) {
                            foreach ($widgetObject as $widget) {
                                $widgetList = $this->context->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                                    ->bindParam(":fragmentType",$widget['widgetType'])
                                    ->bindParam(":themeId",$this->context->data['editThemeId'])
                                    ->queryAll();

                                ?>
                                <tr>
                                    <td>
                                        <select class="form-control" name="widgetType" onchange="loadWidgetIds(this.value,this)" >
                                            <?php
                                            foreach ($widgets as $widgetitem){
                                                if($widget['widgetType']==$widgetitem['optionValue']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $widgetitem['optionValue']; ?>"><?php echo $widgetitem['optionDesc']; ?></option>
                                                    <?php
                                                }else{
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
                                            <?php
                                            foreach ($widgetList as $witem){
                                                if($witem['id']==$widget['widgetId']){
                                                    ?>
                                                    <option selected="selected" value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                                    <?php
                                                }else{
                                                    ?>
                                                    <option value="<?php echo $witem['id']; ?>"><?php echo $witem['fragmentName']; ?></option>
                                                    <?php
                                                }
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
                    <table class="table table-bordered " id="table-list-demo">
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="widgetType" onchange="loadWidgetIds(this.value,this)" >
                                    <?php
                                    foreach ($widgets as $widget){
                                        ?>
                                        <option  value="<?php echo $widget['optionValue']; ?>"><?php echo $widget['optionDesc']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select class="form-control" name="widgetId">
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
        bindEvent();
    });

    function loadProperties() {
        if(widgetJson.length!=0){
            for(var i=0;i<widgetJson.length;i++){
                addLoadWidget(widgetJson[i]);
            }
        }
    }

    function addLoadWidget(widget) {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        $(clone).find("select[name=widgetType]").val(widget['widgetType']);
        $.post('index.php?r=cms-backend/page/getwidget',{
            "widgetType":widget['widgetType'],
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>'
        },function (data) {
            if(data.length>0){

                var html = "";
                for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i]['id']+'">'+data[i]['fragmentName']+'</option>';
                }
                $(clone).find("select[name=widgetId]").html(html);
            }else{
                $(clone).find("select[name=widgetId]").html("<option value='0'>无</option>");
            }
            $("#page-widget tbody").append(clone);
            bindEvent();
        },'json');
    }

    function addWidget() {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        var widgetType = $(clone).find("select[name=widgetType]").val();

        $.post('index.php?r=cms-backend/page/getwidget',{
            "widgetType":widgetType,
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>'
        },function (data) {
            if(data.length>0){

                var html = "";
                for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i]['id']+'">'+data[i]['fragmentName']+'</option>';
                }
                $(clone).find("select[name=widgetId]").html(html);
            }else{
                $(clone).find("select[name=widgetId]").html("<option value='0'>无</option>");
            }
            $("#page-widget tbody").append(clone);
            bindEvent();
        },'json');
    }

    function loadWidgetIds(widgetType,object) {
        $.post('index.php?r=cms-backend/page/getwidget',{
            "widgetType":widgetType,
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>'
        },function (data) {
            if(data.length>0){

                var html = "";
                for(var i=0;i<data.length;i++){
                    html += '<option value="'+data[i]['id']+'">'+data[i]['fragmentName']+'</option>';
                }
                $(object).closest("tr").find("select[name=widgetId]").html(html);
            }else{
                $(object).closest("tr").find("select[name=widgetId]").html("<option value='0'>无</option>");
            }
        },'json');
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
        var trs = $("#page-widget tbody tr");

        var widgets = new Array();
        if(trs.length>0){
            for (var j = 0; j < trs.length; j++) {
                var widgetType = $(trs[j]).find("select[name=widgetType]").val();
                var widgetId = $(trs[j]).find("select[name=widgetId]").val();
                widgets.push({
                    'widgetType':widgetType,
                    'widgetId':widgetId
                });
            }
        }

        var widgetsJSON = JSON.stringify(widgets);
        $("input[name=widgetJSON]").val(widgetsJSON);

        $("#from-edit").submit();

    }
</script>
