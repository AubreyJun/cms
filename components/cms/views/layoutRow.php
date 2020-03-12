<?php

use app\components\cms\LayoutColumnWidget;
use app\components\cms\LayoutRowWidget;

$properties = $fragment['properties'];
$columns = json_decode($properties,true);

if(isset($columns['container'])&&$columns['container']==1){
    ?>
    <div class="container clearfix">
        <div class="row">
            <?php
            if(sizeof($columns['items'])>0){
                foreach ($columns['items'] as $column){
                    echo LayoutColumnWidget::widget(['id'=>$column,'context'=>$context]);
                }
            }
            ?>
        </div>
    </div>
    <?php
}else{
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
    <?php
}
?>

