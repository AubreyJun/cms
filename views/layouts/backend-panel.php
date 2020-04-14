<?php

use yii\helpers\Html;

\app\assets\BackendAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="<?= Yii::$app->charset ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?> - Powered by ranko.cn ! </title>
    <link rel="shortcut icon" href="static/backend/images/favicon.ico">
    <?php $this->head() ?>
</head>
<body class=" <?php echo $this->context->data['siderBarClass']; ?>">
<?php $this->beginBody() ?>
<div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
            <a class="navbar-brand brand-logo" href="index.php?r=cms-backend"><img
                        src="../../static/backend/images/admin-logo.png"
                        alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="index.php?r=admin"><img
                        src="../../static/backend/images/admin-logo-mini.png" alt="logo"/></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
            <button class="navbar-toggler navbar-toggler align-self-center mr-2" type="button" data-toggle="minimize">
                <i class="mdi mdi-menu"></i>
            </button>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="javascript:window.location.reload();">
                        <i class="mdi mdi-reload"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <select class="select2" style="width:160px;" onchange="changeEditTheme(this.value)">
                        <?php
                        foreach ($this->context->data['themeList'] as $theme) {
                            if ($theme['id'] == $this->context->data['editThemeId']) {
                                ?>
                                <option selected="selected"
                                        value="<?php echo $theme['id']; ?>"><?php echo $theme['themeName']; ?></option>
                                <?php
                            } else {
                                ?>
                                <option value="<?php echo $theme['id']; ?>"><?php echo $theme['themeName']; ?></option>
                                <?php
                            }

                        }
                        ?>
                    </select>
                </li>
            </ul>
            <ul class="navbar-nav navbar-nav-right">
                <li class="nav-item dropdown d-none d-lg-flex">
                    <a class="nav-link dropdown-toggle" id="languageDropdown" href="#" data-toggle="dropdown">
                        <?php echo Yii::$app->user->identity['adminname']; ?>
                    </a>
                    <div class="dropdown-menu navbar-dropdown" aria-labelledby="languageDropdown">
                        <a class="dropdown-item" href="index.php?r=cms-backend/admininfo/profile">
                            <i class="fa fa-key mr-3"></i> 修改密码
                        </a>
                        <a class="dropdown-item" href="index.php?r=backend/logout">
                            <i class="fa fa-power-off mr-3"></i> 退出登入
                        </a>
                    </div>
                </li>
                <li class="nav-item  nav-profile dropdown">
                    <a class="nav-link" href="../" target="_blank">
                        <i class="mdi mdi-home-circle"></i>
                    </a>
                </li>
            </ul>
            <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                    data-toggle="offcanvas">
                <span class="mdi mdi-menu"></span>
            </button>
        </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <?php
        include 'include/siderbar-cms-backend.php';
        ?>

        <div class="main-panel">
            <div class="content-wrapper">
                <?= $content ?>
            </div>
            <footer class="footer">
                <div class="container-fluid clearfix">
                    <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a
                                href="#">无锡市蓝科创想科技有限公司</a>. All rights reserved.</span>
                </div>
            </footer>
        </div>
    </div>
</div>
<?php $this->endBody() ?>
<script>
    function changeEditTheme(themeId) {
        window.location.href = "index.php?r=cms-backend/default/edittheme&themeId="+themeId;
    }
</script>
</body>
</html>
<?php $this->endPage() ?>
