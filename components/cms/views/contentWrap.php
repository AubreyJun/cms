<?php
$properties = $fragment['properties'];
$contentItems = json_decode($properties,true);
?>
<section id="content">
    <div class="content-wrap">
        <?php
        if(sizeof($contentItems)>0){
            foreach ($contentItems as $item){
                echo $context->widget($item['widgetId']);
            }
        }
        ?>
    </div>
</section>
