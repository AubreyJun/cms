<?php $this->title = '参数'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">参数</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" style="float: right;">
                            <div class="form-group mr-2">
                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs"
                                        onclick="window.location.href='index.php?r=cms-backend/param/add'"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>参数描述</th>
                        <th>KEY</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['description']; ?></td>
                            <td><?php echo $item['cfgkey']; ?></td>
                            <td>
                                <a class="text-primary"
                                   href="index.php?r=cms-backend/param/update&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a class="text-danger"
                                   href="index.php?r=cms-backend/param/delete&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-trash"></i>
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
    function changeType(pageType) {
        window.location.href = 'index.php?r=cms-backend/param/index&configType=' + pageType;
    }
</script>
