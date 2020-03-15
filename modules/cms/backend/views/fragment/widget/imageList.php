<?php

use app\forms\cms\backend\FormFragment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


$this->title = '列表>图+标题+内容';

$propObject = null;
$properties = $fragment['properties'];
if($properties!=null){
    $propObject = json_decode($properties,true);
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
                <h4 class="card-title">列表>图+标题+内容</h4>
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
                <div class=" mb-3" id="page-properties">
                    <label class="control-label" for="formfragment-fragmentname">属性设置</label>
                    <table class="table table-bordered">
                        <tbody>
                        <tr>
                            <td class="table-label"><strong>样式</strong></td>
                            <td class="styleSelect">
                                <select class="image-picker masonry show-html form-control mb-3">
                                    <option data-img-src="themes/cms/fragment/imageList/1.png"  data-img-alt="通用样式" value="1">通用样式</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="table-label ">
                                <strong>类型</strong>
                            </td>
                            <td>
                                <select class="form-control" name="imageListType">
                                    <option value="four" <?php echo $propObject['imageListType']=='four'?"selected":""; ?> >四格</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"><strong>内容设置</strong></td>
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
                                    <tbody>
                                    <?php
                                    if( isset($propObject['items']) && sizeof($propObject['items'])>0){
                                        foreach ($propObject['items'] as $item){
                                            ?>
                                            <tr>
                                                <td>
                                                    <input type="text" class="form-control fileSelect" value="<?php echo $item['image']; ?>" name="image">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="title" value="<?php echo $item['title']; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="link" value="<?php echo $item['link']; ?>">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="description" value="<?php echo $item['description']; ?>">
                                                </td>
                                                <td>
                                                    <i class="fa fa-arrow-up fa-lg text-success mr-1 tool-up" title="上移"></i>
                                                    <i class="fa fa-arrow-down fa-lg text-warning  mr-1 tool-down" title="下移"></i>
                                                    <i class="fa fa-trash fa-lg text-danger tool-delete" title="删除"></i>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

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

            var items = Array();
            var trs = $("#table-slider tbody tr");
            if (trs.length > 0) {
                for (var i = 0; i < trs.length; i++) {

                    var image = $(trs[i]).find("input[name=image]").val();
                    var title = $(trs[i]).find("input[name=title]").val();
                    var link = $(trs[i]).find("input[name=link]").val();
                    var description = $(trs[i]).find("input[name=description]").val();

                    items.push({
                        'image': image,
                        'title': title,
                        'link': link,
                        'description':description
                    });
                }
            }

            var imageListType = $("select[name=imageListType]").val();
            var container = $("input[name=container]").val();

            var propObject = {
                'items':items,
                'imageListType':imageListType,
                'container':container
            };
            var jsonStr = JSON.stringify(propObject);
            $("#fragment-properties").val(jsonStr);
        });

        $(".tableresize").colResizable();

        $("select.image-picker").imagepicker({
            hide_select : false,
            show_label  : false
        });



        loadProperties();
        hoverStyleImage();

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
        bindEvent();
        bindFileSelect();
    }

</script>
