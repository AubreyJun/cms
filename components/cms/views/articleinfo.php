<?php

$id = $_REQUEST['id'];
$article = $context->getPostInfo($id);

$context->setMeta($article['obj']['title'], "无锡，蓝科，无锡蓝科，蓝科创想",
    "无锡蓝科创想科技有限公司，主要从事软件研发的软件企业。创新，责任，为服务的企业创造价值，是我们的初衷；合作共赢，是我们的愿景！
");


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
