<?php
if($style['pvalue']=='common'){
    ?>
    <div class="container clearfix">

        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

        <!-- Logo
        ============================================= -->
        <div id="logo">
            <a href="index.html" class="standard-logo" data-dark-logo="<?php echo $logo1['pvalue']; ?>"><img
                        src="<?php echo $logo1['pvalue']; ?>" alt="<?php echo $title['pvalue']; ?>"></a>
            <a href="index.html" class="retina-logo" data-dark-logo="<?php echo $logo2['pvalue']; ?>"><img
                        src="<?php echo $logo2['pvalue']; ?>" alt="<?php echo $title['pvalue']; ?>"></a>
        </div>
        <!-- #logo end -->

        <!-- Primary Navigation
        ============================================= -->
        <nav id="primary-menu">

            <ul class="sf-js-enabled" style="touch-action: pan-y;">
                <li><a href="index.html" class="sf-with-ul">
                        <div>首页</div>
                    </a></li>
                <li><a href="companyinfo.html" class="sf-with-ul">
                        <div>公司简介</div>
                    </a></li>
                <li><a href="productList.html" class="sf-with-ul">
                        <div>产品中心</div>
                    </a></li>
                <li><a href="imageList.html" class="sf-with-ul">
                        <div>成功案例</div>
                    </a></li>
                <li><a href="articleList.html" class="sf-with-ul">
                        <div>服务支持</div>
                    </a></li>
                <li><a href="feedback.html" class="sf-with-ul">
                        <div>联系我们</div>
                    </a></li>
            </ul>

        </nav><!-- #primary-menu end -->

    </div>
    <?php
}
?>

