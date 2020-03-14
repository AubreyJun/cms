<?php
$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson, true);

if($widgetObject && sizeof($widgetObject)>0){
    foreach ($widgetObject as $widget) {
        echo $this->context->widget($widget['widgetId']);
    }
}


?>
