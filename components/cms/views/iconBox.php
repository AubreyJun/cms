<?php
$properties = $fragment['properties'];
$iconBox = json_decode($properties, true);
if ($iconBox['iconType'] == 'four') {
    ?>
    <div class="clear"></div>
    <?php
    $index = 1;
    foreach ($iconBox['items'] as $item){
        ?>
        <div class="col_one_fourth <?php echo $index==4?"col_last":""; ?>">
            <div class="feature-box fbox-center fbox-plain">
                <div class="fbox-icon">
                    <a href="#"><i class="<?php echo $item['icon']; ?>"></i></a>
                </div>
                <h3><?php echo $item['title']; ?></h3>
                <p><?php echo $item['description']; ?></p>
            </div>
        </div>
        <?php
        $index ++;
    }
}
?>
