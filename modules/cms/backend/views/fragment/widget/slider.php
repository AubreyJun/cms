<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '幻灯片';

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
                <h4 class="card-title">幻灯片</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragment['optionDesc']; ?>"
                           readonly="readonly">
                    <div class="error mt-2 text-danger"></div>
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>


                <?php
                if (isset($editorMapping)) {
                    ?>
                    <input type="hidden" name="FormFragment[properties]" id="fragment-properties" value="">
                    <div class=" mb-3" id="page-properties">
                        <label class="control-label" for="formfragment-fragmentname">属性设置</label>
                        <table class="table table-bordered">
                            <tbody>
                            <?php
                            foreach ($editorMapping as $key => $val) {
                                if ($val['editor'] == 'slider') {
                                    ?>
                                    <tr>
                                        <td colspan="2"><strong><?php echo $val['title']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <table class="table table-label table-widget" style="width: 100%;"
                                                   id="table-slider">
                                                <thead>
                                                <td>图片</td>
                                                <td>标题</td>
                                                <td>链接</td>
                                                <td>描述</td>
                                                <td><i class="fa fa-plus-circle fa-lg text-success"
                                                       onclick="addWidget()"></i></td>
                                                </thead>
                                                <tbody></tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    <?php
                }
                ?>

                <div class="form-group">
                    <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end(); ?>

                <div style="display: none;">
                    <table class="table table-bordered " id="table-slider-demo">
                        <tbody>
                        <tr>
                            <td>
                                <input type="text" class="form-control fileSelect" name="image">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="title">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="link">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="description">
                            </td>
                            <td>
                                <i class="fa fa-arrow-up fa-lg text-success mr-1 tool-up" title="上移"></i>
                                <i class="fa fa-arrow-down fa-lg text-warning  mr-1 tool-down" title="下移"></i>
                                <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>

    var propList = <?php echo $model->attributes['properties']; ?>;
    var editor = null;

    $(function () {

        $('#from-edit').on('beforeSubmit', function (e) {
            //设置内容

            var propObject = Array();
            var trs = $("#table-slider tbody tr");
            if (trs.length > 0) {
                for (var i = 0; i < trs.length; i++) {

                    var image = $(trs[i]).find("input[name=image]").val();
                    var title = $(trs[i]).find("input[name=title]").val();
                    var link = $(trs[i]).find("input[name=link]").val();
                    var description = $(trs[i]).find("input[name=description]").val();

                    propObject.push({
                        'image': image,
                        'title': title,
                        'link': link,
                        'description': description
                    });
                }
            }
            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        $(".tableresize").colResizable();

        loadProperties();

    });

    KindEditor.ready(function (K) {
        editor = K.editor({
            allowFileManager: true,
            fileManagerJson: 'static/backend/lib/kindeditor/php/file_manager_json.php'
        });
    });

    function bindFileSelect() {
        $('.fileSelect').unbind("click");
        $('.fileSelect').click(function () {
            var obj = $(this);
            editor.loadPlugin('insertfile', function () {
                editor.plugin.fileDialog({
                    fileUrl: $(obj).val(),
                    clickFn: function (url, title) {

                        $(obj).val(url);
                        ;
                        editor.hideDialog();
                    }
                });

            });
        });
    }

    function addWidget() {
        var demotr = $("#table-slider-demo tbody tr:first");
        $("#table-slider tbody").append(demotr.clone());
        bindEvent();
        bindFileSelect();
    }

    function bindEvent() {
        $(".table-widget tbody .tool-delete").unbind("click");
        $(".table-widget tbody .tool-up").unbind("click");
        $(".table-widget tbody .tool-down").unbind("click");

        $(".table-widget tbody .tool-delete").bind("click", function () {
            $(this).closest("tr").remove();
        });
        $(".table-widget tbody .tool-up").bind("click", function () {
            var prevTr = $(this).closest("tr").prev("tr");
            var currentTr = $(this).closest("tr");
            if (prevTr) {
                prevTr.before(currentTr);
            }
        });
        $(".table-widget tbody .tool-down").bind("click", function () {
            var nextTr = $(this).closest("tr").next("tr");
            var currentTr = $(this).closest("tr");
            if (nextTr) {
                nextTr.after(currentTr);
            }
        });
    }

    function loadProperties() {
        for (var i = 0; i < propList.length; i++) {
            var demotr = $("#table-slider-demo tbody tr:first");
            var democlone = demotr.clone();
            $(democlone).find("input[name=image]").val(propList[i]['image']);
            $(democlone).find("input[name=title]").val(propList[i]['title']);
            $(democlone).find("input[name=link]").val(propList[i]['link']);
            $(democlone).find("input[name=description]").val(propList[i]['description']);
            $("#table-slider tbody").append(democlone);
        }

        bindEvent();
        bindFileSelect();
    }

    function codeMirror(htmlId, size) {
        var editor = CodeMirror.fromTextArea(document.getElementById(htmlId), {
            lineNumbers: true,
            styleActiveLine: true,
            matchBrackets: true,
            theme: "midnight"
        });
        if (size != null) {
            editor.setSize('auto', size + 'px');
        }
        return editor;
    }

</script>