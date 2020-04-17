<?php $this->title = '布局'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">布局</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <button type="button" class="btn btn-primary btn-xs"
                                onclick="window.location.href='index.php?r=cms-backend/layout/add'"><i class="fa fa-plus fa-lg"></i>
                        </button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>描述</th>
                        <th width="20%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['layoutName']; ?></td>
                            <td>
                                <a class="text-primary mr-1" href="index.php?r=cms-backend/layout/update&id=<?php echo $item['id']; ?>" >
                                    <i class="fa fa-pencil fa-lg"></i>
                                </a>
                                <a class="text-danger mr-1" onclick="deleteItem(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-trash fa-lg"></i>
                                </a>
                                <a class="text-success mr-1" href="index.php?r=cms-backend/layout/widget&id=<?php echo $item['id']; ?>" >
                                    <i class="fa fa-cogs fa-lg"></i>
                                </a>
                                <a class="text-info mr-1" target="_blank"
                                   href="index.php?r=cms-frontend/layout/visual&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-desktop fa-lg "></i>
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

    });
    function deleteItem(id) {
        doConfirm('删除布局？',function () {
            window.location.href = "index.php?r=cms-backend/layout/delete&id="+id;
        });
    }
</script>
