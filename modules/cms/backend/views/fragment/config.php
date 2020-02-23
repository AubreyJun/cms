<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '片段配置';

?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">增加配置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/saveconfig' ?>
                <input type="hidden" name="id" value="<?php echo $props['id']; ?>">
                <input type="hidden" name="fragmentId" value="<?php echo $id; ?>">
                <div class="form-group">
                    <label>
                        配置KEY
                    </label>
                    <input type="input" name="ppKey" value="<?php echo $props['ppKey']; ?>" class="form-control"  placeholder="配置KEY">
                </div>
                <div class="form-group">
                    <label>
                        配置VALUE
                    </label>
                    <textarea  name="ppValue" class="form-control" rows="3" style="resize:none;" placeholder="配置VALUE" ><?php echo $props['ppValue']; ?></textarea>
                </div>
                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">片段配置</h4>

                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>配置KEY</th>
                        <th>配置VALUE</th>
                        <th width="20%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($fragmentProps as $prop){
                        ?>
                        <tr>
                            <td><?php echo $prop['ppKey']; ?></td>
                            <td><textarea class="form-control" rows="1"  ><?php echo $prop['ppValue']; ?></textarea></td>
                            <td>
                                <a class="text-primary"
                                   href="index.php?r=cms-backend/fragment/updateconfig&id=<?php echo $prop['id']; ?>&fragmentId=<?php echo $id; ?>">
                                    <i class="fa fa-pencil-square mr-1"></i>
                                </a>
                                <a class="text-primary"
                                   href="index.php?r=cms-backend/fragment/copyconfig&id=<?php echo $prop['id']; ?>&fragmentId=<?php echo $id; ?>">
                                    <i class="fa fa-copy mr-1"></i>
                                </a>
                                <a class="text-danger"
                                   href="index.php?r=cms-backend/fragment/deleteconfig&id=<?php echo $prop['id']; ?>&fragmentId=<?php echo $id; ?>">
                                    <i class="fa fa-trash mr-1"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</div>
<script>
    $(function () {
        $("#from-edit").validate({
            rules: {
                ppKey: "required",
                ppValue: "required",
            },
            messages: {
                ppKey: "配置KEY必填",
                ppValue: "配置VALUE必填"
            },
            errorPlacement: function(label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function(element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            }
        });
    });
</script>
