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
                <input name="FormFragment[body]" type="hidden" id="fragment-body">
                <div class="form-group">
                    <label>
                        片段模板
                    </label>
                    <select name="fragmentTemplate" id="fragmentTemplate" class="form-control " style="width:100%"
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
                    <textarea id="code-editable" ></textarea>
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
<script src="static/backend/lib/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
<script>
    var editor = null;
    var id = null;
    $(function () {
        editor = ace.edit("code-editable");
        editor.setTheme("ace/theme/chrome");
        editor.session.setMode("ace/mode/php");
        editor.setAutoScrollEditorIntoView(true);
        editor.setOption("maxLines", 100);
        editor.setFontSize(14);

        id = $("#formfragment-id").val();
        if(id!=null && id!=0){
            loadFragmentBody(id);
        }

        $('#from-edit').on('beforeSubmit', function (e) {
            $("#fragment-body").val(editor.getValue());
            return true;
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

    function loadFragmentBody(id) {
        $.post('index.php?r=cms-backend/fragment/getfragment', {
            'id': id,
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



</script>
