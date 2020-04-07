<div class="container clearfix mt-5">
  <div class="row">
    <div class="col-lg-6">
      <div class="heading-block">
        <h3>联系我们
        </h3>
      </div>
      <p>XX广告有限公司成立于2004年6月。公司创始团队具有20年墙体广告经历和经验。公司具有设计、制作、发布、代理国内外各类广告的资质。公司有各类专业技术人员120多名，其中高级美工28余名 ; 自有车辆33辆，其中奔驰轿车一辆，用于接送客户，奔驰越野车一辆，用于和客户验收广告。公司在西部九省区拥有广告位置资源40万块。
      </p>
      <p>
        PHONE  :  021-000-0000
        <br>
        E-MAIL  :  xxx@.co.m
        <br>
        公司地址  : XXX省XXX市XXX县XXX路XXX号
        <br>
      </p>
    </div>
    <div class="col-lg-6">
      <div class="form-widget">
        <div class="form-result">
        </div>
        <form class="nobottommargin" action="index.php?r=plugin-frontend/feedback/save" method="post">
          <input type='hidden' class="sm-form-control" name="_csrf" value="<?php echo Yii::$app->request->csrfToken; ?>"/>
          <div class="form-process">
          </div>
          <div class="col_full">
            <label>姓名 
              <small>*
              </small>
            </label>
            <input type="text" name="username" value="" class="required sm-form-control" />
          </div>
          <div class="clear">
          </div>
          <div class="col_full">
            <label >电话 
              <small>*
              </small>
            </label>
            <input type="text" name="phone" value="" class="required sm-form-control" />
          </div>
          <div class="clear">
          </div>
          <div class="col_full">
            <label>留言 
              <small>*
              </small>
            </label>
            <textarea class="required sm-form-control" name="message" rows="6" cols="30">
            </textarea>
          </div>
          <div class="col_full">
            <button class="button button-3d nomargin" type="submit" id="template-contactform-submit" name="template-contactform-submit" value="submit">留言
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
