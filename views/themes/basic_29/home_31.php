<?php
$widgetjson = $page['widgetjson'];
$widgetObject = json_decode($widgetjson,true);

$layout = $page['layout'];
$layoutList = explode(",",$layout);

$index = 0;
foreach ($layoutList as $item){
    ?>
    <div class="col-lg-<?php echo $item; ?>">
        <?php
        if(isset($widgetObject[$index])){
            foreach ($widgetObject[$index] as $widgetId){
                echo $this->context->widget($widgetId);
            }
        }
        ?>
    </div>
    <?php
    $index ++;
}

?>


