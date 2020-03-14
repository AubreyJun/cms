<?php
$properties = $fragment['properties'];
$propObject = json_decode($properties, true);
?>
<div class="clearfix"></div>
<div class="section parallax bottommargin-lg skrollable skrollable-between dark "
     style="background-image: url(&quot;<?php echo $propObject['bgImage']; ?>&quot;); padding: 100px 0px;  background-position: 0px -35.533px;"
     data-bottom-top="background-position:0px 325px;" data-top-bottom="background-position:0px -325px;">
    <div class="heading-block center nobottomborder nobottommargin">
        <h2><?php echo $propObject['title']; ?></h2>
    </div>
</div>

