<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;


?>
<?php $this->title = '页面编辑'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">主题</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/page/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'pageKey')->textInput()->label(false)->hiddenInput(['value' => is_null($model->attributes['pageKey']) ? '未设置' : $model->attributes['pageKey']]) ?>
                <?= $form->field($model, 'layoutId', ['errorOptions' => ['class' => 'error mt-2 text-danger']])
                    ->dropDownList($layout_select, ['prompt' => '请选择']) ?>
                <?= $form->field($model, 'pageName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'pagePath', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
