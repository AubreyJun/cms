<div class="form-widget">

    <div class="form-result"></div>

    <form class="nobottommargin" action="index.php?r=plugin-frontend/feedback/save" method="post">
        <input type='hidden' class="sm-form-control" name="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>"/>
        <div class="form-process"></div>

        <div class="col_full">
            <label>姓名 <small>*</small></label>
            <input type="text" name="username" value="" class="required sm-form-control" />
        </div>

        <div class="clear"></div>

        <div class="col_full">
            <label >电话 <small>*</small></label>
            <input type="text" name="phone" value="" class="required sm-form-control" />
        </div>

        <div class="clear"></div>

        <div class="col_full">
            <label>留言 <small>*</small></label>
            <textarea class="required sm-form-control" name="message" rows="6" cols="30"></textarea>
        </div>

        <div class="col_full">
            <button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">留言</button>
        </div>


    </form>
</div>
