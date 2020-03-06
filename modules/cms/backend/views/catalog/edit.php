<?php $this->title = '目录编辑';

use yii\helpers\Html;
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
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">目录编辑</h4>
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
                <?php $form->action = 'index.php?r=cms-backend/catalog/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <?= $form->field($model, 'catalogType')->textInput()->label(false)->hiddenInput(['value' => 'cms']) ?>
                <div class="form-group">
                    <label>
                        上级目录
                    </label>
                    <select name="FormNav[parentId]" id="formParentId" class="form-control">
                        <option value="0">顶部</option>
                        <?php
                        foreach ($navgation as $nav){
                            if($nav['object']['id'])
                            ?>
                            <option value="<?php echo $nav['object']['id'] ?>"><?php echo $nav['object']['catalogName'] ?></option>
                            <?php
                            echoNavSelect($nav);
                        }
                        ?>
                    </select>
                </div>
                <?= $form->field($model, 'catalogName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <?= $form->field($model, 'sequenceNumber', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<script>
    var parentId = <?php echo $model->attributes['parentId'] ?>;
    $(function () {
        $("select[id=formParentId]").val(parentId);
    });
</script>
