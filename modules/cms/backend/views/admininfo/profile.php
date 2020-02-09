<?php $this->title = '用户信息';

use yii\helpers\Html;
use yii\widgets\ActiveForm; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">修改密码</h4>
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
                if(isset($message)){
                    ?>
                    <div class="alert alert-success">
                        <?php
                        echo $message['message'];
                        ?>
                    </div>
                    <?php
                }
                ?>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/admininfo/updatepwd' ?>

                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $this->context->userId]) ?>
                <?= $form->field($model, 'adminpassword', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'newpassword', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script>

</script>
