<?php
use app\components\cms\MetaWidget;
echo MetaWidget::widget(['id' => 14,'context'=>$this->context]);
?>
<!-- Navigation -->
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

<!-- Masthead -->
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

<!-- About Section -->
<section class="page-section bg-primary" id="about">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="text-white mt-0">提供你想要的服务</h2>
                <hr class="divider light my-4">
                <p class="text-white-50 mb-4">RKCMS可以用于快速创建你的网站！下载免费源码，获取你所需要的主题，你的目标很快就能达成！</p>
                <a class="btn btn-light btn-xl js-scroll-trigger" href="#services">立即开始</a>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="page-section" id="services">
    <div class="container">
        <h2 class="text-center mt-0">我们的服务</h2>
        <hr class="divider my-4">
        <div class="row">
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-gem text-primary mb-4"></i>
                    <h3 class="h4 mb-2">优质的主题</h3>
                    <p class="text-muted mb-0">应用市场提供多种行业所需的优质主题</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-laptop-code text-primary mb-4"></i>
                    <h3 class="h4 mb-2">永久更新</h3>
                    <p class="text-muted mb-0">开源代码库始终可开发进行中的代码保持一致</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-globe text-primary mb-4"></i>
                    <h3 class="h4 mb-2">快速改版</h3>
                    <p class="text-muted mb-0">可以通过后台主题模板编辑快速修改页面内容</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 text-center">
                <div class="mt-5">
                    <i class="fas fa-4x fa-heart text-primary mb-4"></i>
                    <h3 class="h4 mb-2">按需定制</h3>
                    <p class="text-muted mb-0">如果你有特殊需求，可以根据你的需求进行定制</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Portfolio Section -->
<section id="portfolio">
    <div class="container-fluid p-0">
        <div class="row no-gutters">
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="themes/basic/img/portfolio/fullsize/1.jpg">
                    <img class="img-fluid" src="themes/basic/img/portfolio/thumbnails/1.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            Category
                        </div>
                        <div class="project-name">
                            Project Name
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="themes/basic/img/portfolio/fullsize/2.jpg">
                    <img class="img-fluid" src="themes/basic/img/portfolio/thumbnails/2.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            Category
                        </div>
                        <div class="project-name">
                            Project Name
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="themes/basic/img/portfolio/fullsize/3.jpg">
                    <img class="img-fluid" src="themes/basic/img/portfolio/thumbnails/3.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            Category
                        </div>
                        <div class="project-name">
                            Project Name
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="themes/basic/img/portfolio/fullsize/4.jpg">
                    <img class="img-fluid" src="themes/basic/img/portfolio/thumbnails/4.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            Category
                        </div>
                        <div class="project-name">
                            Project Name
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="themes/basic/img/portfolio/fullsize/5.jpg">
                    <img class="img-fluid" src="themes/basic/img/portfolio/thumbnails/5.jpg" alt="">
                    <div class="portfolio-box-caption">
                        <div class="project-category text-white-50">
                            Category
                        </div>
                        <div class="project-name">
                            Project Name
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-lg-4 col-sm-6">
                <a class="portfolio-box" href="themes/basic/img/portfolio/fullsize/6.jpg">
                    <img class="img-fluid" src="themes/basic/img/portfolio/thumbnails/6.jpg" alt="">
                    <div class="portfolio-box-caption p-3">
                        <div class="project-category text-white-50">
                            Category
                        </div>
                        <div class="project-name">
                            Project Name
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="page-section bg-dark text-white">
    <div class="container text-center">
        <h2 class="mb-4">免费获取</h2>
        <a class="btn btn-light btn-xl" href="http://www.ranko.cn/opensource-2.html">立即下载</a>
    </div>
</section>

<!-- Contact Section -->
<section class="page-section" id="contact">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 text-center">
                <h2 class="mt-0">联系我们</h2>
                <hr class="divider my-4">
                <p class="text-muted mb-5">你是否准备创建自己的网站？想了解更多关于RKCMS的信息，你可以通过电话、邮箱联系我们，我们
                    将尽快给予回复！</p>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4 ml-auto text-center mb-5 mb-lg-0">
                <i class="fas fa-phone fa-3x mb-3 text-muted"></i>
                <div>+86 18068252703</div>
            </div>
            <div class="col-lg-4 mr-auto text-center">
                <i class="fas fa-envelope fa-3x mb-3 text-muted"></i>
                <a class="d-block" href="mailto:458820281@qq.com">458820281@qq.com</a>
            </div>
        </div>
    </div>
</section>
<input type='hidden' id="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>"/>