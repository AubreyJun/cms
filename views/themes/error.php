<?php

use yii\helpers\Html;

$this->title = "提示页面";

$exception = Yii::$app->errorHandler->exception;
?>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-bordered" style="margin-top: 30%;">
                <thead>
                    <tr>
                        <td colspan="2"><strong>提示信息</strong></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td WIDTH="40%">状态码</td><td><?php echo $exception->statusCode; ?></td>
                    </tr>
                    <tr>
                        <td>内容</td><td><?php echo $exception->getMessage(); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>