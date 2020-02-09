<?php

use yii\widgets\LinkPager;

$this->title = '在线留言';
?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title">在线留言</h4>
                    </div>

                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>内容</th>
                        <th width="10%">操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item) {
                        ?>
                        <tr>
                            <td>
                                <ul class="list-unstyled" >
                                    <li><?php echo $item['username']; ?></li>
                                    <li><?php echo $item['subject']; ?></li>
                                    <li><?php echo $item['content']; ?></li>
                                    <li><?php echo $item['reply']==""?"无":$item['reply']; ?></li>
                                    <li><?php echo $item['status'] == 1 ? "已启用" : "未启用"; ?></li>
                                </ul>
                            </td>
                            <td>
                                <a class="text-primary mr-1" href="index.php?r=pluginAdmin/message/reply&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-reply"></i>
                                </a>
                                <a class="text-danger mr-1" href="index.php?r=pluginAdmin/message/delete&id=<?php echo $item['id']; ?>">
                                    <i class="fa fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-lg-12 mt-3 ">
                        <?php
                        echo LinkPager::widget([
                            'pagination' => $pagination,
                            'options' => array('class' => 'pagination mb-0'),
                            'linkOptions' => array('class' => 'page-link'),
                            'linkContainerOptions' => array('class' => 'page-item'),
                            'disabledListItemSubTagOptions' => array('class' => 'page-link')
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
