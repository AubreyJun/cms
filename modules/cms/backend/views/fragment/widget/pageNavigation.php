<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '片段设置';

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
                <h4 class="card-title">片段设置</h4>
                <?php $form = ActiveForm::begin(['id' => 'from-edit']); ?>
                <?php $form->action = 'index.php?r=cms-backend/fragment/edit' ?>
                <?= $form->field($model, 'id')->textInput()->label(false)->hiddenInput(['value' => $model->attributes['id']]) ?>
                <div class="form-group field-formfragment-fragmentname required">
                    <label class="control-label" for="formfragment-fragmentname">片段类型</label>
                    <input type="text" class="form-control" value="<?php echo $fragmentType['optionDesc']; ?>"
                           readonly="readonly">

                    <div class="error mt-2 text-danger"></div>
                </div>
                <?= $form->field($model, 'fragmentType')->textInput()->label(false)->hiddenInput(['value' => $model->fragmentType]) ?>
                <?= $form->field($model, 'fragmentName', ['errorOptions' => ['class' => 'error mt-2 text-danger']]) ?>
                <div class="form-group">
                    <label>默认HEADER</label>
                    <div class="form-check ">
                        <label class="form-check-label">
                            <?php
                            if ($model->attributes['isDefault'] == '1') {
                                ?>
                                <input type="checkbox" name="FormFragment[isDefault]" value="1" class="form-check-input"
                                       checked="checked">
                                <?php
                            } else {
                                ?>
                                <input type="checkbox" name="FormFragment[isDefault]" value="1" class="form-check-input">
                                <?php
                            }
                            ?>
                            默认</label>
                    </div>
                </div>

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
                                if ($val['editor'] == 'html') {
                                    ?>
                                    <tr>
                                        <td colspan="2"><strong><?php echo $val['title']; ?></strong></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <textarea rows="3" class="fragmentProperties" editor="<?php echo $val['editor']; ?>"
                                                      id="properties-<?php echo $key; ?>"
                                                      name="<?php echo $key; ?>"></textarea>
                                            <script>
                                                $(function () {
                                                    editor = codeMirror('properties-<?php echo $key; ?>', 100);
                                                    widgetList['properties-<?php echo $key; ?>'] = editor;
                                                });
                                            </script>
                                        </td>
                                    </tr>
                                    <?php
                                }else if($val['editor'] == 'text'){
                                    ?>
                                    <tr>
                                        <td class="table-label"><strong><?php echo $val['title']; ?></strong></td>
                                        <td>
                                            <input type="text" class="form-control fragmentProperties"  editor="<?php echo $val['editor']; ?>" name="<?php echo $key; ?>" >
                                        </td>
                                    </tr>
                                    <?php
                                }else if($val['editor'] == 'image'){
                                    ?>
                                    <tr>
                                        <td class="table-label"><strong><?php echo $val['title']; ?></strong></td>
                                        <td>
                                            <input type="text" class="form-control fragmentProperties fileSelect"  editor="<?php echo $val['editor']; ?>" name="<?php echo $key; ?>" >
                                        </td>
                                    </tr>
                                    <?php
                                }else if($val['editor']=='select'){
                                    ?>
                                    <tr>
                                        <td class="table-label"><strong><?php echo $val['title']; ?></strong></td>
                                        <td>
                                            <select class="form-control fragmentProperties" editor="<?php echo $val['editor']; ?>" name="<?php echo $key; ?>" >
                                                <?php
                                                foreach ($val['selectData'] as $key =>$val){
                                                    ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $val; ?></option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
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
                    <table class="table table-bordered " id="table-treegrid-demo">
                        <tbody>
                        <tr>
                            <td>
                                <span class="step"></span>
                            </td>
                            <td>
                                <input type="text" class="form-control" name="title">
                            </td>
                            <td>
                                <input type="text" class="form-control" name="link">
                            </td>
                            <td>
                                <i class="fa fa-plus-circle fa-lg text-success tool-add mr-1" title="添加" ></i>
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

    $(function () {

        $('#from-edit').on('beforeSubmit', function (e) {
            //设置内容
            var properties = $(".fragmentProperties");
            var propObject = Array();
            if(properties.length>0){
                for(var i=0;i<properties.length;i++){
                    var pname = $(properties[i]).attr("name");
                    var pvalue = $(properties[i]).val();
                    var editor = $(properties[i]).attr("editor");
                    propObject.push({
                        'pname':pname,
                        'pvalue':pvalue,
                        'editor':editor
                    });
                }
            }
            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        $(".tableresize").colResizable();

        loadProperties();

    });

    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager : true,
            fileManagerJson : 'static/backend/lib/kindeditor/php/file_manager_json.php'
        });
        $('.fileSelect').click(function() {
            var obj = $(this);
            editor.loadPlugin('insertfile', function() {
                editor.plugin.fileDialog({
                    fileUrl : $(obj).val(),
                    clickFn : function(url, title) {

                        $(obj).val(url);;
                        editor.hideDialog();
                    }
                });

            });
        });
    });

    function loadProperties() {
        for(var i=0;i<propList.length;i++){
            var propobject = propList[i];
            if(propobject['editor']=='html'){
                widgetList["properties-"+propobject['pname']].setValue(propobject['pvalue']);
            }else if(propobject['editor']=='text'){
                $("input[name="+propobject['pname']+"]").val(propobject['pvalue']);
            }else if(propobject['editor']=='image'){
                $("input[name="+propobject['pname']+"]").val(propobject['pvalue']);
            }else if(propobject['editor']=='select'){
                $("select[name="+propobject['pname']+"]").find("option[value="+propobject['pvalue']+"]").attr("selected", true);
            }
        }

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
