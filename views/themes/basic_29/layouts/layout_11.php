<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="<?php echo $this->context->data['meta_keywords']; ?>">
    <meta name="description" content="<?php echo $this->context->data['meta_description']; ?>">

    <title><?php echo $this->context->data['meta_title']; ?> - Powered by ranko.cn </title>

    <!-- Font Awesome Icons -->
    <link href="themes/basic/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="themes/basic/vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="themes/basic/css/creative.css" rel="stylesheet">

</head>

<body id="page-top">
<nav class="navbar navbar-expand-lg navbar-light fixed-top py-3" id="mainNav">
    <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="#page-top">RANKO.CN</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
                data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto my-2 my-lg-0">
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#about">关于</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#services">服务</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#portfolio">案例</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link js-scroll-trigger" href="#contact">联系</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<header class="masthead">
    <div class="container h-100">
        <div class="row h-100 align-items-center justify-content-center text-center">
            <div class="col-lg-10 align-self-end">
                <h1 class="text-uppercase text-white font-weight-bold">RKCMS</h1>
                <hr class="divider my-4">
            </div>
            <div class="col-lg-8 align-self-baseline">
                <p class="text-white-75 font-weight-light mb-5">开源、免费的企业网站系统!在GPL开源协议前提下，个人或者企业组织可以免费使用!</p>
                <a class="btn btn-primary btn-xl js-scroll-trigger" href="#about">了解更多</a>
            </div>
        </div>
    </div>
</header>

<?php echo $content ?>


<!-- Footer -->
<footer class="bg-light py-5">
    <div class="container">
        <div class="small text-center text-muted">版权所有 &copy; <?php echo date('Y'); ?> - 无锡市蓝科创想科技有限公司</div>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="themes/basic/vendor/jquery/jquery.min.js"></script>
<script src="themes/basic/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Plugin JavaScript -->
<script src="themes/basic/vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="themes/basic/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Custom scripts for this template -->
<script src="themes/basic/js/creative.min.js"></script>

</body>

</html>
