<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

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
<?php $this->title = '网站内容'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">网站内容</h4>
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
                <?php $form->action = 'index.php?r=cms-backend/post/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'postType', ['errorOptions' => ['class' => 'error mt-2 text-danger']])
                    ->dropDownList($contentType_select, ['prompt'=>'请选择']) ?>
                <div class="form-group">
                    <label>
                        目录
                    </label>
                    <select name="FormArticle[catalogId]" id="formCatalogId" class="form-control">
                        <option value="0">无</option>
                        <?php
                        foreach ($navgation as $nav){
                            ?>
                                <option value="<?php echo $nav['object']['id'] ?>"><?php echo $nav['object']['catalogName'] ?></option>
                            <?php
                            echoNavSelect($nav);
                        }
                        ?>
                    </select>
                </div>
                <?= $form->field($model, 'title', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'summary', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea(['rows' => 3]) ?>
                <?= $form->field($model, 'content', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea(['style'=>'height:350px']) ?>
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
    var editor;

    $(function () {


        var editor = new Jodit('#formarticle-content',
            {
                language: 'zh_cn',
                uploader: {
                    url: 'http://localhost:8181/index-test.php?action=fileUpload'
                },
                filebrowser: {
                    ajax: {
                        url: 'http://localhost:8181/index-test.php'
                    }
                }
            }
        );
        // KindEditor.ready(function(K) {
        //     editor = K.create('textarea[id="formarticle-content"]', {
        //         allowFileManager : true,
        //         resizeMode:1,
        //         themeType : 'simple'
        //     });
        //
        // });

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

        var catalogId = <?php echo $model->attributes['catalogId'] ?>;
        $(function () {
            $("select[id=formCatalogId]").val(catalogId);

            $('#from-edit').on('beforeSubmit', function (e) {
                editor_content.sync();
            });
        });
    });
</script>
