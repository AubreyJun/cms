<section id="page-title">

    <div class="container clearfix">
        <h1><?php echo $properties['title']; ?></h1>
        <ol class="breadcrumb">
            <?php
            $size = sizeof($properties['items']);
            foreach ($properties['items'] as $item){
                if($size==1){
                    ?>
                    <li class="breadcrumb-item active"><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></li>
                    <?php
                }else{
                    ?>
                    <li class="breadcrumb-item"><a href="<?php echo $item['link']; ?>"><?php echo $item['title']; ?></a></li>
                    <?php
                }
                $size --;
            }
            ?>


        </ol>
    </div>

</section>
