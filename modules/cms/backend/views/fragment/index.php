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
                        <form class="form-inline" style="float: right;">
                            <div class="form-group mr-2">
                                <select class="form-control form-control-sm" style="padding: 3px;" name="fragmentType"
                                        onchange="changeType(this.value)">
                                    <?php
                                    foreach ($widgets as $widget){
                                        if($current ==  $widget['optionValue']){
                                            ?>
                                            <option selected="selected" value="<?php echo $widget['optionValue']; ?>"><?php echo $widget['optionDesc']; ?></option>
                                            <?php
                                        }else{
                                            ?>
                                            <option  value="<?php echo $widget['optionValue']; ?>"><?php echo $widget['optionDesc']; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group ">
                                <button type="button" class="btn btn-primary btn-xs" onclick="add()"><i
                                            class="fa fa-plus"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <table class="table table-bordered">
                    <tbody>
                    <?php
                    foreach ($fragmentList as $item) {
                        ?>
                        <tr>
                            <td width="40%">&lt;?php echo <?php echo ucfirst($item['fragmentType']); ?>Widget::widget(['id' => <?php echo $item['id']; ?>,'context'=>$this->context]);?&gt;
                            </td>
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
        // $("table").colResizable();
    });

    function deleteItem(id) {
        doConfirm('删除片段？',function () {
            window.location.href = "index.php?r=cms-backend/fragment/delete&id="+id;
        });
    }

    function changeType(fragmentType) {
        window.location.href = 'index.php?r=cms-backend/fragment/index&fragmentType=' + fragmentType;
    }

    function add() {
        var fragmentType = $("select[name=fragmentType]").val();
        window.location.href = 'index.php?r=cms-backend/fragment/add&fragmentType=' + fragmentType;
    }
</script>
