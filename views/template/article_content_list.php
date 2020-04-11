<?php
$catalogId = $_REQUEST['arg1'];
$pageNumber = $_REQUEST['arg2'];
$pageSize = 5;
use yii\helpers\StringHelper;
use yii\widgets\LinkPager;

$objects = \app\models\cms\frontend\Post::getPagination('article',$catalogId,$pageSize);

?>
<div class="container clearfix">
    <?php
    if(sizeof($objects['post_list'])>0){
        foreach ($objects['post_list'] as $object){
            ?>
            <div class="feature-box fbox-effect">
                <div class="fbox-icon">
                    <h3>
                        <?php echo date('m-d', strtotime($object['createtime'])); ?>
                    </h3>
                    <h6>
                        <?php echo date('Y', strtotime($object['createtime'])); ?>
                    </h6>
                </div>
                <h3>
                    <a href="article-<?php echo $object['id']; ?>.html">
                        <?php echo StringHelper::truncate($object['title'], 10); ?>
                    </a>
                </h3>
                <p>
                    <?php echo StringHelper::truncate(strip_tags($object['content']), 60) ?>
                </p>
            </div>
            <?php
        }
    }
    ?>
    <div class="text-center mt-5">
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
