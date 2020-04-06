<?php

use yii\widgets\LinkPager;

$this->title = '联系表单';
?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title">联系表单</h4>
                    </div>

                </div>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>邮箱</th>
                        <th>电话</th>
                        <th>主题</th>
                        <th width="50%">内容</th>
                        <th>创建时间</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($list as $item){
                        ?>
                        <tr>
                            <td><?php echo $item['username']; ?></td>
                            <td><?php echo $item['email']; ?></td>
                            <td><?php echo $item['phone']; ?></td>
                            <td><?php echo $item['subject']; ?></td>
                            <td><?php echo $item['message']; ?></td>
                            <td><?php echo $item['createtime']; ?></td>
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
                            'options'=>array('class' => 'pagination mb-0'),
                            'linkOptions'=> array('class'=>'page-link'),
                            'linkContainerOptions'=>array('class'=>'page-item'),
                            'disabledListItemSubTagOptions'=>array('class'=>'page-link')
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
