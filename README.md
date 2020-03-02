## 蓝科 - 企业网站  
RKCMS是开源免费的企业网站内容展示系统，使用PHP开发，基于YII2进行构建。

## 预览
![首页](http://backend.ranko.cn/uploads/file/cms.png)

## 安装步骤
1. 复制install目录下的dev文件至config目录下
2. 修改dev目录下的db.php中的数据库配置
3. 数据库导入SQL脚本,对应的脚本install目录下  
4. 默认密码：ranko/admin
5. 后台地址：index.php?r=backend   

## 技术支持
官网：http://www.ranko.cn  

## 免费模板
默认模板：http://cms.free.basic.ranko.cn/  
自由职业者：http://cms.free.freelancer.ranko.cn/  
个人简历：http://cms.free.resume.rako.cn/  
企业单页：http://cms.free.singlepage.ranko.cn/   
创造力：http://cms.free.freecreative.ranko.cn/ 


## rewrite设置

### Apache
    
    Allow from all
    RewriteEngine on
    
    RewriteRule index.html index.php?r=cms-frontend/default/index
    RewriteRule ^product-(.*).html$ index.php?r=cms-frontend/default/index&pageType=product&id=$1
    RewriteRule ^article-(.*).html$ index.php?r=cms-frontend/default/index&pageType=article&id=$1
    RewriteRule ^image-(.*).html$ index.php?r=cms-frontend/default/index&pageType=image&id=$1
    RewriteRule ^employee-(.*).html$ index.php?r=cms-frontend/default/index&pageType=employee&id=$1
    
    RewriteRule ^(.*)-(.*)-(.*).html$ index.php?r=cms-frontend/default/index&pageType=$1&pageId=$2&catalogId=$3
    RewriteRule ^(.*)-(.*).html$ index.php?r=cms-frontend/default/index&pageType=$1&pageId=$2
    RewriteRule ^(.*).html$ index.php?r=cms-frontend/default/index&pageType=$1
    
    
### Nginx

    rewrite /index.html /index.php?r=cms-frontend/default/index;
    rewrite ^/product-(.*).html$ /index.php?r=cms-frontend/default/index&pageType=product&id=$1;
    rewrite ^/article-(.*).html$ /index.php?r=cms-frontend/default/index&pageType=article&id=$1;
    rewrite ^/image-(.*).html$ /index.php?r=cms-frontend/default/index&pageType=image&id=$1;
    rewrite ^/employee-(.*).html$ /index.php?r=cms-frontend/default/index&pageType=employee&id=$1;
    rewrite ^/(.*)-(.*)-(.*).html$ /index.php?r=cms-frontend/default/index&pageType=$1&pageId=$2&catalogId=$3;
    rewrite ^/(.*)-(.*).html$ /index.php?r=cms-frontend/default/index&pageType=$1&pageId=$2;
    rewrite ^/(.*).html$ /index.php?r=cms-frontend/default/index&pageType=$1;
    


