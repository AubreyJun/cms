<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson, true);
?>
<!DOCTYPE html>
<html>
<head>
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
</body>

</html>
