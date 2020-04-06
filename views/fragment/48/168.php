<div class="container clearfix">
  <div id="map-container" style="height: 450px;">
  </div>
  <script charset="utf-8" src="https://map.qq.com/api/js?v=2.exp&key=PFCBZ-56YK4-RJJUV-DELFC-NET43-HBFJA">
  </script>
  <script>
    //                https://lbs.qq.com/tool/getpoint/ 坐标获取
    var map = null;
    window.onload = function(){
      //初始化地图函数  自定义函数名init
      function init() {
        var center = new qq.maps.LatLng(31.677840,120.321250);
        //定义map变量 调用 qq.maps.Map() 构造函数   获取地图显示容器
        map = new qq.maps.Map(document.getElementById("map-container"), {
          center: center,      // 地图的中心地理坐标。
          zoom:12                                                 // 地图的中心地理坐标。
        }
                             );
        var label = new qq.maps.Label({
          position: center,
          map: map,
          content:'公司地址'
        }
                                     );
      }
      //调用初始化函数地图
      init();
    }
  </script>
</div>
