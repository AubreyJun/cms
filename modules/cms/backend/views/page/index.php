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
                                <select class="form-control form-control-sm" style="padding: 3px;" name="widgetType"
                                        onchange="changeType(this.value)">
                                    <?php
                                    foreach ($pageType as $ptype) {
                                        if ($current == $ptype['optionValue']) {
                                            ?>
                                            <option selected="selected"
                                                    value="<?php echo $ptype['optionValue']; ?>"><?php echo $ptype['optionDesc']; ?></option>
                                            <?php
                                        } else {
                                            ?>
                                            <option value="<?php echo $ptype['optionValue']; ?>"><?php echo $ptype['optionDesc']; ?></option>
                                            <?php
                                        }

                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs"
                                        onclick="window.location.href='index.php?r=cms-backend/page/add'"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>描述</th>
                        <th>默认</th>
                        <?php
                        if ($current == 'page') {
                            ?>
                            <th>KEY</th>
                            <?php
                        }
                        ?>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item) {
                        ?>
                        <tr>
                            <td><?php echo $item['pageName']; ?></td>
                            <td><?php echo $item['isDefault'] == 1 ? '<i class="text-success fa fa-check"></i>'
                                    : '<i class="text-danger fa fa-minus-circle"></i>'; ?></td>
                            <?php
                            if ($current == 'page') {
                                ?>
                                <td><?php echo $item['pageKey']; ?></td>
                                <?php
                            }
                            ?>
                            <td>
                                <a class="text-primary"
                                   href="index.php?r=cms-backend/page/update&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-pencil-square mr-1"></i>
                                </a>
                                <a class="text-danger"
                                   href="index.php?r=cms-backend/page/delete&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-trash mr-1"></i>
                                </a>
                                <?php
                                if ($current == 'page') {
                                    ?>
                                    <a class="text-success"
                                       href="index.php?r=cms-backend/page/config&id=<?php echo $item['id']; ?>">
                                        <i class="fa fa-cog mr-1"></i>
                                    </a>
                                    <?php
                                }
                                ?>
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

    function changeType(pageType) {
        window.location.href = 'index.php?r=cms-backend/page/index&pagetype=' + pageType;
    }
</script>
