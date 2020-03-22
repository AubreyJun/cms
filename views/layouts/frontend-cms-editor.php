<?php

$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetjson, true);

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

    <link rel="stylesheet" href="themes/cms/css/responsive.css" type="text/css"/>
    <link rel="stylesheet" href="themes/cms/css/custom.css" type="text/css"/>
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

    <div class="editor_content" id="editor_"></div>

    <?php
    if (isset($widgetObject['header'])) {
        foreach ($widgetObject['header'] as $widget) {
            echo $this->context->widget($widget['widgetId']);
        }
    }
    ?>

    <?php echo $content ?>

    <?php
    if (isset($widgetObject['footer'])) {
        foreach ($widgetObject['footer'] as $widget) {
            echo $this->context->widget($widget['widgetId']);
        }
    }
    ?>

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


<div id='editor_slider' style="z-index: 2000;background: lightgrey;" class="border-right">
    <i class="i-rounded i-middle icon-cogs" id="editor_trigger"
       style="margin: 0px !important;border-radius: 0px;position: absolute;right: -53px;"></i>
    <div id="editor_plugin">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand">组件</a>
        </nav>

        <div id="editor_plugin_inner" class="editor_plugin_inner" style="padding: 20px;z-index: 2001;overflow-y: scroll;overflow-x: hidden;">
            <div class="toggle toggle-bg">
                <div class="togglet" style="padding-left: 16px;">基础</div>
                <div class="togglec border-bottom" style="padding: 0px;background: #FFFFFF;">
                    <div class="container">
                        <div class="row ">
                            <div class="col-lg-6 mb-3 mt-3"><button type="button" class="btn btn-outline-secondary btn-block">Default</button></div>
                            <div class="col-lg-6 mb-3 mt-3"><button type="button" class="btn btn-outline-secondary btn-block">Default</button></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 mb-3"><button type="button" class="btn btn-outline-secondary btn-block">Default</button></div>
                            <div class="col-lg-6 mb-3"><button type="button" class="btn btn-outline-secondary btn-block">Default</button></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="toggle toggle-bg">
                <div class="togglet" style="padding-left: 16px;">专业</div>
                <div class="togglec border-bottom" style="padding: 0px;">Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi
                    quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque
                    explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas
                    beatae vero vitae nulla.
                </div>
            </div>

            <div class="toggle toggle-bg">
                <div class="togglet" style="padding-left: 16px;">常规</div>
                <div class="togglec border-bottom" style="padding: 0px;">Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi
                    quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque
                    explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas
                    beatae vero vitae nulla.
                </div>
            </div>

            <div class="toggle toggle-bg">
                <div class="togglet" style="padding-left: 16px;">网站</div>
                <div class="togglec border-bottom" style="padding: 0px;">Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi
                    quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque
                    explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas
                    beatae vero vitae nulla.
                </div>
            </div>
            <div class="toggle toggle-bg">
                <div class="togglet" style="padding-left: 16px;">网站33333</div>
                <div class="togglec border-bottom" style="padding: 0px;">Lorem ipsum dolor sit amet, consectetur
                    adipisicing elit. Assumenda, dolorum, vero ipsum molestiae minima odio quo voluptate illum excepturi
                    quam cum voluptates doloribus quae nisi tempore necessitatibus dolores ducimus enim libero eaque
                    explicabo suscipit animi at quaerat aliquid ex expedita perspiciatis? Saepe, aperiam, nam unde quas
                    beatae vero vitae nulla.
                </div>
            </div>

        </div>
    </div>

</div>

<script src="static/frontend/lib/slidereveal/jquery.slidereveal.min.js"></script>
<script>
    var nicescroll = null;
    $(function () {
        var height = $(document).height();
        $("#editor_plugin_inner").css("height", height - 40);
        $("#editor_slider").slideReveal({
            trigger: $("#editor_trigger"),
            width: '20%',
            shown: function (slider, trigger) {
                $("body").css("margin-left", "20%");
            },
            hidden: function (slider, trigger) {
                $("body").css("margin-left", "0px");
            },
            show: function (slider, trigger) {

            },
            hide: function (slider, trigger) {

            },
            push: false
        });
    });
</script>
</body>
</html>
