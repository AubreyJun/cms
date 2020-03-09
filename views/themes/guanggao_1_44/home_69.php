
<?php
use app\components\cms\SliderWidget;
echo SliderWidget::widget(['id' => 38,'context'=>$this->context]);
?>
<div class="content-wrap">
    <?php
    $widgetjson = $page['widgetjson'];
    $widgetObject = json_decode($widgetjson,true);

    foreach ($widgetObject as $widget){
        echo $this->context->widget($widget['widgetId']);
    }

    ?>
</div>
