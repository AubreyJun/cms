<section id="slider" class="slider-element boxed-slider">

    <div class="container clearfix">

        <div class="fslider" data-easing="easeInQuad">
            <div class="flexslider">
                <div class="slider-wrap">
                    <?php
                    foreach ($slider as $item){
                        ?>
                        <div class="slide" data-thumb="<?php echo $item['image']; ?>">
                            <a href="<?php echo $item['link']; ?>">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                                <div class="flex-caption slider-caption-bg slider-caption-bg-light slider-caption-bottom-right">
                                    <?php echo $item['title']; ?>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>

</section>
