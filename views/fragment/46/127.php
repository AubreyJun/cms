<?php
$navbarActive = $this->context->data['navbarActive'];  
?>
<div class="container">
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="#">RKCMS</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarColor01">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link <?php echo $navbarActive=='home'?'active':''; ?>" href="#">首页</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo $navbarActive=='aboutus'?'active':''; ?>" href="#" id="navbar-aboutus" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    关于我们
                </a>
                <div class="dropdown-menu" aria-labelledby="navbar-aboutus">
                    <a class="dropdown-item" href="#">公司简介</a>
                    <a class="dropdown-item" href="#">在线留言</a>
                    <a class="dropdown-item" href="#">在线反馈</a>
                    <a class="dropdown-item" href="#">联系我们</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo $navbarActive=='product'?'active':''; ?>" href="#" id="navbar-product" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    产品展示
                </a>
                <div class="dropdown-menu" aria-labelledby="navbar-product">
                    <a class="dropdown-item" href="#">电脑&平板</a>
                    <a class="dropdown-item" href="#">手机</a>
                    <a class="dropdown-item" href="#">配件</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle <?php echo $navbarActive=='news'?'active':''; ?>" href="#" id="navbar-news" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    新闻动态
                </a>
                <div class="dropdown-menu" aria-labelledby="navbar-news">
                    <a class="dropdown-item" href="#">媒体报道</a>
                    <a class="dropdown-item" href="#">行业资讯</a>
                    <a class="dropdown-item" href="#">企业新闻</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $navbarActive=='download'?'active':''; ?>" href="#">资料下载</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $navbarActive=='cases'?'active':''; ?>" href="#">客户案例</a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo $navbarActive=='employee'?'active':''; ?>" href="#">加入我们</a>
            </li>
        </ul>
    </div>
</nav>
</div>  