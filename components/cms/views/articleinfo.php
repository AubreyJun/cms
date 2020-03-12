<?php

$id = $_REQUEST['id'];
$article = $context->getPostInfo($id);

$context->setMeta($article['obj']['title'], $article['obj']['keywords'],$article['obj']['summary']);


?>
<div class="container clearfix">
    <div class="single-post nobottommargin">

        <!-- Single Post
        ============================================= -->
        <div class="entry clearfix">

            <!-- Entry Title
            ============================================= -->
            <div class="entry-title">
                <h2><?php echo $article['obj']['title']; ?></h2>
            </div><!-- .entry-title end -->

            <ul class="entry-meta clearfix">
                <li><i class="icon-calendar3"></i> <?php echo $article['obj']['createtime']; ?></li>
            </ul>

            <!-- Entry Content
            ============================================= -->
            <div class="entry-content notopmargin">

                <?php echo $article['obj']['content']; ?>

            </div>
        </div><!-- .entry end -->

    </div>
</div>
