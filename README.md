## 蓝科 - 企业网站  
RKCMS是开源免费的企业网站内容展示系统，使用PHP开发，基于YII2进行构建。

## 开源协议
GPL

## 预览

<img src='http://backend.ranko.cn/uploads/file/cms.png' width="400px" title="预览"/>    
<br>
<img src='http://backend.ranko.cn/uploads/file/backend.png' width="400px" title="后台管理"/>      
<br>
<img src='http://backend.ranko.cn/uploads/file/pagewidgets.png' width="400px" title="页面排版"/>      
<br>

## 安装步骤
1. 复制install目录下的dev文件至config目录下
2. 修改dev目录下的db.php中的数据库配置
3. 数据库导入SQL脚本,对应的脚本install目录下  
4. 默认密码：ranko/admin
5. 后台地址：index.php?r=backend   

## 技术支持
官网：http://www.ranko.cn  
联系：朱君/18068252703  
如果你想使用RKCMS建立你的企业网站，如需帮助，请联系我。  
此外官网还有更多商业模版可供选择，期望您的来电^_^。  

## 免费模板
默认模板：http://cms.master.ranko.cn/

## 代码地址
码云：https://gitee.com/wuxi_ranko/cms

## rewrite设置

### Apache
    
    Allow from all
    RewriteEngine on
    
    RewriteRule index.html index.php?r=cms-frontend/default/index
    
    RewriteRule ^(.*)-(.*)-(.*).html$ index.php?r=cms-frontend/default/index&pagePath=$1&arg1=$2&arg2=$3
    RewriteRule ^(.*)-(.*).html$ index.php?r=cms-frontend/default/index&pagePath=$1&arg1=$2
    RewriteRule ^(.*).html$ index.php?r=cms-frontend/default/index&pagePath=$1
    
    
### Nginx

    rewrite index.html index.php?r=cms-frontend/default/index;
    
    rewrite ^/(.*)-(.*)-(.*).html$ index.php?r=cms-frontend/default/index&pagePath=$1&arg1=$2&arg2=$3;
    rewrite ^/(.*)-(.*).html$ index.php?r=cms-frontend/default/index&pagePath=$1&arg1=$2;
    rewrite ^/(.*).html$ index.php?r=cms-frontend/default/index&pagePath=$1;
    
## 帮助我
如果你在使用RKCMS建立自己的网站，条件允许的情况下请给我一点帮助，例如在网站底部添加。

    <a href="http://www.ranko.cn">Powered by RKCMS</a>    
    
## 赞助我

<img src="http://backend.ranko.cn/uploads/file/myalipay.jpg" width="200px">    


