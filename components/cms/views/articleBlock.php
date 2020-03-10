<?php

use yii\helpers\StringHelper;

$articles = $context->getRecentPost('article',$properties['catalogId'],intval($properties['size']));

if($properties['gridNumber'] == 3){
    $index_article = 1;
    foreach ($articles as $article){
        if( $index_article %3==0){
            ?>
            <div class="col_one_third col_last">
                <div class="feature-box fbox-effect">
                    <div class="fbox-icon">
                        <h3><?php echo date('m-d',strtotime($article['object']['createtime'])); ?></h3>
                        <h6><?php echo date('Y',strtotime($article['object']['createtime'])); ?></h6>
                    </div>
                    <h3><a href="article-<?php echo $article['object']['id']; ?>.html"><?php echo StringHelper::truncate($article['object']['title'],10); ?></a></h3>
                    <p><?php echo StringHelper::truncate(strip_tags($article['object']['content']),50) ?></p>
                </div>
            </div>
            <?php
        }else{
            ?>
            <div class="col_one_third">
                <div class="feature-box fbox-effect">
                    <div class="fbox-icon">
                        <h3><?php echo date('m-d',strtotime($article['object']['createtime'])); ?></h3>
                        <h6><?php echo date('Y',strtotime($article['object']['createtime'])); ?></h6>
                    </div>
                    <h3><a href="article-<?php echo $article['object']['id']; ?>.html"><?php echo StringHelper::truncate($article['object']['title'],10); ?></a></h3>
                    <p><?php echo StringHelper::truncate(strip_tags($article['object']['content']),50) ?></p>
                </div>
            </div>
            <?php
        }
        $index_article ++;
    }
}

?>
