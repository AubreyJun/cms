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
                                <select class=" select2" style="width: 100px;" name="widgetType"
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
                                <button type="button" class="btn btn-primary btn-xs"><i
                                            class="fa fa-plus fa-lg " onclick="postAdd()"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered text-nowrap">
                    <thead>
                    <tr>
                        <th width="5%">
                            <input type="checkbox" class="form-control " name="ckAll"
                                   onclick="loadCheckBox()"/>
                        </th>
                        <th>标题</th>
                        <th>分类</th>
                        <th width="8%">状态</th>
                        <th width="15%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($post_list as $post) {
                        ?>
                        <tr>
                            <td>
                                <input type="checkbox" name="ckItem" class="form-control"
                                       value="<?php echo $post['id']; ?>"/>
                            </td>
                            <td><?php echo $post['title']; ?></td>
                            <td><?php echo $post['catalog']['catalogName']; ?></td>
                            <th><?php echo $post['status'] == 'online' ? '<i class="text-success fa fa-check fa-lg"></i>'
                                    : '<i class="fa fa-minus-circle  text-danger fa-lg"></i>'; ?></th>
                            <td>
                                <a class=" text-primary mr-1"
                                   href="index.php?r=cms-backend/post/update&id=<?php echo $post['id']; ?>">
                                    <i class="fa fa-pencil-square-o fa-lg"></i>
                                </a>
                                <a class=" text-danger mr-1" onclick="deletePost(<?php echo $post['id']; ?>);">
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
                <div class="row mt-3 mb-3">
                    <div class="col-lg-12">
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
                <div class="row">
                    <div class="col-lg-6">
                        <form class="form-inline" id="form-delete" method="post" style="float: left;"
                              action="index.php?r=cms-backend/post/deleteall">
                            <input type="hidden" name="items" value=""/>
                            <input type="hidden" name="queryPostType" value="<?php echo $queryPostType; ?>"/>
                            <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>"/>
                            <div class="form-group mr-2">
                                <select class="form-control form-control-sm" style="padding: 3px;" name="checkAction">
                                    <option value="deleteSelectItems">删除选择项</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-danger btn-xs" onclick="deleteAll()">确认
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-6 text-right">
                        <form class="form-inline" style="float: right;">
                            <div class="form-group mr-2">
                                <select class="form-control form-control-sm" style="padding: 3px;" name="postType"
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
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        loadCheckBox();
    });

    function loadCheckBox() {
        var checked = $("input[name=ckAll]").prop("checked")
        if (checked) {
            $("input[name=ckItem]").prop("checked", true);
        } else {
            $("input[name=ckItem]").prop("checked", false);
        }
    }

    function deletePost(id) {
        doConfirm('删除文章？', function () {
            window.location.href = "index.php?r=cms-backend/post/delete&id=" + id;
        });
    }

    function deleteAll() {
        var itemvalues = "";

        $("input[name='ckItem']:checkbox:checked").each(function () {
            if (itemvalues == "") {
                itemvalues += $(this).val()
            } else {
                itemvalues += "," + $(this).val()
            }
        });

        $("input[name=items]").val(itemvalues);
        $("#form-delete").submit();
    }

    function postAdd() {
        var postType = $("select[name=postType]").val();
        window.location.href = 'index.php?r=cms-backend/post/add&postType='+postType;
    }

    function changeType(contentType) {
        window.location.href = 'index.php?r=cms-backend/post/index&queryPostType=' + contentType;
    }
</script>
