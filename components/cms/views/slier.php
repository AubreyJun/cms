<?php
if($slider['sliderStyle']=='common'){
    ?>
    <section id="slider" class="slider-element boxed-slider">

        <div class="container clearfix">

            <div class="fslider" data-easing="easeInQuad">
                <div class="flexslider">
                    <div class="slider-wrap">
                        <?php
                        foreach ($slider['items'] as $item){
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
    <?php
}else if($slider['sliderStyle']=='widescreen'){
    ?>

    <section id="slider" class="slider-element slider-parallax swiper_wrapper full-screen clearfix" data-loop="true">

        <div class="slider-parallax-inner">

            <div class="swiper-container swiper-parent">
                <div class="swiper-wrapper">
                    <?php
                    foreach ($slider['items'] as $item){
                        ?>
                        <div class="swiper-slide dark" style="background-image: url('<?php echo $item['image']; ?>');">
                            <div class="container clearfix">
                                <div class="slider-caption  slider-caption-center">
                                    <h2 data-animate="fadeInUp"><?php echo $item['title']; ?></h2>
                                    <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200"><?php echo $item['description']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>

            </div>

    </section>

    <?php
}

?>


