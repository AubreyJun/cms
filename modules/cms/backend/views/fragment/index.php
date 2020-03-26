<?php $this->title = '片段'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">片段</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <div class="form-group mr-2">
                        </div>
                        <div class="form-group ">
                            <button class="btn btn-primary btn-xs" onclick="addFragment()" ><i
                                        class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <td>名称</td>
                        <td width="20%">操作</td>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($fragmentList as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['fragmentName']; ?></td>
                            <td width="20%">
                                <a class="text-primary"
                                   href="index.php?r=cms-backend/fragment/update&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-pencil fa-lg mr-1"></i>
                                </a>
                                <a class="text-danger" onclick="deleteItem(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-trash fa-lg mr-1"></i>
                                </a>
                                <a class="text-success"
                                   href="index.php?r=cms-backend/fragment/copy&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-copy fa-lg mr-1"></i>
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

    function deleteItem(id) {
        doConfirm('删除片段？', function () {
            window.location.href = "index.php?r=cms-backend/fragment/delete&id=" + id;
        });
    }

    function addFragment() {
        window.location.href = 'index.php?r=cms-backend/fragment/add';
    }
</script>
