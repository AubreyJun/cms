<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '内容块设置';
$editThemeId = $this->context->data['editThemeId'];
$widgetSelect = $this->context->query("select * from cms_select where selectName = 'widget'")->queryOne();

$widgetTypes = $this->context->query("SELECT
	* 
FROM
	cms_select_options t 
WHERE
	t.selectId IN ( SELECT t.id FROM cms_select t WHERE t.selectName = 'widget' ) 
ORDER BY
	t.sequencenumber ASC")
    ->queryAll();


$propObject = null;

$properties = $fragment['properties'];
if($properties!=null){
    $propObject = json_decode($properties,true);
}



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
                <h4 class="card-title">内容块设置</h4>
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

                <input type="hidden" name="FormFragment[properties]" id="fragment-properties" value="">

                <div class=" mb-3" id="page-properties">
                    <label class="control-label" >属性设置</label>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td colspan="2">
                                <strong>内容块内容</strong>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table class="table table-label table-widget" style="width: 100%;" id="table-info">
                                    <thead>
                                    <td>组件类型</td>
                                    <td>内容</td>
                                    <td><i class="fa fa-plus-circle fa-lg text-success" onclick="addWidget()"></i></td>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(isset($propObject)){
                                        foreach ($propObject as $item){
                                            $widgetList = $this->context->query("select * from cms_theme_fragment where fragmentType = :fragmentType and themeId = :themeId")
                                                ->bindParam(":fragmentType",$item['widgetType'])
                                                ->bindParam(":themeId",$this->context->data['editThemeId'])
                                                ->queryAll();
                                            ?>
                                            <tr>
                                                <td>
                                                    <select class="form-control" name="widgetType"  onchange="loadWidgetIds(this.value,this)" >
                                                        <?php
                                                        foreach ($widgetTypes as $widgetType){
                                                            if($item['widgetType']==$widgetType['optionValue']){
                                                                ?>
                                                                <option selected="selected" value="<?php echo $widgetType['optionValue']; ?>"><?php echo $widgetType['optionDesc']; ?></option>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <option value="<?php echo $widgetType['optionValue']; ?>"><?php echo $widgetType['optionDesc']; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select class="form-control" name="widgetId">
                                                        <?php
                                                        foreach ($widgetList as $widget){
                                                            if($widget['id']==$item['widgetId']){
                                                                ?>
                                                                <option selected="selected" value="<?php echo $widget['id']; ?>"><?php echo $widget['fragmentName']; ?></option>
                                                                <?php
                                                            }else{
                                                                ?>
                                                                <option value="<?php echo $widget['id']; ?>"><?php echo $widget['fragmentName']; ?></option>
                                                                <?php
                                                            }
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
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
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
                                <select class="form-control" name="widgetType"  onchange="loadWidgetIds(this.value,this)" >
                                    <?php
                                    foreach ($widgetTypes as $widgetType){
                                        ?>
                                        <option value="<?php echo $widgetType['optionValue']; ?>"><?php echo $widgetType['optionDesc']; ?></option>
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
                    var widgetType = $(trs[i]).find("select[name=widgetType]").val();
                    var widgetId = $(trs[i]).find("select[name=widgetId]").val();
                    items.push({
                        'widgetType':widgetType,
                        'widgetId':widgetId
                    });
                }
            }

            var jsonStr = JSON.stringify(items);
            $("#fragment-properties").val(jsonStr);
        });

        loadProperties();
    });




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
            $("#table-info tbody").append(clone);
            bindEvent();
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
</script>
