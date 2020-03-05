<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '片段设置';

?>
<style>
    .table-label{
        width: 20%;
    }
</style>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">片段设置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragmentKV[$model->fragmentType]; ?>"
                           readonly="readonly">

                    <div class="error mt-2 text-danger"></div>
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>


                <?php
                if (isset($editorMapping)) {
                    ?>
                    <div class="page-properties mb-3">
                        <label class="control-label" for="formfragment-fragmentname">属性设置</label>
                        <table class="table table-bordered">
                            <tbody>
                            <?php
                            foreach ($editorMapping as $key => $val) {
                                if($val['editor']=='html'){
                                    ?>
                                    <tr>
                                        <td colspan="2"><strong><?php echo $val['title']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea rows="3" class="fragment-properties" id="properties-<?php echo $key; ?>" name="<?php echo $key; ?>"></textarea>
                                            <script>
                                                $(function () {
                                                    codeMirror('properties-<?php echo $key; ?>',100);
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                } else {
                    ?>
                    <?= $form->field($model, 'properties', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea(['rows' => 5]) ?>
                    <?php
                }
                ?>

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
        CodeMirror.fromTextArea(document.getElementById('formfragment-properties'), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            theme: "midnight"
        });
    });
    function codeMirror(htmlId,size) {
        var editor = CodeMirror.fromTextArea(document.getElementById(htmlId), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            theme: "midnight"
        });
        if(size!=null){
            editor.setSize('auto',size+'px');
        }
    }
</script>
