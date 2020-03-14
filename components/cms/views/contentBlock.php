<?php
$properties = $fragment['properties'];
$propObject = json_decode($properties, true);

if ($propObject['container'] == 1){
?>
<div class="container clearfix">
    <?php
    }

    if ($propObject['style'] == 'left') {
        ?>
        <div class=" clearfix">

            <div class="col_three_fifth">

                <div class="heading-block">
                    <h3><?php echo $propObject['title']; ?></h3>
                </div>

                <?php echo $propObject['description']; ?>


            </div>

            <div class="col_two_fifth  col_last" style="max-height: 400px;overflow: hidden;">
                <img src=" <?php echo $propObject['image']; ?>">
            </div>

        </div>
        <?php
    } else if ($propObject['style'] == 'right') {
        ?>
        <div class=" clearfix">

            <div class="col_three_fifth col_last">

                <div class="heading-block">
                    <h3><?php echo $propObject['title']; ?></h3>
                </div>

                <?php echo $propObject['description']; ?>


            </div>

            <div class="col_two_fifth  " style="max-height: 400px;overflow: hidden;">
                <img src=" <?php echo $propObject['image']; ?>">
            </div>

        </div>
        <?php
    }

    if ($propObject['container'] == 1){
    ?>
</div>
<?php
}

?>

