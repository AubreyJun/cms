<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\cms\Theme */
/* @var $form ActiveForm */
?>
<?php $this->title = '主题编辑'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">主题</h4>
                <?php $form = ActiveForm::begin(); ?>
                <?php $form->action = 'index.php?r=cms-backend/theme/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $id]) ?>
                <?= $form->field($model, 'themeName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <div class="form-group">
                    <label>状态</label>
                    <div class="form-check ">
                        <label class="form-check-label">
                            <?php
                            if ($model->attributes['isActive'] == '1') {
                                ?>
                                <input type="checkbox" name="FormTheme[isActive]" value="1" class="form-check-input"
                                       checked="checked">
                                <?php
                            } else {
                                ?>
                                <input type="checkbox" name="FormTheme[isActive]" value="1" class="form-check-input">
                                <?php
                            }
                            ?>
                            激活</label>
                    </div>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
