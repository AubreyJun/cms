<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson, true);
?>
<!DOCTYPE html>
<html dir="ltr">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <!-- Stylesheets
    ============================================= -->
    <link rel="stylesheet" href="static/frontend/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/style.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/swiper.css" type="text/css" />
    <link rel="stylesheet" href="static/frontend/css/dark.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/font-icons.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/magnific-popup.css" type="text/css"/>

    <link rel="stylesheet" href="static/frontend/css/responsive.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/responsive-rtl.css" type="text/css"/>

    <link rel="stylesheet" href="static/frontend/css/lib/font-awesome/css/font-awesome.min.css" type="text/css"/>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
    <![endif]-->

    <meta name="keywords" content="<?php echo $this->context->data['meta_keywords']; ?>">
    <meta name="description" content="<?php echo $this->context->data['meta_description']; ?>">

    <title><?php echo $this->context->data['meta_title']; ?> - Powered by ranko.cn </title>
    <?php
    if (isset($widgetObject['header'])) {
        foreach ($widgetObject['header'] as $id) {
            echo $this->context->renderFragment($id);
        }
    }
    ?>
</head>

<body class="stretched">

<div id="wrapper" class="clearfix">
    <?php
    if (isset($widgetObject['top'])) {
        foreach ($widgetObject['top'] as $id) {
            echo $this->context->renderFragment($id);
        }
    }

    echo $content;

    if (isset($widgetObject['footer'])) {
        foreach ($widgetObject['footer'] as $id) {
            echo $this->context->renderFragment($id);
        }
    }
    ?>
</div>
<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>
<!-- External JavaScripts
============================================= -->
<script src="static/frontend/js/jquery.js"></script>
<script src="static/frontend/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="static/frontend/js/functions.js"></script>
</body>

</html>
