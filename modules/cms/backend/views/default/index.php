<?php
$this->title = '控制面板';
?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">基本信息</h4>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td width="20%">域名：</td>
                        <td width="30%"><?php echo $host; ?></td>
                        <td width="20%">主题：</td>
                        <td width="30%"><?php echo $defaultTheme['themeName']; ?></td>
                    </tr>
                    <tr>
                        <td width="20%">文章：</td>
                        <td width="30%"><?php echo $count_article; ?></td>
                        <td width="20%">图片：</td>
                        <td width="30%"><?php echo $count_image; ?></td>
                    </tr>
                    <tr>
                        <td width="20%">下载：</td>
                        <td width="30%"><?php echo $count_download; ?></td>
                        <td width="20%">产品：</td>
                        <td width="30%"><?php echo $count_product; ?></td>
                    </tr>
                    <tr>
                        <td width="20%">招聘：</td>
                        <td width="30%" colspan="3"><?php echo $count_employee; ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">常用工具</h4>
                <div class="row mb-3">
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/post/index" class="btn btn-light btn-block"><i
                                    class="fa fa-files-o"></i>内容</a>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/theme/index" class="btn btn-light btn-block"><i
                                    class="mdi mdi-buffer"></i>主题</a>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/page/index" class="btn btn-light btn-block"><i
                                    class="fa fa-html5"></i>页面</a>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/layout/index" class="btn btn-light btn-block"><i
                                    class="fa fa-arrows"></i>布局</a>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/plug/index" class="btn btn-light btn-block"><i
                                    class="fa fa-plug"></i>插件</a>
                    </div>
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/catalog/index" class="btn btn-light btn-block"><i
                                    class="fa fa-tree"></i>目录</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <a href="index.php?r=cms-backend/param/index" class="btn btn-light btn-block"><i
                                    class="fa fa-cogs"></i>参数</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

