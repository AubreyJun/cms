<?php
$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson,true);

foreach ($widgetObject as $widget){
    echo $this->context->widget($widget['widgetId']);
}

?>


