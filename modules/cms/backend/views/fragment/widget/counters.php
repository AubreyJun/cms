<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '数据统计';

$properties = $fragment['properties'];
$propObject = json_decode($properties, true);


?>
<style>
    .table-label {
        width: 20%;
    }
</style>
<script>
    var widgetList = {};
</script>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">数据统计</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragmentType['optionDesc']; ?>"
                           readonly="readonly">
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>


                <div class="mb-3">
                    <input type="hidden" name="FormFragment[properties]" id="fragment-properties" value="">

                    <label class="control-label" >属性设置</label>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="table-label"><strong>外部Container</strong></td>
                            <td>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <?php
                                        if ($propObject['container'] == '1') {
                                            ?>
                                            <input type="checkbox" name="container" value="1" class="form-check-input"
                                                   checked="checked">
                                            <?php
                                        } else {
                                            ?>
                                            <input type="checkbox" name="container" value="1" class="form-check-input">
                                            <?php
                                        }
                                        ?>
                                        设置</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label ">
                                <strong>类型</strong>
                            </td>
                            <td>
                                <select class="form-control" name="iconType">
                                    <option value="three">三格</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <strong>内容</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-bordered table-widget" style="width: 100%;"
                                       id="table-list">
                                    <thead>
                                    <td>ICON</td>
                                    <td>标题</td>
                                    <td>标题颜色</td>
                                    <td>数字</td>
                                    <td style="width: 20%;"><i class="fa fa-plus-circle fa-lg text-success"
                                                               onclick="addWidget()"></i></td>
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
                    <table class="table table-bordered " id="table-slider-demo">
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control counters_icon" name="icon">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="title">
                            </td>
                            <td>
                                <input type="text" class="form-control counters_color" name="color">
                            </td>
                            <td>
                                <input type="number" class="form-control" name="number">
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

    var propList = <?php echo $model->attributes['properties']; ?>;
    $(function () {

        $('#from-edit').on('beforeSubmit', function (e) {
            //设置内容

            var propObject = Array();
            var trs = $("#table-list tbody tr");
            var items = Array();
            var iconType = $("select[name=iconType]").val();
            var container = $("input[name=container]").val();
            if (trs.length > 0) {
                for (var i = 0; i < trs.length; i++) {

                    var icon = $(trs[i]).find("input[name=icon]").val();
                    var title = $(trs[i]).find("input[name=title]").val();
                    var number = $(trs[i]).find("input[name=number]").val();
                    var color = $(trs[i]).find("input[name=color]").val();

                    items.push({
                        'icon': icon,
                        'title': title,
                        'number': number,
                        'color': color
                    });
                }
            }

            propObject = {
                'iconType':iconType,
                'items':items,
                'container':container
            };

            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        $(".tableresize").colResizable();

        loadProperties();



    });


    function addWidget() {
        var demotr = $("#table-slider-demo tbody tr:first");
        $("#table-list tbody").append(demotr.clone());
        $('#table-list tbody .counters_icon:last').fontIconPicker({
            'source': fontIconSource,
            'allCategoryText':'所有分类'
        });
        $("#table-list tbody .counters_color:last").spectrum({
            showInput: true,
            preferredFormat: "hex"
        });
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

    function loadProperties() {
        if(propList.length==0){
            return;
        }
        $("select[name=iconType]").find("option[value="+propList['iconType']+"]").attr("selected", true);
        var items = propList['items'];
        for (var i = 0; i < items.length; i++) {
            var demotr = $("#table-slider-demo tbody tr:first");
            var democlone = demotr.clone();
            $(democlone).find("input[name=icon]").val(items[i]['icon']);
            $(democlone).find("input[name=title]").val(items[i]['title']);
            $(democlone).find("input[name=number]").val(items[i]['number']);
            $(democlone).find("input[name=color]").val(items[i]['color']);
            $("#table-list tbody").append(democlone);
        }

        $('#table-list tbody .counters_icon').fontIconPicker({
            'source': fontIconSource,
            'allCategoryText':'所有分类'
        });

        $("#table-list tbody .counters_color").spectrum({
            // flat: true,
            showInput: true,
            preferredFormat: "hex"
        });

        bindEvent();
    }


</script>
