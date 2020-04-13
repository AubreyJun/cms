<?php
//分类目录ID
$catalogId = 0;
$objects = \app\models\cms\frontend\Post::getParentAll('image', $catalogId);
$catalogs = \app\models\cms\frontend\Catalog::getChildren($catalogId);
?>
<section class="section notopborder nomargin ">
    <div class="container clearfix mb-5">

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
        <div class="portfolio-shuffle" data-container="#portfolio">
            <i class="icon-random">
            </i>
        </div>
        <div class="clear">
        </div>
        <div id="portfolio" class="portfolio grid-container clearfix">
            <?php
            foreach ($objects as $object) {
                $imageurl = $this->context->getImg($object['prop']['image_url']);
                ?>
                <article class="portfolio-item pf-<?php echo $object['object']['catalogId']; ?>">
                    <div class="portfolio-image">
                        <a href="#">
                            <img src="<?php echo $imageurl; ?>" alt="<?php echo $object['object']['title']; ?>">
                        </a>
                        <div class="portfolio-overlay">
                            <a href="<?php echo $imageurl; ?>" class="center-icon" data-lightbox="image"><i class="icon-line-plus"></i></a>
                        </div>
                    </div>
                    <div class="portfolio-desc text-center">
                        <h3><a href="#"><?php echo $object['object']['title']; ?></a></h3>
                    </div>
                </article>
                <?php
            }
            ?>
        </div>
    </div>
</section>