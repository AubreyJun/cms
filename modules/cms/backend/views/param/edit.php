<?php

use app\assets\CodeEditorAsset;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;


?>
<?php $this->title = '参数编辑'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">参数</h4>
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
                <?php $form->action = 'index.php?r=cms-backend/param/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'description', ['errorOptions' => ['class' => 'error mt-2 text-danger']])?>
                <?= $form->field($model, 'cfgkey', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'cfgvalue', ['errorOptions' => ['class' => 'error mt-2 text-danger']])->textarea(['rows'=>3]) ?>
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
