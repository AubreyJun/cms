<?php
$arg1 = $_REQUEST['arg1'];
$object = \app\models\cms\frontend\Post::getItem($arg1);
?>
<div class="container clearfix">
    <div class="single-post nobottommargin">
        <div class="entry clearfix">
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
            <div class="entry-content notopmargin">
                <?php echo $object['object']['content']; ?>
            </div>
        </div>
        <!-- .entry end -->
    </div>
</div>
