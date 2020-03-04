<?php $this->title = '主题'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">主题</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button class="btn btn-primary btn-xs"
                                onclick="window.location.href='index.php?r=cms-backend/theme/edit&id=0'"><i
                                    class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
                <?php
                if (!is_null($error_message)) {
                    ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message['message']; ?>
                    </div>
                    <?php
                }
                ?>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>描述</th>
                        <th>KEY</th>
                        <th>状态</th>
                        <th width="20%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['themeName']; ?></td>
                            <td><?php echo $item['themeKey']; ?></td>
                            <td><?php echo $item['isActive'] == 1 ? '<i class="text-success fa fa-check fa-lg"></i>'
                                    : '<i class="text-danger fa fa-minus-circle fa-lg"></i>'; ?></td>
                            <td>
                                <a class="text-primary mr-1" title="编辑"
                                   href="index.php?r=cms-backend/theme/update&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>
                                <a class="text-danger mr-1" title="删除" onclick="deleteItem(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-trash fa-lg"></i>
                                </a>
                                <a class="text-success mr-1" title="默认主题"
                                   href="index.php?r=cms-backend/theme/default&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-check fa-lg"></i>
                                </a>
                                <a class="text-success mr-1" title="刷新页面"
                                   href="javascript:refreshTheme(<?php echo $item['id']; ?>);">
                                    <i class="fa fa-refresh fa-lg"></i>
                                </a>
                                <a class="text-primary mr-1"  title="页面逆向加载"
                                   href="javascript:resetTheme(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-reply fa-lg"></i>
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
        $("table").colResizable();
    });

    function refreshTheme(id) {
        $.post('index.php?r=cms-backend/theme/refresh&id=' + id, {
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>"'
        }, function (data) {
            if (data.code == 'success') {
                toastSuccess(data.message)
            }
        }, 'json');
    }

    function deleteItem(id) {
        doConfirm('删除主题？',function () {
            window.location.href = "index.php?r=cms-backend/theme/delete&id="+id;
        });
    }

    function resetTheme(id) {
        $.post('index.php?r=cms-backend/theme/reset&id=' + id, {
            '_csrf': '<?php echo Yii::$app->request->csrfToken; ?>"'
        }, function (data) {
            if (data.code == 'success') {
                toastSuccess(data.message)
            }
        }, 'json');
    }
</script>
