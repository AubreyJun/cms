<?php

use app\components\cms\LayoutRowWidget;

$properties = $fragment['properties'];
$column = json_decode($properties,true);
?>
<div class="col-lg-<?php echo $column['gridWidth']; ?>">
    <?php
    if(sizeof($column['items'])>0){
        foreach ($column['items'] as $widget){
            echo $context->widget($widget['widgetId']);
        }
    }
    ?>
</div>
