<!--图片展示 3列-->
<?php
$objects  = \app\models\cms\frontend\Post::getRecent('image','113',6);
?>
<div class="container clearfix">
    <div id="portfolio" class="portfolio grid-container portfolio-3 clearfix">

        <?php
        foreach ($objects as $object) {
            ?>
            <article class="portfolio-item ">
                <div class="portfolio-image">
                    <a>
                        <img src="<?php echo $object['prop']['image_url']; ?>"
                             alt="<?php echo $object['object']['title']; ?>">
                    </a>
                    <div class="portfolio-overlay text-center">
                        <a href="<?php echo $object['prop']['image_url']; ?>" class="center-icon"
                           data-lightbox="image"><i class="icon-line-plus"></i></a>
                    </div>
                </div>
                <div class="portfolio-desc text-center">
                    <h3><?php echo $object['object']['title']; ?></h3>
                </div>
            </article>
            <?php
        }
        ?>
    </div>
</div>