<?php use yii\widgets\LinkPager; ?>
<?php $this->title = '网站内容'; ?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="card-title">网站内容</h4>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" style="float: right;">
                            <div class="form-group mr-2">
                                <select class="form-control form-control-sm" style="padding: 3px;" name="widgetType"
                                        onchange="changeType(this.value)">
                                    <?php
                                    foreach ($contentType as $ptype) {
                                        if ($queryPostType == $ptype['optionValue']) {
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
                            <div class="form-group">
                                <button type="button" class="btn btn-primary btn-xs"
                                        onclick="window.location.href='index.php?r=cms-backend/post/add'"><i
                                            class="fa fa-plus fa-lg"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>标题</th>
                        <th>状态</th>
                        <th>创建时间</th>
                        <th width="15%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($post_list as $post) {
                        ?>
                        <tr>
                            <td><?php echo $post['title']; ?></td>
                            <th><?php echo $post['status'] == 'online' ? '<i class="text-success fa fa-check fa-lg"></i>'
                                    : '<i class="fa fa-minus-circle  text-danger fa-lg"></i>'; ?></th>
                            <td><?php echo $post['createtime']; ?></td>
                            <td>
                                <a class=" text-primary mr-1"
                                   href="index.php?r=cms-backend/post/update&id=<?php echo $post['id']; ?>">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>
                                </a>
                                <a class=" text-danger mr-1"
                                   href="index.php?r=cms-backend/post/delete&id=<?php echo $post['id']; ?>">
                                    <i class="fa fa-trash fa-lg"></i>
                                </a>
                                <a class=" text-primary mr-1"
                                   href="index.php?r=cms-backend/post/copy&id=<?php echo $post['id']; ?>">
                                    <i class="fa fa-copy fa-lg"></i>
                                </a>
                                <a class=" text-success mr-1"
                                   href="index.php?r=cms-backend/post/config&id=<?php echo $post['id']; ?>">
                                    <i class="fa fa-cogs fa-lg"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12 mt-3 ">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $post_pagination,
                            'options' => array('class' => 'pagination mb-0'),
                            'linkOptions' => array('class' => 'page-link'),
                            'linkContainerOptions' => array('class' => 'page-item'),
                            'disabledListItemSubTagOptions' => array('class' => 'page-link')
                        ]);
                        ?>
                    </div>
                </div>
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
