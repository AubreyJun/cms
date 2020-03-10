<?php
$images = $context->getRecentPost('image',$catalogId['pvalue'],intval($size['pvalue']));
?>
<div class="portfolio grid-container portfolio-<?php echo $gridNumber['pvalue']; ?> clearfix">

    <?php
    foreach ($images as $image) {
        ?>
        <article class="portfolio-item ">
            <div class="portfolio-image">
                <a>
                    <img src="<?php echo $image['prop']['imageUrl']; ?>"
                         alt="<?php echo $image['object']['title']; ?>">
                </a>
                <div class="portfolio-overlay text-center">
                    <a href="<?php echo $image['prop']['imageUrl']; ?>" class="center-icon"
                       data-lightbox="image"><i class="icon-line-plus"></i></a>
                </div>
            </div>
            <div class="portfolio-desc text-center">
                <h3><?php echo $image['object']['title']; ?></h3>
            </div>
        </article>
        <?php
    }
    ?>


</div>
