<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson,true);
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    if(isset($widgetObject['header'])){
        foreach ($widgetObject['header'] as $id){
            echo $this->context->renderFragment($id);
        }
    }
    ?>
</head>

<body>
<?php
if(isset($widgetObject['top'])){
    foreach ($widgetObject['top'] as $id){
        echo $this->context->renderFragment($id);
    }
}
if($this->context->data['REVIEW']==1){
    ?>
    <div id="fragment-content"></div>
    <?php
}else{
    echo $content;
}

if(isset($widgetObject['footer'])){
    foreach ($widgetObject['footer'] as $id){
        echo $this->context->renderFragment($id);
    }
}
?>
</body>

</html>
