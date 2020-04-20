<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson, true);

$pageObject = $this->context->data['CMS_PAGE'];
?>
<!DOCTYPE html>
<html dir="ltr">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

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

<body>
<?php

if (isset($widgetObject['top'])) {
    foreach ($widgetObject['top'] as $widget) {
        echo $this->context->renderFragment($widget);
    }
}

echo $content;

if (isset($widgetObject['footer'])) {
    foreach ($widgetObject['footer'] as $widget) {
        echo $this->context->renderFragment($widget);
    }
}
?>
</body>

</html>
