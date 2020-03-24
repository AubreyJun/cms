<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '片段设置';

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
                <h4 class="card-title">片段设置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>

                <div class="form-group">
                    <textarea id="code-editable" rows="20" class=" w-100"
                              name="FormFragment[body]"><?php echo $model->attributes['body']; ?></textarea>
                    <?php
                    if (isset($model->getErrors()['body'])) {
                        ?>
                        <div class="error mt-2 text-danger">
                            <?php
                            foreach ($model->getErrors()['body'] as $error_fc) {
                                echo $error_fc;
                                echo '</br>';
                            }
                            ?>
                        </div>
                        <?php

                    }
                    ?>
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

        $(function () {
            var editor = CodeMirror.fromTextArea(document.getElementById('code-editable'), {
                lineNumbers: true,
                styleActiveLine: true,
                matchBrackets: true,
                theme: "midnight",
                lineWrapping: true,
                smartIndent: true
            });
            editor.setSize('auto', '300px');

        });

    });


</script>
