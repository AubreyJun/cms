<?php
$properties = $fragment['properties'];
$headContent = json_decode($properties,true);
?>
<div class="heading-block">
    <h3><?php echo $headContent['title']; ?></h3>
</div>
<?php echo $headContent['content']; ?>
