<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '图片内容区块';

$catalogs = $this->context->getNavgation('cms');;

function echoLevel($level){
    for($i=0;$i<$level;$i++){
        echo '--';
    }
}
function echoNavSelect($nav){
    if(isset($nav['children'])){
        foreach ($nav['children'] as $child){
            ?>
            <option value="<?php echo $child['object']['id']; ?>"><?php echo echoLevel($child['level']); ?><?php echo $child['object']['catalogName']; ?></option>
            <?php
            echoNavSelect($child);
        }
    }
}
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
                <h4 class="card-title">图片内容区块</h4>
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

                <div class="mb-3">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="table-label"><strong>展示栅格</strong></td>
                            <td>
                                <select class="form-control fragmentProperties" name="gridNumber"  editor="select" >
                                    <option value="1">一格</option>
                                    <option value="2">二格</option>
                                    <option value="3">三格</option>
                                    <option value="4">四格</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>分类</strong></td>
                            <td>
                                <select class="form-control fragmentProperties" name="catalogId" editor="select">
                                    <?php
                                    foreach ($catalogs as $nav){
                                        if($nav['object']['id'])
                                            ?>
                                            <option value="<?php echo $nav['object']['id'] ?>"><?php echo $nav['object']['catalogName'] ?></option>
                                        <?php
                                        echoNavSelect($nav);
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>显示数</strong></td>
                            <td>
                                <input type="text" class="form-control fragmentProperties"  editor="text" name="size" >
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>



            </div>
        </div>
    </div>
</div>
<script>

    var propList = <?php echo $model->attributes['properties']; ?>;

    $(function () {

        $('#from-edit').on('beforeSubmit', function (e) {
            //设置内容
            var properties = $(".fragmentProperties");
            var propObject = Array();
            if(properties.length>0){
                for(var i=0;i<properties.length;i++){
                    var pname = $(properties[i]).attr("name");
                    var pvalue = $(properties[i]).val();
                    var editor = $(properties[i]).attr("editor");
                    propObject.push({
                        'pname':pname,
                        'pvalue':pvalue,
                        'editor':editor
                    });
                }
            }
            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        $(".tableresize").colResizable();

        loadProperties();

    });


    function loadProperties() {
        for(var i=0;i<propList.length;i++){
            var propobject = propList[i];
            if(propobject['editor']=='html'){
                widgetList["properties-"+propobject['pname']].setValue(propobject['pvalue']);
            }else if(propobject['editor']=='text'){
                $("input[name="+propobject['pname']+"]").val(propobject['pvalue']);
            }else if(propobject['editor']=='image'){
                $("input[name="+propobject['pname']+"]").val(propobject['pvalue']);
            }else if(propobject['editor']=='select'){
                $("select[name="+propobject['pname']+"]").find("option[value="+propobject['pvalue']+"]").attr("selected", true);
            }
        }

    }

</script>
