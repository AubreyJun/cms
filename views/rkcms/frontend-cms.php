<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson, true);

$pageObject = $this->context->data['CMS_PAGE'];
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="static/frontend/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/style.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/swiper.css" type="text/css"/>
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
    <header id="header" class="full-header">
        <div id="header-wrap">
            <?php
            if (isset($widgetObject['top'])) {
                foreach ($widgetObject['top'] as $widget) {
                    echo $this->context->renderFragment($widget);
                }
            }
            ?>
        </div>
    </header>
    <?php
    echo $content;
    ?>

    <div id="footer" class="dark">
        <?php
        if (isset($widgetObject['footer'])) {
            foreach ($widgetObject['footer'] as $widget) {
                echo $this->context->renderFragment($widget);
            }
        }
        ?>
    </div>

</div>
<div id="gotoTop" class="icon-angle-up"></div>
<script src="static/frontend/js/jquery.js"></script>
<script src="static/frontend/js/plugins.js"></script>
<script src="static/frontend/js/functions.js"></script>
</body>

</html>
