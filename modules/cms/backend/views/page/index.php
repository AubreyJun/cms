<?php $this->title = '页面'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">页面</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" style="float: right;">
                            <div class="form-group mr-2">
                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs"
                                        onclick="window.location.href='index.php?r=cms-backend/page/add'"><i
                                            class="fa fa-plus fa-lg"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>描述</th>
                        <th>路径</th>
                        <th width="20%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['pageName']; ?></td>
                            <td><?php echo $item['pagePath']; ?></td>
                            <td>
                                <a class="text-primary mr-1"
                                   href="index.php?r=cms-backend/page/update&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-pencil fa-lg "></i>
                                </a>
                                <a class="text-danger mr-1" onclick="deleteItem(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-trash fa-lg "></i>
                                </a>
                                <a class="text-success mr-1"
                                   href="index.php?r=cms-backend/page/widget&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-cogs fa-lg "></i>
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
        doConfirm('删除页面？',function () {
            window.location.href = "index.php?r=cms-backend/page/delete&id="+id;
        });
    }
    function changeType(pageType) {
        window.location.href = 'index.php?r=cms-backend/page/index&pagetype=' + pageType;
    }
</script>
