<?php
$arg1 = $_REQUEST['arg1'];
$object = \app\models\cms\frontend\Post::getItem($arg1);
$title = $object['object']['title'];
$this->context->pagedata['article'] = $object;
$this->context->setMeta($title, "无锡，蓝科，无锡蓝科，蓝科创想",
    "无锡蓝科创想科技有限公司，主要从事软件研发的软件企业。创新，责任，为服务的企业创造价值，是我们的初衷；合作共赢，是我们的愿景！
");
?>
