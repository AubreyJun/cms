<?php

use app\components\cms\LayoutRowWidget;

$properties = $fragment['properties'];
$container = json_decode($properties,true);

?>
<div class="container <?php echo $container['cssStyle']; ?>">

    <?php
    if(sizeof($container['items'])>0){
        foreach ($container['items'] as $row){
            echo LayoutRowWidget::widget(['id'=>$row,'context'=>$context]);
        }
    }
    ?>

</div>
