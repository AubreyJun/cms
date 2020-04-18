<?php
$widgetJson = $this->context->data['CMS_PAGE']['widgetjson'];
$widgetObject = json_decode($widgetJson, true);
if ($widgetObject && sizeof($widgetObject) > 0) {
    foreach ($widgetObject as $widget) {
        echo $this->context->renderFragment($widget);
    }
}
?>