<div class="container clearfix bottommargin-lg topmargin-lg">
    <div class="masonry-thumbs grid-2" data-lightbox="gallery">
        <?php
        for($i=0;$i<4;$i++){
            $imageUrl = $this->context->getImg('800x800',15);
            ?>
            <a href="<?php echo $imageUrl; ?>" data-lightbox="gallery-item"><img class="image_fade" src="<?php echo $imageUrl; ?>" alt="<?php echo $imageUrl; ?>"></a>
            <?php
        }
        ?>
    </div>
</div>