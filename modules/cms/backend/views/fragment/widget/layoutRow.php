<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '行布局';
$editThemeId = $this->context->data['editThemeId'];
$layoutColumns = $this->context->query("select * from cms_theme_fragment t where t.fragmentType = 'layoutColumn' and t.themeId = :themeId")
    ->bindParam(":themeId",$editThemeId)->queryAll();

?>
<style>
    .table-label {
        width: 20%;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">行布局设置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>

                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragment['optionDesc']; ?>"
                           readonly="readonly">
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>

                <input type="hidden" name="FormFragment[properties]" id="fragment-properties" value="">

                <div class=" mb-3" id="page-properties">
                    <label class="control-label" >属性设置</label>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="table-label ">
                                <strong>CSS样式</strong>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="cssStyle">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label ">
                                <strong>自定义样式</strong>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="customStyle">
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>行布局内容</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-label table-widget" style="width: 100%;" id="table-info">
                                    <thead>
                                    <td>栅格内容</td>
                                    <td><i class="fa fa-plus-circle fa-lg text-success" onclick="addWidget()"></i></td>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <div style="display: none;">
                    <table class="table table-bordered " id="table-list-demo">
                        <tbody>
                        <tr>
                            <td>
                                <select class="form-control" name="column">
                                    <?php
                                    foreach ($layoutColumns as $column){
                                        ?>
                                        <option value="<?php echo $column['id']; ?>"><?php echo $column['fragmentName']; ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <i class="fa fa-plus-circle fa-lg text-success tool-add mr-1" title="添加" ></i>
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

    var propList = <?php echo $model->attributes['properties']; ?>;

    $(function () {
        $('#from-edit').on('beforeSubmit', function (e) {
            //设置内容

            var items = Array();
            var trs = $("#table-info tbody tr");
            if (trs.length > 0) {
                for (var i = 0; i < trs.length; i++) {
                    var widget = $(trs[i]).find("select[name=column]").val();
                    items.push(widget);
                }
            }

            var cssStyle = $("input[name=cssStyle]").val();
            var customStyle = $("input[name=customStyle]").val();

            var propObject = {
                'cssStyle':cssStyle,
                'customStyle':customStyle,
                'items':items
            };

            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        loadProperties();
    });

    function loadProperties() {
        if(propList.length!=0){
            $("input[name=cssStyle]").val(propList['cssStyle']);
            $("input[name=customStyle]").val(propList['customStyle']);
            var items = propList['items'];
            if(items.length>0){
                for(var i=0;i<items.length;i++){
                    addLoadWidget(items[i]);
                }
            }
        }
    }

    function addLoadWidget(widgetId) {
        var demotr = $("#table-list-demo tbody tr:first");
        var clone = demotr.clone();
        $(clone).find("select[name=column]").find("option[value="+widgetId+"]").attr("selected", true);
        $("#table-info tbody").append(clone);
        bindEvent();
    }

    function addWidget() {
        var demotr = $("#table-list-demo tbody tr:first");
        $("#table-info tbody").append(demotr.clone());
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
</script>
