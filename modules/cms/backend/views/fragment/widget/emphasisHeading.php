<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '页面着重标题设置';

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
                <h4 class="card-title">页面着重标题设置</h4>
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
                            <td class="table-label"><strong>样式</strong></td>
                            <td class="styleSelect">
                                <select class="image-picker show-html form-control mb-3">
                                    <option data-img-src="themes/cms/fragment/headblock/case_1.jpg"  data-img-class="first" data-img-alt="Page 1" value="1">  Page 1  </option>
                                    <option data-img-src="themes/cms/fragment/headblock/case_2.jpg" data-img-alt="Page 2" value="2">  Page 2  </option>
                                    <option data-img-src="themes/cms/fragment/headblock/case_3.jpg" data-img-alt="Page 3" value="3">  Page 3  </option>
                                    <option data-img-src="themes/cms/fragment/headblock/case_4.jpg" data-img-alt="Page 4" value="4" data-img-class="last" >  Page 4  </option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>标题</strong></td>
                            <td>
                                <input type="text" class="form-control fragmentProperties"  editor="text" name="title" >
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>描述</strong></td>
                            <td>
                                <input type="text" class="form-control fragmentProperties"  editor="text" name="description" >
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

        $("select.image-picker").imagepicker({
            hide_select : false,
            show_label  : false
        });

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
