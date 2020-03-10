<?php $this->title = '属性编辑'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">属性编辑</h4>
                <form novalidate id="form-edit" method="post" action="index.php?r=cms-backend/post/saveconfig">
                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                    <div class="form-group">
                        <label>内容标题</label>
                        <input type="text" class="form-control" readonly="readonly" disabled="disabled" value="<?php echo $post['title']; ?>">
                    </div>

                    <?php
                    foreach ($propOptions as $k=>$v){
                        ?>
                        <div class="form-group">
                            <label><?php echo $v['optionDesc']; ?></label>
                            <input type="text" class="form-control <?php echo $v['widgetClass']; ?>"  name="<?php echo $k; ?>" value="<?php echo isset($propKV[$k])?$propKV[$k]:''; ?>" >
                        </div>
                        <?php
                    }
                    ?>
                    <button type="submit" class="btn btn-success mr-2">保存</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    KindEditor.ready(function(K) {
        var editor = K.editor({
            allowFileManager: true,
            fileManagerJson: 'static/backend/lib/kindeditor/php/file_manager_json.php'
        });
        $('.fileSelect').click(function() {
            var obj = $(this);
            editor.loadPlugin('filemanager', function() {
                editor.plugin.filemanagerDialog({
                    clickFn : function(url, title) {
                        $(obj).val(url);
                        editor.hideDialog();
                    }
                });
            });
        });
    });
</script>
