<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '容器设置';
$editThemeId = $this->context->data['editThemeId'];
$layoutRows = $this->context->query("select * from cms_theme_fragment t where t.fragmentType = 'layoutRow' and t.themeId = :themeId")
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
                <h4 class="card-title">容器设置</h4>
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

                <div class=" mb-3" id="page-properties">
                    <label class="control-label" >属性设置</label>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td class="table-label ">
                                    <strong>容器类型</strong>
                                </td>
                                <td>
                                    <select class="form-control">
                                        <option class="container">容器（Container）</option>
                                    </select>
                                </td>
                            </tr>
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
                                    <strong>容器内容</strong>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <table class="table table-label table-widget" style="width: 100%;" id="table-info">
                                        <thead>
                                        <td>行布局</td>
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
                                <select class="form-control">
                                    <?php
                                    foreach ($layoutRows as $row){
                                        ?>
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['fragmentName']; ?></option>
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
    function addWidget() {
        
    }
</script>
