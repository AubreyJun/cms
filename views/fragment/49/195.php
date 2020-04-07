<?php
$objects = \app\models\cms\frontend\Post::getParentAll('image', 116);
$catalogs = \app\models\cms\frontend\Catalog::getChildren(116);
?>
<div class="container clearfix mb-5">
    <!-- Portfolio Filter
  ============================================= -->
    <ul class="portfolio-filter clearfix" data-container="#portfolio">
        <li class="activeFilter">
            <a href="#" data-filter="*">所有
            </a>
        </li>
        <?php
        foreach ($catalogs as $catalog){
            ?>
            <li>
                <a href="#" data-filter=".pf-<?php echo $catalog['id']; ?>"><?php echo $catalog['catalogName']; ?>
                </a>
            </li>
            <?php
        }
        ?>


    </ul>
    <!-- #portfolio-filter end -->
    <div class="portfolio-shuffle" data-container="#portfolio">
        <i class="icon-random">
        </i>
    </div>
    <div class="clear">
    </div>
    <!-- Portfolio Items
  ============================================= -->
    <div id="portfolio" class="portfolio grid-container clearfix">
        <?php
        foreach ($objects as $object) {
            ?>
            <article class="portfolio-item pf-<?php echo $object['object']['catalogId']; ?>">
                <div class="portfolio-image">
                    <a href="portfolio-single.html">
                        <img src="<?php echo $object['prop']['image_url']; ?>" alt="<?php echo $object['object']['title']; ?>">
                    </a>
                    <div class="portfolio-overlay">
                        <a href="<?php echo $object['prop']['image_url']; ?>" class="center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
                    </div>
                </div>
                <div class="portfolio-desc text-center">
                    <h3><a href="portfolio-single.html"><?php echo $object['object']['title']; ?></a></h3>
                </div>
            </article>

            <?php
        }
        ?>
    </div>
    <!-- #portfolio end -->
</div>
