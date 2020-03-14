<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '内容块设置';

$propObject = array();
if($fragment['properties']){
    $propObject = json_decode($fragment['properties'],true);
}
?>
<style>
    .table-label {
        width: 20%;
    }
</style>
<script>
    var widgetList = {};
</script>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">页面着重标题设置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragmentType['optionDesc']; ?>"
                           readonly="readonly">
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>

                <input type="hidden" name="FormFragment[properties]" id="fragment-properties" value="">

                <div class="mb-3">
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="table-label"><strong>外部Container</strong></td>
                            <td>
                                <div class="form-check ">
                                    <label class="form-check-label">
                                        <?php
                                        if ($propObject['container'] == '1') {
                                            ?>
                                            <input type="checkbox" name="container" value="1" class="form-check-input"
                                                   checked="checked">
                                            <?php
                                        } else {
                                            ?>
                                            <input type="checkbox" name="container" value="1" class="form-check-input">
                                            <?php
                                        }
                                        ?>
                                        设置</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>内容显示样式</strong></td>
                            <td>
                                <select class="form-control" name="style">
                                    <option value="left" <?php echo $propObject['style']=='left'?"selected":""; ?>>内容左侧显示</option>
                                    <option value="right" <?php echo $propObject['style']=='right'?"selected":""; ?>>内容右侧侧显示</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>标题</strong></td>
                            <td>
                                <input type="text" class="form-control " editor="text" name="title" value="<?php echo $propObject['title']; ?>">
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label" colspan="2"><strong>描述</strong></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <textarea name="description" id="widget-description" style="width: 100%;"><?php echo $propObject['description']; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label"><strong>图片</strong></td>
                            <td>
                                <input type="text" class="form-control fileSelect" editor="text" name="image" value="<?php echo $propObject['image']; ?>">
                            </td>
                        </tr>
                        </tbody>
                    </table>
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

    var editor = null;
    var editor_content = null;

    $(function () {

        $('#from-edit').on('beforeSubmit', function (e) {
            //设置内容
            var propObject = Array();

            editor_content.sync();

            var style = $("select[name=style]").val();
            var title = $("input[name=title]").val();
            var description = $("textarea[name=description]").val();
            var image = $("input[name=image]").val();
            var container = $("input[name=container]").val();

            propObject = {
                'style': style,
                'title': title,
                'description': description,
                'image': image,
                'container':container
            };

            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        $(".tableresize").colResizable();

        bindFileSelect();


    });

    KindEditor.ready(function (K) {
        editor = K.editor({
            allowFileManager: true,
            fileManagerJson: 'static/backend/lib/kindeditor/php/file_manager_json.php'
        });

        editor_content = K.create('textarea[id="widget-description"]', {
            allowFileManager : true,
            resizeMode:1,
            themeType : 'simple',
            height : "200px",
        });

    });


    function bindFileSelect() {
        $('.fileSelect').click(function () {
            var obj = $(this);
            editor.loadPlugin('insertfile', function () {
                editor.plugin.fileDialog({
                    fileUrl: $(obj).val(),
                    clickFn: function (url, title) {
                        $(obj).val(url);
                        editor.hideDialog();
                    }
                });

            });
        });
    }



</script>
