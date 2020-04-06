<div class="container clearfix mt-5">
  <div class="row">
    <div class="col-lg-6">
      <div class="heading-block">
        <h3>联系我们
        </h3>
      </div>
      <p>某某公司液晶显示产品覆盖传媒、商业、安防、教育等多个领域。某某公司拥有一批从事智能显示设备、物联网设备研发的工程师及生产线，更好地保障了公司多媒体液晶显示设备的优良性能和高品质。为了给客户提供更好的产品和服务，某某公司不断拓展和完善营销渠道，已建成行业内较完善的营销渠道服务网络。
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
