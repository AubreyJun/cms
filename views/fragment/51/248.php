<?php
$catalogId = 133;
$objects = \app\models\cms\frontend\Post::getParentAll('image', $catalogId);
$catalogs = \app\models\cms\frontend\Catalog::getChildren($catalogId);
?>
<section class="section notopborder nomargin ">
    <div class="container clearfix mb-5">
        <div id="portfolio" class="portfolio grid-container portfolio-nomargin portfolio-full portfolio-masonry mixed-masonry grid-container clearfix">
            <?php
            foreach ($objects as $object) {
                $rand = rand(1,3);
                $imageurl = $this->context->getImg($object['prop']['image_url']);
                ?>
                <article class="portfolio-item pf-<?php echo $object['object']['catalogId']; ?> <?php echo $rand==3?"wide":""; ?>">
                    <div class="portfolio-image">
                        <a href="#">
                            <img src="<?php echo $imageurl; ?>" alt="<?php echo $object['object']['title']; ?>">
                        </a>
                        <div class="portfolio-overlay">
                            <a href="<?php echo $imageurl; ?>" class="center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
                        </div>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>
    </div>
</section>