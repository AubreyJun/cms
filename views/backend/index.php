<?php
$this->title = "企业网站后台管理";
?>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
            <div class="row w-100">
                <div class="col-lg-8 mx-auto">
                    <div class="row">
                        <div class="col-lg-6 bg-white">
                            <div class="auth-form-light text-left p-5">
                                <h2>企业网站后台管理</h2>
                                <form method="post" action="index.php?r=backend/login" class="pt-5">
                                    <input type="hidden" name="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                                    <?php
                                    if (isset($model->getErrors()['tips'])) {
                                        ?>
                                        <div class="alert alert-danger mb-3">
                                            <?php
                                            foreach ($model->getErrors()['tips'] as $error_fc) {
                                                echo $error_fc;
                                            }
                                            ?>
                                        </div>
                                        <?php

                                    }

                                    if (Yii::$app->params['debug']['enable']) {
                                        ?>
                                        <div class="form-group">
                                            <label class="mb-3">登入账户</label>
                                            <input type="text" class="form-control login-input"
                                                   value="<?php echo Yii::$app->params['debug']['name']; ?>"
                                                   readonly="readonly" autocomplete="false"
                                                   name="FormLogin[username]">
                                            <i class="mdi mdi-account"></i>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-3">登入密码</label>
                                            <input type="password" class="form-control login-input"
                                                   value="<?php echo Yii::$app->params['debug']['password']; ?>"
                                                   readonly="readonly" autocomplete="false"
                                                   name="FormLogin[password]">
                                            <i class="mdi mdi-eye"></i>
                                        </div>
                                        <?php
                                    } else {
                                        ?>
                                        <div class="form-group">
                                            <label class="mb-3">登入账户</label>
                                            <input type="text" class="form-control login-input" readonly="readonly"
                                                   autocomplete="false"
                                                   name="FormLogin[username]">
                                            <i class="mdi mdi-account"></i>
                                        </div>
                                        <div class="form-group">
                                            <label class="mb-3">登入密码</label>
                                            <input type="password" class="form-control login-input" readonly="readonly"
                                                   autocomplete="false"
                                                   name="FormLogin[password]">
                                            <i class="mdi mdi-eye"></i>
                                        </div>
                                        <?php
                                    }

                                    ?>

                                    <div class="mt-5">
                                        <button class="btn btn-block btn-primary btn-lg" type="submit">登 入</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6 login-half-bg d-flex flex-row">
                            <p class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright
                                &copy; <?php echo date('Y'); ?> All rights reserved.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<script>
    setTimeout(function () {
        $(".login-input").removeAttr("readonly")
    }, 1000)
</script>
