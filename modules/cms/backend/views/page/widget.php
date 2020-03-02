<?php $this->title = '页面片段'; ?>
<?php
$layoutList = explode(',', $page['layout']);
?>
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
                                <button type="button" class="btn btn-primary btn-xs"><i
                                            class="fa fa-save fa-lg"></i>保存</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row">
                    <?php
                    foreach ($layoutList as $item) {
                        ?>
                        <div class="col-lg-<?php echo $item; ?> div-table-<?php echo $item; ?>">
                            <table class="table table-bordered table-widget">
                                <thead>
                                    <tr>
                                        <td class="text-center">
                                            片段
                                        </td>
                                        <td width="30%">
                                            <i class="fa fa-plus-circle fa-lg text-success" onclick="addWidget('div-table-<?php echo $item; ?>')"></i>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><select class="form-control">
                                            </select></td>
                                        <td>
                                            <i class="fa fa-arrow-up fa-lg text-success mr-1 tool-up" ></i>
                                            <i class="fa fa-arrow-down fa-lg text-warning  mr-1 tool-down" ></i>
                                            <i class="fa fa-trash fa-lg text-danger tool-delete" ></i>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        $(".table-widget tbody .tool-delete").bind("click",function () {
            $(this).closest("tr").remove();
        });
    });
    function addWidget(widgetTable) {

    }
</script>
