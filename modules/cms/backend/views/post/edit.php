<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

function echoLevel($level)
{
    for ($i = 0; $i < $level; $i++) {
        echo '--';
    }
}

function echoNavSelect($nav)
{
    if (isset($nav['children'])) {
        foreach ($nav['children'] as $child) {
            ?>
            <option value="<?php echo $child['object']['id']; ?>"><?php echo echoLevel($child['level']); ?><?php echo $child['object']['catalogName']; ?></option>
            <?php
            echoNavSelect($child);
        }
    }
}

?>
<?php $this->title = '网站内容'; ?>
<?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
<div class="row">
    <div class="col-md-9 grid-margin stretch-card">
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

                <?php $form->action = 'index.php?r=cms-backend/post/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'postType')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['postType']]) ?>
                <div class="form-group">
                    <label>
                        目录
                    </label>
                    <select name="FormArticle[catalogId]" id="formCatalogId" class="form-control select2">
                        <option value="0">无</option>
                        <?php
                        foreach ($navgation as $nav) {
                            ?>
                            <option value="<?php echo $nav['object']['id'] ?>"><?php echo $nav['object']['catalogName'] ?></option>
                            <?php
                            echoNavSelect($nav);
                        }
                        ?>
                    </select>
                </div>
                <?= $form->field($model, 'title', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'content', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea([]) ?>
                <?= $form->field($model, 'status', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->radioList(['online' => '上线', 'offline' => '下线']) ?>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">标签</h4>
                <?= $form->field($model, 'keywords', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'tags', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
            </div>
        </div>
        <?php
        if($model->postType!='article' && $model->postType!='employee'){
            ?>
            <div style="display: none;"><input type="hidden" id="fileSelect" name="fileSelect"/></div>
            <div class="card mt-4">
                <div class="card-body">
                    <h4 class="card-title">
                        <?php
                        if($model->postType=='image'){
                            echo "图片属性";
                        }else if($model->postType=='download'){
                            echo "附件属性";
                        }else if($model->postType=='product'){
                            echo "产品属性";
                        }
                        ?>
                    </h4>
                    <?php
                    foreach ($propOptions as $k=>$v){
                        $keySplit = explode(',',$k);
                        if($keySplit[1]=='selectImage'){
                            ?>
                            <div class="form-group">
                                <label><?php echo $v['optionDesc']; ?></label>
                                <div class="input-group">
                                    <input type="text" id="<?php echo $keySplit[0]; ?>" class="form-control <?php echo $keySplit[1]; ?>" name="<?php echo $keySplit[0]; ?>" value="<?php echo isset($propKV[$keySplit[0]])?$propKV[$keySplit[0]]:''; ?>" >
                                    <div class="input-group-prepend" onclick="selectImage(<?php echo $keySplit[0]; ?>)">
                                        <span class="input-group-text bg-info"><i class="fa fa-image text-white"></i></span>
                                    </div>
                                </div>

                            </div>
                            <?php
                        }
                        ?>

                        <?php
                    }
                    ?>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
<script>
    var editor;

    $(function () {

        var editor = new Jodit('#formarticle-content',
            {
                minHeight: 500,
                language: 'zh_cn',
                uploader: {
                    url: 'static/backend/lib/jodit/connector/index.php?action=fileUpload'
                },
                filebrowser: {
                    ajax: {
                        url: 'static/backend/lib/jodit/connector/index.php'
                    }
                }
            }
        );

        var fileSelect = new Jodit('#fileSelect',
            {
                language: 'zh_cn',
                uploader: {
                    url: 'static/backend/lib/jodit/connector/index.php?action=fileUpload'
                },
                filebrowser: {
                    ajax: {
                        url: 'static/backend/lib/jodit/connector/index.php'
                    }
                }
            }
        );




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
            $("select[id=formCatalogId]").trigger('change');

        });
    });

    function selectImage(imageName) {

    }
</script>
