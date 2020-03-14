<?php

use app\components\cms\LayoutContainerWidget;
use app\components\cms\LayoutFooterWidget;
use app\components\cms\PageNavigationWidget;

?>
<!DOCTYPE html>
<html>
<head>


    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="themes/cms/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="themes/cms/style.css" type="text/css"/>
    <link rel="stylesheet" href="themes/cms/css/dark.css" type="text/css"/>
    <link rel="stylesheet" href="themes/cms/css/font-icons.css" type="text/css"/>
    <link rel="stylesheet" href="themes/cms/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="themes/cms/css/magnific-popup.css" type="text/css"/>

    <link rel="stylesheet" href="themes/cms/css/magnific-popup.css" type="text/css"/>

    <link rel="stylesheet" href="themes/cms/css/lib/font-awesome/css/font-awesome.min.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>

    <!--    title,keywords,description-->
    <meta name="keywords" content="<?php echo $this->context->data['meta_keywords']; ?>">
    <meta name="description" content="<?php echo $this->context->data['meta_description']; ?>">
    <title><?php echo $this->context->data['meta_title']; ?> - Powered by ranko.cn </title>

</head>
<body>
<!-- The Main Wrapper
	============================================= -->
<div id="wrapper" class="clearfix">

    <header id="header">

        <div id="header-wrap">
            <?php echo PageNavigationWidget::widget(['id' => 0, 'context' => $this->context]); ?>
        </div>

    </header>

    <?php echo $content ?>

    <footer id="footer" class="dark mt-lg-3">

        <?php echo LayoutFooterWidget::widget(['id' => 0,'context'=>$this->context]);?>

    </footer>

</div>

<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>

<!-- External JavaScripts
============================================= -->
<script src="themes/cms/js/jquery.js"></script>
<script src="themes/cms/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="themes/cms/js/functions.js"></script>


</body>
</html>
