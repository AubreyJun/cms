<div class="clearfix"></div>
<?php
$properties = $fragment['properties'];
$propObject = json_decode($properties, true);

if ($propObject['container'] == 1){
?>
<div class="container clearfix">
    <?php
    }

    if ($propObject['imageListType'] == 'four') {
        $index = 1;
        foreach ($propObject['items'] as $item) {
            ?>
            <div class="col_one_fourth nobottommargin <?php echo $index == 4 ? "col_last" : ""; ?> ">
                <div class="feature-box media-box">
                    <div class="fbox-media">
                        <img src="<?php echo $item['image'] ?>" alt="<?php echo $item['title'] ?>">
                    </div>
                    <div class="fbox-desc text-center">
                        <h3><?php echo $item['title'] ?></h3>
                        <p><?php echo $item['description'] ?></p>
                    </div>
                </div>
            </div>
            <?php
            $index++;
        }
    }

    if ($propObject['container'] == 1){
    ?>
</div>
<?php
}

?>
