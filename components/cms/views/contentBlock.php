<?php
$properties = $fragment['properties'];
$propObject = json_decode($properties,true);
if($propObject['style'] == 'left'){
    ?>
    <div class=" clearfix">


        <div class="clear"></div>
        <div class="line"></div>

        <div class="col_three_fifth">

            <div class="heading-block">
                <h3><?php echo $propObject['title']; ?></h3>
            </div>

            <?php echo $propObject['description'];  ?>


        </div>

        <div class="col_two_fifth  col_last" style="max-height: 400px;overflow: hidden;">
            <img src=" <?php echo $propObject['image'];  ?>">
        </div>

    </div>
    <?php
}
?>

