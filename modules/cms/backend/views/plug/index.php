<?php use yii\widgets\LinkPager; ?>
<?php $this->title = '网站插件'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">网站插件</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" style="float: right;">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-xs"
                                        onclick="window.location.href='index.php?r=cms-backend/plug/add'"><i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>插件ID</th>
                        <th>名称</th>
                        <th>描述</th>
                        <th>状态</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($plugin as $plug) {
                        ?>
                        <tr>
                            <td><?php echo $plug['pluginId']; ?></td>
                            <td><?php echo $plug['pluginName']; ?></td>
                            <td><?php echo $plug['description']; ?></td>
                            <td><?php echo $plug['status'] == 'active' ? '<i class="text-success fa fa-check"></i>'
                                    : '<i class="text-danger fa fa-minus-circle"></i>'; ?></td>
                            <td>
                                <div class="btn-group">
                                    <?php
                                    if ($plug['status'] == 'active') {
                                        ?>
                                        <a class="text-danger" href="index.php?r=cms-backend/plug/setstatus&id=<?php echo $plug['id']; ?>">
                                            <i class="fa fa-minus-square"></i>
                                        </a>
                                        <?php
                                    } else {
                                        ?>
                                        <a class="text-primary" href="index.php?r=cms-backend/plug/setstatus&id=<?php echo $plug['id']; ?>">
                                            <i class="fa fa-check-square-o"></i>
                                        </a>
                                        <?php
                                    }
                                    ?>

                                </div>
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

    function changeType(contentType) {
        window.location.href = 'index.php?r=cms-backend/post/index&queryPostType=' + contentType;
    }
</script>
