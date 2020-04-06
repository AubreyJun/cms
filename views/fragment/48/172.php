<?php
$object = $this->context->pagedata['article'];
?>
<div class="container clearfix">
  <div class="single-post nobottommargin">
    <!-- Single Post
============================================= -->
    <div class="entry clearfix">
      <!-- Entry Title
============================================= -->
      <div class="entry-title">
        <h2>
          <?php echo $object['object']['title']; ?>
        </h2>
      </div>
      <!-- .entry-title end -->
      <ul class="entry-meta clearfix">
        <li>
          <i class="icon-calendar3">
          </i> 
          <?php echo $object['object']['createtime']; ?>
        </li>
      </ul>
      <!-- Entry Content
============================================= -->
      <div class="entry-content notopmargin">
        <?php echo $object['object']['content']; ?>
      </div>
    </div>
    <!-- .entry end -->
  </div>
</div>
