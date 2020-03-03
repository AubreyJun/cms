<?php
$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson,true);

foreach ($widgetObject as $widgetId){
    echo $this->context->widget($widgetId);
}

?>


