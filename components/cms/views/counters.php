<?php
$properties = $fragment['properties'];
$counters = json_decode($properties, true);
?>
<div class="clear"></div>
<?php
if($counters['iconType']=='three'){
    $index = 1;
    foreach ($counters['items'] as $item){
        ?>
        <div class="col_one_third center <?php echo $index==3?"col_last":""; ?>" data-animate="bounceIn">
            <i class="i-plain i-xlarge divcenter nobottommargin <?php echo $item['icon']; ?>"></i>
            <div class="counter counter-large" style="color:<?php echo $item['color']; ?>;"><span data-to="<?php echo $item['number']; ?>"></span></div>
            <h5><?php echo $item['title']; ?></h5>
        </div>
        <?php
        $index ++;
    }

}
?>