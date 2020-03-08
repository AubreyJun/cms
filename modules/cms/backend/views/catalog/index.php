<?php $this->title = '目录设置'; ?>
<style>
    .m-l-1 {
        margin-left: 25px;
    }

    .m-l-2 {
        margin-left: 50px;
    }

    .m-l-3 {
        margin-left: 75px;
    }

    .m-l-4 {
        margin-left: 100px;
    }

    .m-l-5 {
        margin-left: 125px;
    }
</style>
<?php
function echoTr($navgation, $level)
{
    if (isset($navgation['children'])) {
        $level++;
        foreach ($navgation['children'] as $child) {
            ?>
            <tr>
                <th class="text-center" ><?php echo $child['object']['id']; ?></th>
                <td><span class="m-l-<?php echo $level; ?>"><?php echo $child['object']['catalogName']; ?></span></td>
                <td><?php echo $child['object']['sequenceNumber']; ?></td>
                <td>
                    <a class="text-primary mr-1"
                       href="index.php?r=cms-backend/catalog/update&id=<?php echo $child['object']['id']; ?>">
                        <i class="fa fa-pencil fa-lg"></i>
                    </a>
                    <a class="text-danger"
                       href="index.php?r=cms-backend/catalog/delete&id=<?php echo $child['object']['id']; ?>">
                        <i class="fa fa-trash fa-lg"></i>
                    </a>
                </td>
            </tr>
            <?php
            echoTr($child, $level);
        }
    }
}

?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">目录设置</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" style="float: right;">
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-xs"
                                        onclick="window.location.href='index.php?r=cms-backend/catalog/add'"><i
                                            class="fa fa-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th width="5%" class="text-center">ID</th>
                        <th>标题</th>
                        <th>排序</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($navgation as $item) {
                        ?>
                        <tr>
                            <th class="text-center"><?php echo $item['object']['id']; ?></th>
                            <td><span class="m-l-0"><?php echo $item['object']['catalogName']; ?></span></td>
                            <td><?php echo $item['object']['sequenceNumber']; ?></td>
                            <td>
                                <a class="text-primary mr-1"
                                   href="index.php?r=cms-backend/catalog/update&id=<?php echo $item['object']['id']; ?>">
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>
                                <a class="text-danger" onclick="deleteItem(<?php echo $item['object']['id']; ?>)">
                                    <i class="fa fa-trash fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        echoTr($item, 0);
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
    function deleteItem(id) {
        doConfirm('删除分类目录？',function () {
            window.location.href = "index.php?r=cms-backend/catalog/delete&id="+id;
        });
    }
</script>
