<?php

use app\assets\CodeEditorAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $this->title = '布局编辑'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">布局</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/layout/edit' ?>
                <input type="hidden" name="FormLayout[themeId]" value="<?php echo $model->attributes['themeId']; ?>"/>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->id]) ?>
                <?= $form->field($model, 'layoutName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
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
});
</script>
