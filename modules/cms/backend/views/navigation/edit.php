<?php $this->title = '导航编辑';

use yii\helpers\Html;
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
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">导航编辑</h4>
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
                <?php $form->action = 'index.php?r=cms-backend/navigation/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group">
                    <label>
                        上级目录
                    </label>
                    <select name="FormNav[parentId]" id="formParentId" class="form-control">
                        <option value="0">顶部</option>
                        <?php
                        foreach ($navgation as $nav) {
                            if ($nav['object']['id'])
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
                    <label>
                        导航类型
                    </label>
                    <select class="form-control" id="navigationType" name="FormNav[navigationType]" onchange="changeNavType(this.value)">
                        <?php
                        foreach ($navigationType_select as $key => $value) {
                            ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php
                        }
                        ?>

                    </select>
                </div>
                <div class="form-group"  id="navigation-navrel">
                    <label>
                        导航关联目录
                    </label>
                    <select name="FormNav[navigationRel]" id="navigationRel" class="form-control">
                        <?php
                        foreach ($catalog_cms as $cms) {
                            if ($cms['object']['id'])
                                ?>
                                <option value="<?php echo $nav['object']['id'] ?>"><?php echo $cms['object']['catalogName'] ?></option>
                            <?php
                            echoNavSelect($cms);
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group" id="navigation-link">
                    <label>
                        链接
                    </label>
                    <input type="text" class="form-control" name="FormNav[link]">
                </div>


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

    function changeNavType(navType) {
        if (navType == 'link') {
            $("#navigation-navrel").hide();
            $("#navigation-link").show();
        }else{
            $("#navigation-navrel").show();
            $("#navigation-link").hide();
        }
    }

    $(function () {

        var navigationType = $("select[id=navigationType]").val();
        changeNavType(navigationType);

        $("select[id=formParentId]").val(parentId);

    });
</script>
