<?php

use yii\widgets\LinkPager;

$this->title = '在线留言回复';
?>
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h4 class="card-title">在线留言回复</h4>
                    </div>

                </div>


                <form action="index.php?r=pluginAdmin/message/savereply" method="post" >
                    <input type='hidden' name="id" value="<?php echo $message['id']; ?>"/>
                    <input type='hidden' id="_csrf" name="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>"/>
                    <div class="form-group  ">
                        <label class="control-label">名称</label>
                        <input type="text" class="form-control" value="<?php echo $message['username']; ?>"
                               readonly="readonly">
                    </div>

                    <div class="form-group  ">
                        <label class="control-label">主题</label>
                        <input type="text" class="form-control" value="<?php echo $message['subject']; ?>"
                               readonly="readonly">
                    </div>

                    <div class="form-group  ">
                        <label class="control-label">内容</label>
                        <textarea class="form-control" readonly="readonly"><?php echo $message['content']; ?></textarea>
                    </div>

                    <div class="form-group  ">
                        <label class="control-label">状态</label>
                        <div><label><input type="radio" name="status" value="0"  <?php echo $message['status']=='0'?"checked":""; ?>> 不启用</label>
                            <label><input type="radio" name="status" value="1"  <?php echo $message['status']=='1'?"checked":""; ?>> 启用</label></div>
                    </div>

                    <div class="form-group  ">
                        <label class="control-label">回复</label>
                        <textarea class="form-control" name="reply" ><?php echo $message['reply']; ?></textarea>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
