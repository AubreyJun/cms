
<?php use app\components\cms\PageBreadcrumbWidget;
echo PageBreadcrumbWidget::widget(['id' => 76,'context'=>$this->context]);?>
<section id="content">
    <div class="content-wrap">
        <?php
        $widgetjson = $page['widgetjson'];
        $widgetObject = json_decode($widgetjson, true);

        if($widgetObject && sizeof($widgetObject)>0){
            foreach ($widgetObject as $widget) {
                echo $this->context->widget($widget['widgetId']);
            }
        }
        ?>
    </div>
</section>
