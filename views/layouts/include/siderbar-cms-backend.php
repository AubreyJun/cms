<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">
            <span class="nav-link">导航栏</span>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?r=cms-backend/default/index">
                <i class="mdi mdi-compass-outline menu-icon"></i>
                <span class="menu-title">控制面板</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?r=cms-backend/post/index">
                <i class="fa fa-book menu-icon"></i>
                <span class="menu-title">网站内容</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cms-template" aria-expanded="false"
               aria-controls="cms-template">
                <i class="mdi mdi-buffer menu-icon"></i>
                <span class="menu-title">网站模版</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="cms-template">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/theme/index">主题</a></li>
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/page/index">页面</a></li>
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/layout/index">布局</a></li>
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/fragment/index">片段</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="index.php?r=cms-backend/plug/index">
                <i class="fa fa-plus-circle menu-icon"></i>
                <span class="menu-title">网站插件</span>
            </a>
        </li>
        <?php
        if(sizeof($this->context->data['pluginList'])>0){
            ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#cms-plugin" aria-expanded="false"
                   aria-controls="cms-plugin">
                    <i class="fa fa-plug menu-icon"></i>
                    <span class="menu-title">插件管理</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="cms-plugin">
                    <ul class="nav flex-column sub-menu">
                        <?php
                        foreach ($this->context->data['pluginList'] as $plug){
                            ?>
                            <li class="nav-item "><a class="nav-link" href="index.php?r=plugin-backend/<?php echo strtolower($plug['pluginId']); ?>/index"><?php echo $plug['pluginName']; ?></a></li>
                            <?php
                        }
                        ?>

                    </ul>
                </div>
            </li>
            <?php
        }
        ?>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#cms-config" aria-expanded="false"
               aria-controls="cms-config">
                <i class="fa fa-cogs menu-icon"></i>
                <span class="menu-title">系统设置</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="cms-config">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/param/index">参数设置</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/catalog/index">目录设置</a></li>
                </ul>
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item "><a class="nav-link" href="index.php?r=cms-backend/navigation/index">页面导航</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item nav-category">
            <span class="nav-link">技术支持</span>
        </li>
        <li class="nav-item nav-doc">
            <a class="nav-link" href="http://www.ranko.cn">
                <i class="fa fa-shopping-cart menu-icon"></i>
                <span class="menu-title">应用市场</span>
            </a>
        </li>
        <li class="nav-item nav-doc">
            <a class="nav-link" href="http://www.ranko.cn">
                <i class="fa fa-files-o menu-icon"></i>
                <span class="menu-title">在线文档</span>
            </a>
        </li>
    </ul>
</nav>
