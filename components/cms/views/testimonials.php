<div class="clearfix"></div>
<?php
$properties = $fragment['properties'];
$propObject = json_decode($properties, true);

if ($propObject['container'] == 1){
?>
<div class="container clearfix">
    <?php
    }

    ?>
    <div class="fslider testimonial testimonial-full bottommargin" data-animation="fade" data-arrows="false">
        <div class="flexslider" style="height: 176px;">
            <div class="slider-wrap">
                <?php
                foreach ($propObject['items'] as $item){
                    ?>
                    <div class="slide" data-thumb-alt="" style="width: 100%; float: left; margin-right: -100%; position: relative; opacity: 0; display: block; z-index: 1;">
                        <div class="testi-image">
                            <a href="#"><img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" draggable="false"></a>
                        </div>
                        <div class="testi-content">
                            <p><?php echo $item['description']; ?></p>
                            <div class="testi-meta">
                                <?php echo $item['title']; ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
    </div>
    <?php

    if ($propObject['container'] == 1){
    ?>
</div>
<?php
}

?>
