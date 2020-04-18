<?php
//显示格式3列

use yii\helpers\StringHelper;

//分类ID
$catalogId = '';
//显示数量
$size = 6;

$objects = \app\models\cms\frontend\Post::getRecent('article', $catalogId, $size);
?>
<div class="container clearfix">
    <?php
    $index_object = 1;
    foreach ($objects as $object) {
        if ($index_object % 3 == 0) {
            ?>
            <div class="col_one_third col_last">
                <div class="feature-box fbox-effect">
                    <div class="fbox-icon">
                        <h3>
                            <?php echo date('m-d', strtotime($object['object']['createtime'])); ?>
                        </h3>
                        <h6>
                            <?php echo date('Y', strtotime($object['object']['createtime'])); ?>
                        </h6>
                    </div>
                    <h3>
                        <a href="article-<?php echo $object['object']['id']; ?>.html">
                            <?php echo StringHelper::truncate($object['object']['title'], 10); ?>
                        </a>
                    </h3>
                    <p>
                        <?php echo StringHelper::truncate(strip_tags($object['object']['content']), 50) ?>
                    </p>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="col_one_third">
                <div class="feature-box fbox-effect">
                    <div class="fbox-icon">
                        <h3>
                            <?php echo date('m-d', strtotime($object['object']['createtime'])); ?>
                        </h3>
                        <h6>
                            <?php echo date('Y', strtotime($object['object']['createtime'])); ?>
                        </h6>
                    </div>
                    <h3>
                        <a href="article-<?php echo $object['object']['id']; ?>.html">
                            <?php echo StringHelper::truncate($object['object']['title'], 10); ?>
                        </a>
                    </h3>
                    <p>
                        <?php echo StringHelper::truncate(strip_tags($object['object']['content']), 50) ?>
                    </p>
                </div>
            </div>
            <?php
        }
        $index_object++;
    }
    ?>
</div>
