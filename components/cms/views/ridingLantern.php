<div class=" nobgcolor notopmargin owl-carousel owl-carousel-full image-carousel footer-stick carousel-widget"
     data-margin="80" data-loop="true" data-nav="false" data-autoplay="5000" data-pagi="false"
     data-items-xs="2" data-items-sm="3" data-items-md="4" data-items-lg="5" data-items-xl="6">

    <?php
    foreach ($properties as $property){
        ?>
        <div class="oc-item"><a href="<?php echo $property['link']; ?>"><img src="<?php echo $property['image']; ?>" alt="<?php echo $property['title']; ?>"></a>
        </div>
        <?php
    }
    ?>

</div>
