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
                        <div class="form-inline" style="float: right;">
                            <div class="form-group mr-4">
                                <select class=" select2 " style="width: 100px;" name="pageItem" id="pageItem"
                                        onchange="changePage(this.value)">
                                    <option value="0">通用</option>
                                    <?php
                                    foreach ($pagelist as $page) {
                                        if ($pageId == $page['id']) {
                                            ?>
                                            <option selected="selected"
                                                    value="<?php echo $page['id']; ?>"><?php echo $page['pageName']; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $page['id']; ?>"><?php echo $page['pageName']; ?></option>
                                            <?php
                                        }

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <button class="btn btn-primary btn-xs" onclick="addFragment()"><i
                                            class="fa fa-plus"></i>
                                </button>
                            </div>
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
                                    <i class="fa fa-code fa-lg mr-1"></i>
                                </a>
                                <a class="text-danger" onclick="deleteItem(<?php echo $item['id']; ?>)">
                                    <i class="fa fa-trash fa-lg mr-1"></i>
                                </a>
                                <a class="text-success"
                                   href="index.php?r=cms-backend/fragment/copy&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-copy fa-lg mr-1"></i>
                                </a>
                                <a class="text-info mr-1" target="_blank"
                                   href="index.php?r=cms-backend/fragment/visual&id=<?php echo $item['id']; ?>">
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
        doConfirm('删除片段？', function () {
            window.location.href = "index.php?r=cms-backend/fragment/delete&id=" + id;
        });
    }

    function changePage(pageId) {
        window.location.href = "index.php?r=cms-backend/fragment/index&pageId=" + pageId;
    }

    function addFragment() {
        window.location.href = 'index.php?r=cms-backend/fragment/add';
    }
</script>
