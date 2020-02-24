<?php $this->title = '插件新增'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">插件新增</h4>
                <form id="form-edit" novalidate >
                    <div class="form-group">
                        <label>插件ID</label>
                        <input type="text" class="form-control" id="pluginId" name="pluginId"  placeholder="插件ID" required>
                    </div>
                    <button type="submit" class="btn btn-success mr-2" >安装</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $("#form-edit").validate({
        rules: {
            pluginId: "required",
        },
        messages: {
            pluginId: "插件ID不能为空"
        },
        errorPlacement: function(label, element) {
            label.addClass('mt-2 text-danger');
            label.insertAfter(element);
        },
        highlight: function(element, errorClass) {
            $(element).parent().addClass('has-danger')
            $(element).addClass('form-control-danger')
        },
        submitHandler: function() {
            var pluginId = $("#pluginId").val();

            $.ajax({
                type: 'POST',
                url: 'index.php?r=plugin-backend/'+pluginId+'/install',
                data: {'_csrf':'<?= Yii::$app->request->csrfToken ?>'},
                dataType:'json',
                success: function (data, textStatus, jqXHR) {
                    if(data.code == 'success'){
                        toastSuccess(data.message);
                        window.location.href = 'index.php?r=cms-backend/plug/index';
                    }else{
                        toastError(data.message);
                    }
                },
                error:function(jqXHR,textStatus,errorThrown){
                    toastError('插件安装失败');
                }
            });

        }
    });
</script>