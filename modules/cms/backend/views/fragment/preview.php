<?php
$widgetJson = $layout['widgetjson'];
$widgetObject = json_decode($widgetJson,true);
?>
<!DOCTYPE html>
<html>
<?php
if(isset($widgetObject['header'])){
    foreach ($widgetObject['header'] as $id){
        echo $this->context->renderFragment($id);
    }
}
?>
<head>

</head>

<body id="page-top">
<?php
if(isset($widgetObject['top'])){
    foreach ($widgetObject['top'] as $id){
        echo $this->context->renderFragment($id);
    }
}
?>
<?php echo $content ?>
<?php
if(isset($widgetObject['footer'])){
    foreach ($widgetObject['footer'] as $id){
        echo $this->context->renderFragment($id);
    }
}
?>
</body>

</html>
