<?php


use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;



?>
<?php $this->title = '文章编辑'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">文章</h4>
                <?php
                if (isset($model->getErrors()['tips'])) {
                    ?>
                    <div class="alert alert-danger">
                        <?php
                        foreach ($model->getErrors()['tips'] as $error_fc) {
                            echo $error_fc;
                            echo '</br>';
                        }
                        ?>
                    </div>
                    <?php

                }
                ?>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/article/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'title', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'summary', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'content', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea() ?>
                <?= $form->field($model, 'keywords', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'tags', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'status', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->radioList(['online'=>'上线','offline'=>'下线'])  ?>

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
        tinymce.init({
            selector: '#formarticle-content',
            plugins: 'print preview searchreplace autolink directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern code',
            toolbar: 'formatselect | bold italic strikethrough forecolor backcolor permanentpen formatpainter | link image media pageembed | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent |  removeformat | ',
            height: 500,
            language: 'zh_CN',
            images_upload_url: 'index.php?r=cms-backend/upload/index',
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'index.php?r=cms-backend/upload/index');

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Invalid JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append("_csrf","<?= Yii::$app->request->csrfToken ?>");
                formData.append('FormFileImage[imageFile]', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);

            }
        });
        $('#from-edit').on('beforeValidate', function (e) {
            return true;
        });

        $('#formarticle-keywords').tagsInput({
            'width': '100%',
            'height': '75%',
            'interactive': true,
            'defaultText': '关键字',
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 20, // if not provided there is no limit
            'placeholderColor': '#666666'
        });

        $('#formarticle-tags').tagsInput({
            'width': '100%',
            'height': '75%',
            'interactive': true,
            'defaultText': '标签',
            'removeWithBackspace': true,
            'minChars': 0,
            'maxChars': 20, // if not provided there is no limit
            'placeholderColor': '#666666'
        });
    });
</script>
