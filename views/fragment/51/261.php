<?php
$catalogId = $_REQUEST['arg1'];
$pageNumber = $_REQUEST['arg2'];
$pageSize = 5;

use yii\helpers\StringHelper;
use yii\widgets\LinkPager;

$objects = \app\models\cms\frontend\Post::getPagination('article', $catalogId, $pageSize);

?>
<div class="container bottommargin clearfix">
    <div id="posts">
        <?php
        if (sizeof($objects['post_list']) > 0) {
            foreach ($objects['post_list'] as $object) {
                ?>
                <div class="entry clearfix">
                    <div class="entry-c">
                        <div class="entry-title">
                            <h2>
                                <a href="article-<?php echo $object['id']; ?>.html"> <?php echo StringHelper::truncate($object['title'], 10); ?></a>
                            </h2>
                        </div>
                        <ul class="entry-meta clearfix">
                            <li>
                                <i class="icon-calendar3"></i><?php echo date('Y-m-d', strtotime($object['createtime'])); ?>
                            </li>
                        </ul>
                        <div class="entry-content">
                            <p>
                                <?php echo StringHelper::truncate(strip_tags($object['content']), 200) ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <div class="row mb-3">
        <div class="col-12">
            <?php
            echo LinkPager::widget([
                'pagination' => $objects['post_pagination'],
                'options' => array('class' => 'pagination mb-0'),
                'linkOptions' => array('class' => 'page-link'),
                'linkContainerOptions' => array('class' => 'page-item'),
                'disabledListItemSubTagOptions' => array('class' => 'page-link')
            ]);
            ?>
        </div>
    </div>
</div>
