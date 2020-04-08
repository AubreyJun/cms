<!--图片展示 3列-->
<?php
$objects  = \app\models\cms\frontend\Post::getRecent('image','122',9);
?>
<div class="container clearfix">
    <div id="portfolio" class="portfolio grid-container portfolio-3 clearfix">

        <?php
        foreach ($objects as $object) {
            $image_url = $object['prop']['image_url'];
            if($image_url=='800x800'){
                $image_url = $this->context->getImg('800x800',15);
            }
            ?>
            <article class="portfolio-item ">
                <div class="portfolio-image">
                    <a>
                        <img src="<?php echo $image_url; ?>"
                             alt="<?php echo $object['object']['title']; ?>">
                    </a>
                    <div class="portfolio-overlay text-center">
                        <a href="<?php echo $image_url; ?>" class="center-icon"
                           data-lightbox="image"><i class="icon-line-plus"></i></a>
                    </div>
                </div>
            </article>
            <?php
        }
        ?>
    </div>
</div>