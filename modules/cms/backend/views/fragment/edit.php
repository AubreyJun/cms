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
                    <label>
                        片段模板
                    </label>
                    <select name="fragmentTemplate" id="fragmentTemplate" class="form-control"
                            onchange="loadTemplate(this.value)">
                        <option value="0">无</option>
                        <?php
                        $viewPath = Yii::$app->viewPath;
                        if (sizeof($filelist) > 0) {
                            foreach ($filelist as $file) {
                                ?>
                                <option value="<?php echo $file; ?>"><?php echo str_replace($viewPath, "", $file); ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>
                        <a class="btn btn-primary btn-xs text-white mr-1" onclick="autoFormatSelection()"><i
                                    class="fa fa-code"></i>代码格式化</a>
                    </label>
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
                <form method="post" target="_blank" id="form-preview" action="index.php?r=cms-backend/fragment/preview">
                    <input type="hidden" name="editValue" id="editValue">
                    <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>">
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var editor = null;
    $(function () {
        editor = CodeMirror.fromTextArea(document.getElementById('code-editable'), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            theme: "midnight",
            lineWrapping: true,
            smartIndent: true,
            mode: "htmlmixed"
        });
    });

    function loadTemplate(path) {
        $.post('index.php?r=cms-backend/fragment/gettemplate', {
            'path': path,
            '_csrf': '<?= Yii::$app->request->csrfToken ?>'
        }, function (data) {
            editor.setValue(data);
        });
    }

    function loadPreview() {
        var editorValue = editor.getValue();
        $("#editValue").val(editorValue);
        $("#form-preview").submit();
    }

    function autoFormatSelection() {
        var totalLines = editor.lineCount();
        editor.autoFormatRange({line: 0, ch: 0}, {line: totalLines});
    }

</script>
