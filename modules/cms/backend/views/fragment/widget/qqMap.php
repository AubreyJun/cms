<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = 'QQ地图设置';

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
<script>
    var widgetList = {};
</script>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">QQ地图设置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragmentType['optionDesc']; ?>"
                           readonly="readonly">

                    <div class="error mt-2 text-danger"></div>
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>

                <input type="hidden" name="FormFragment[properties]" id="fragment-properties" value="">

                <div class="mb-3">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="table-label"><strong>坐标</strong></td>
                            <td>
                                <input type="text" class="form-control " name="position" value="<?php echo $propObject['position']; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>标题</strong></td>
                            <td>
                                <input type="text" class="form-control "  name="title" value="<?php echo $propObject['title']; ?>" >
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>API KEY</strong></td>
                            <td>
                                <input type="text" class="form-control "  name="apikey" value="<?php echo $propObject['apikey']; ?>" >
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

    $(function () {

        $('#from-edit').on('beforeSubmit', function (e) {

            var position = $("input[name=position]").val();
            var title = $("input[name=title]").val();
            var apikey = $("input[name=apikey]").val();
            //设置内容
            var propObject = {
                "title":title,
                "position":position,
                "apikey":apikey
            };

            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });


    });


</script>
