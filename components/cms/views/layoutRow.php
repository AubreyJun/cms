<?php

use app\components\cms\LayoutColumnWidget;
use app\components\cms\LayoutRowWidget;

$properties = $fragment['properties'];
$columns = json_decode($properties,true);
?>
<div class="row">
    <?php
    if(sizeof($columns['items'])>0){
        foreach ($columns['items'] as $column){
            echo LayoutColumnWidget::widget(['id'=>$column,'context'=>$context]);
        }
    }
    ?>
</div>
