SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for cms_admin
-- ----------------------------
DROP TABLE IF EXISTS `cms_admin`;
CREATE TABLE `cms_admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `adminname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `adminpassword` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cms_admin
-- ----------------------------
INSERT INTO `cms_admin` VALUES (2, 'ranko', '21232f297a57a5a743894a0e4a801fc3', '2020-01-09 13:15:42', '2020-03-12 15:45:19');

-- ----------------------------
-- Table structure for cms_catalog
-- ----------------------------
DROP TABLE IF EXISTS `cms_catalog`;
CREATE TABLE `cms_catalog`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parentId` int(11) NOT NULL DEFAULT 0,
  `sequenceNumber` int(11) NULL DEFAULT 0,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted` tinyint(255) NOT NULL DEFAULT 0,
  `catalogPath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `themeId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 113 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for cms_config
-- ----------------------------
DROP TABLE IF EXISTS `cms_config`;
CREATE TABLE `cms_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cfgkey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cfgvalue` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` datetime(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `configtype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'basic',
  `themeId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `cfgkey`(`cfgkey`, `configtype`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 42 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_config
-- ----------------------------
INSERT INTO `cms_config` VALUES (38, 'themeColor', '0000FF', '2020-02-09 14:07:20', '2020-02-09 14:11:20', '网站主色调', 'basic', 40);

-- ----------------------------
-- Table structure for cms_plugin
-- ----------------------------
DROP TABLE IF EXISTS `cms_plugin`;
CREATE TABLE `cms_plugin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pluginName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pluginId` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'disabled',
  `menu` tinyint(255) NOT NULL DEFAULT 0,
  `themeId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_plugin
-- ----------------------------
INSERT INTO `cms_plugin` VALUES (8, '联系表单', 'feedback', '2020-03-28 13:28:47', '2020-03-28 13:28:47', '用户的在线联系表单', 'active', 1, 44);
INSERT INTO `cms_plugin` VALUES (10, '在线留言', 'message', '2020-03-28 13:29:38', '2020-03-28 13:29:38', '用户留言信息并反馈', 'active', 1, 44);

-- ----------------------------
-- Table structure for cms_post
-- ----------------------------
DROP TABLE IF EXISTS `cms_post`;
CREATE TABLE `cms_post`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `summary` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NULL DEFAULT NULL,
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `postType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'article',
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `catalogId` int(11) NOT NULL DEFAULT 0,
  `themeid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 109 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cms_post_prop
-- ----------------------------
DROP TABLE IF EXISTS `cms_post_prop`;
CREATE TABLE `cms_post_prop`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postId` int(11) NULL DEFAULT NULL,
  `ppKey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `ppValue` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 126 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cms_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `cms_post_tag`;
CREATE TABLE `cms_post_tag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `postId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 150 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;


-- ----------------------------
-- Table structure for cms_select
-- ----------------------------
DROP TABLE IF EXISTS `cms_select`;
CREATE TABLE `cms_select`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selectName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `themeId` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `STYPE_THEME`(`selectName`, `themeId`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_select
-- ----------------------------
INSERT INTO `cms_select` VALUES (19, 'articleProperties', 0);
INSERT INTO `cms_select` VALUES (11, 'articleStatus', 0);
INSERT INTO `cms_select` VALUES (10, 'configType', 0);
INSERT INTO `cms_select` VALUES (12, 'contentType', 0);
INSERT INTO `cms_select` VALUES (14, 'downloadProperties', 0);
INSERT INTO `cms_select` VALUES (30, 'fragmentTemplate', 0);
INSERT INTO `cms_select` VALUES (23, 'fragmentType', 0);
INSERT INTO `cms_select` VALUES (13, 'imageProperties', 0);
INSERT INTO `cms_select` VALUES (8, 'pageType', 0);
INSERT INTO `cms_select` VALUES (16, 'productProperties', 0);
INSERT INTO `cms_select` VALUES (18, 'templateType', 0);

-- ----------------------------
-- Table structure for cms_select_options
-- ----------------------------
DROP TABLE IF EXISTS `cms_select_options`;
CREATE TABLE `cms_select_options`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selectId` int(11) NULL DEFAULT NULL,
  `optionDesc` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `optionValue` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sequencenumber` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 229 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_select_options
-- ----------------------------
INSERT INTO `cms_select_options` VALUES (35, 8, '首页', 'home', 0);
INSERT INTO `cms_select_options` VALUES (36, 8, '文章列表', 'articleList', 1);
INSERT INTO `cms_select_options` VALUES (37, 8, '文章详情', 'article', 2);
INSERT INTO `cms_select_options` VALUES (38, 8, '图片列表', 'imageList', 3);
INSERT INTO `cms_select_options` VALUES (39, 8, '图片详情', 'image', 4);
INSERT INTO `cms_select_options` VALUES (40, 8, '产品列表', 'productList', 5);
INSERT INTO `cms_select_options` VALUES (41, 8, '产品详情', 'product', 6);
INSERT INTO `cms_select_options` VALUES (42, 8, '下载列表', 'downloadList', 7);
INSERT INTO `cms_select_options` VALUES (43, 8, '下载详情', 'download', 8);
INSERT INTO `cms_select_options` VALUES (44, 8, '招聘列表', 'employeeList', 9);
INSERT INTO `cms_select_options` VALUES (45, 8, '招聘详情', 'employee', 10);
INSERT INTO `cms_select_options` VALUES (46, 9, '导航栏', 'navbar', 0);
INSERT INTO `cms_select_options` VALUES (47, 9, '底部', 'footer', 10);
INSERT INTO `cms_select_options` VALUES (48, 10, '基本参数', 'basic', 0);
INSERT INTO `cms_select_options` VALUES (49, 10, '其他', 'other', 1);
INSERT INTO `cms_select_options` VALUES (50, 11, '上线', 'online', 1);
INSERT INTO `cms_select_options` VALUES (51, 11, '下线', 'offline', 0);
INSERT INTO `cms_select_options` VALUES (52, 12, '文章', 'article', 0);
INSERT INTO `cms_select_options` VALUES (53, 12, '图片', 'image', 1);
INSERT INTO `cms_select_options` VALUES (54, 12, '下载', 'download', 2);
INSERT INTO `cms_select_options` VALUES (55, 12, '产品', 'product', 3);
INSERT INTO `cms_select_options` VALUES (56, 12, '招聘', 'employee', 4);
INSERT INTO `cms_select_options` VALUES (58, 13, '图片地址', 'imageUrl', 0);
INSERT INTO `cms_select_options` VALUES (59, 14, '下载地址', 'downloadUrl', 0);
INSERT INTO `cms_select_options` VALUES (60, 8, '单页', 'page', 11);
INSERT INTO `cms_select_options` VALUES (71, 18, '头部HTML', 'headHtml', 0);
INSERT INTO `cms_select_options` VALUES (72, 18, '底部HTML', 'footHtml', 100);
INSERT INTO `cms_select_options` VALUES (73, 18, '导航菜单', 'navgation', 0);
INSERT INTO `cms_select_options` VALUES (74, 18, '内容', 'content', 0);
INSERT INTO `cms_select_options` VALUES (75, 8, '公司简介', 'companyinfo', 10);
INSERT INTO `cms_select_options` VALUES (76, 8, '在线留言', 'message', 10);
INSERT INTO `cms_select_options` VALUES (77, 8, '在线反馈', 'feedback', 10);
INSERT INTO `cms_select_options` VALUES (79, 8, '登入页面', 'login', 10);
INSERT INTO `cms_select_options` VALUES (80, 8, '注册页面', 'register', 10);
INSERT INTO `cms_select_options` VALUES (81, 16, '产品主图', 'product_image_main', 0);
INSERT INTO `cms_select_options` VALUES (84, 8, '网站地图', 'sitemap', 10);
INSERT INTO `cms_select_options` VALUES (116, 20, '首页', 'home', 0);
INSERT INTO `cms_select_options` VALUES (117, 20, '文章列表', 'articleList', 1);
INSERT INTO `cms_select_options` VALUES (118, 20, '文章详情', 'article', 2);
INSERT INTO `cms_select_options` VALUES (119, 20, '图片列表', 'imageList', 3);
INSERT INTO `cms_select_options` VALUES (120, 20, '图片详情', 'image', 4);
INSERT INTO `cms_select_options` VALUES (121, 20, '产品列表', 'productList', 5);
INSERT INTO `cms_select_options` VALUES (122, 20, '产品详情', 'product', 6);
INSERT INTO `cms_select_options` VALUES (123, 20, '下载列表', 'downloadList', 7);
INSERT INTO `cms_select_options` VALUES (124, 20, '下载详情', 'download', 8);
INSERT INTO `cms_select_options` VALUES (125, 20, '招聘列表', 'employeeList', 9);
INSERT INTO `cms_select_options` VALUES (126, 20, '招聘详情', 'employee', 10);
INSERT INTO `cms_select_options` VALUES (127, 20, '单页', 'page', 11);
INSERT INTO `cms_select_options` VALUES (128, 20, '公司简介', 'companyinfo', 10);
INSERT INTO `cms_select_options` VALUES (129, 20, '在线留言', 'message', 10);
INSERT INTO `cms_select_options` VALUES (130, 20, '在线反馈', 'feedback', 10);
INSERT INTO `cms_select_options` VALUES (132, 20, '登入页面', 'login', 10);
INSERT INTO `cms_select_options` VALUES (133, 20, '注册页面', 'register', 10);
INSERT INTO `cms_select_options` VALUES (134, 20, '网站地图', 'sitemap', 10);
INSERT INTO `cms_select_options` VALUES (147, 21, '图片地址', 'imageUrl', 0);
INSERT INTO `cms_select_options` VALUES (159, 25, '首页', 'home', 0);
INSERT INTO `cms_select_options` VALUES (160, 25, '文章列表', 'articleList', 1);
INSERT INTO `cms_select_options` VALUES (161, 25, '文章详情', 'article', 2);
INSERT INTO `cms_select_options` VALUES (162, 25, '图片列表', 'imageList', 3);
INSERT INTO `cms_select_options` VALUES (163, 25, '图片详情', 'image', 4);
INSERT INTO `cms_select_options` VALUES (164, 25, '产品列表', 'productList', 5);
INSERT INTO `cms_select_options` VALUES (165, 25, '产品详情', 'product', 6);
INSERT INTO `cms_select_options` VALUES (166, 25, '下载列表', 'downloadList', 7);
INSERT INTO `cms_select_options` VALUES (167, 25, '下载详情', 'download', 8);
INSERT INTO `cms_select_options` VALUES (168, 25, '招聘列表', 'employeeList', 9);
INSERT INTO `cms_select_options` VALUES (169, 25, '招聘详情', 'employee', 10);
INSERT INTO `cms_select_options` VALUES (170, 25, '单页', 'page', 11);
INSERT INTO `cms_select_options` VALUES (171, 25, '公司简介', 'companyinfo', 10);
INSERT INTO `cms_select_options` VALUES (172, 25, '在线留言', 'message', 10);
INSERT INTO `cms_select_options` VALUES (173, 25, '在线反馈', 'feedback', 10);
INSERT INTO `cms_select_options` VALUES (175, 25, '登入页面', 'login', 10);
INSERT INTO `cms_select_options` VALUES (176, 25, '注册页面', 'register', 10);
INSERT INTO `cms_select_options` VALUES (177, 25, '网站地图', 'sitemap', 10);
INSERT INTO `cms_select_options` VALUES (202, 23, '布局', 'layout', 0);
INSERT INTO `cms_select_options` VALUES (203, 23, '组件', 'widget', 0);

-- ----------------------------
-- Table structure for cms_theme
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme`;
CREATE TABLE `cms_theme`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL,
  `updatetime` datetime(0) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `isEdit` tinyint(255) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 46 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme
-- ----------------------------
INSERT INTO `cms_theme` VALUES (44, 'Hello World !', '2020-03-09 09:37:05', '2020-03-26 19:14:14', 1, 0);

-- ----------------------------
-- Table structure for cms_theme_fragment
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme_fragment`;
CREATE TABLE `cms_theme_fragment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeId` int(11) NULL DEFAULT NULL,
  `fragmentName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NULL DEFAULT NULL,
  `updatetime` datetime(0) NULL DEFAULT NULL,
  `body` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 124 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_fragment
-- ----------------------------
INSERT INTO `cms_theme_fragment` VALUES (114, 44, '共用_底部引入', '2020-03-26 19:28:34', '2020-03-28 13:17:39', '<!-- Bootstrap core JavaScript -->\r\n<script src=\"themes/basic/vendor/jquery/jquery.min.js\"></script>\r\n<script src=\"themes/basic/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n\r\n<!-- Plugin JavaScript -->\r\n<script src=\"themes/basic/vendor/jquery-easing/jquery.easing.min.js\"></script>\r\n<script src=\"themes/basic/vendor/magnific-popup/jquery.magnific-popup.min.js\"></script>\r\n\r\n<!-- Custom scripts for this template -->\r\n<script src=\"themes/basic/js/creative.min.js\"></script>');
INSERT INTO `cms_theme_fragment` VALUES (115, 44, '共用_版权所有', '2020-03-26 19:29:34', '2020-03-26 19:29:34', '<!-- Footer -->\r\n<footer class=\"bg-light py-5\">\r\n    <div class=\"container\">\r\n        <div class=\"small text-center text-muted\">版权所有 &copy; <?php echo date(\'Y\'); ?> - 无锡市蓝科创想科技有限公司</div>\r\n    </div>\r\n</footer>');
INSERT INTO `cms_theme_fragment` VALUES (116, 44, '共用_HEADER', '2020-03-26 19:30:45', '2020-03-26 19:30:45', '<meta charset=\"utf-8\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\r\n<meta name=\"keywords\" content=\"<?php echo $this->context->data[\'meta_keywords\']; ?>\">\r\n<meta name=\"description\" content=\"<?php echo $this->context->data[\'meta_description\']; ?>\">\r\n\r\n<title><?php echo $this->context->data[\'meta_title\']; ?> - Powered by ranko.cn </title>\r\n\r\n<!-- Font Awesome Icons -->\r\n<link href=\"themes/basic/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">\r\n\r\n<!-- Plugin CSS -->\r\n<link href=\"themes/basic/vendor/magnific-popup/magnific-popup.css\" rel=\"stylesheet\">\r\n\r\n<!-- Theme CSS - Includes Bootstrap -->\r\n<link href=\"themes/basic/css/creative.css\" rel=\"stylesheet\">');
INSERT INTO `cms_theme_fragment` VALUES (117, 44, '共用_导航片段', '2020-03-26 19:50:54', '2020-03-26 19:50:54', '<!-- Navigation -->\r\n<nav class=\"navbar navbar-expand-lg navbar-light fixed-top py-3\" id=\"mainNav\">\r\n    <div class=\"container\">\r\n        <a class=\"navbar-brand js-scroll-trigger\" href=\"#page-top\">RANKO.CN</a>\r\n        <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\"\r\n                data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\"\r\n                aria-label=\"Toggle navigation\">\r\n            <span class=\"navbar-toggler-icon\"></span>\r\n        </button>\r\n        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\r\n            <ul class=\"navbar-nav ml-auto my-2 my-lg-0\">\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#about\">关于</a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#services\">服务</a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#portfolio\">案例</a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#contact\">联系</a>\r\n                </li>\r\n            </ul>\r\n        </div>\r\n    </div>\r\n</nav>');
INSERT INTO `cms_theme_fragment` VALUES (118, 44, '首页_RKCMS介绍', '2020-03-26 19:52:08', '2020-03-26 19:52:08', '<!-- Masthead -->\r\n<header class=\"masthead\">\r\n    <div class=\"container h-100\">\r\n        <div class=\"row h-100 align-items-center justify-content-center text-center\">\r\n            <div class=\"col-lg-10 align-self-end\">\r\n                <h1 class=\"text-uppercase text-white font-weight-bold\">RKCMS</h1>\r\n                <hr class=\"divider my-4\">\r\n            </div>\r\n            <div class=\"col-lg-8 align-self-baseline\">\r\n                <p class=\"text-white-75 font-weight-light mb-5\">开源、免费的企业网站系统!在GPL开源协议前提下，个人或者企业组织可以免费使用!</p>\r\n                <a class=\"btn btn-primary btn-xl js-scroll-trigger\" href=\"#about\">了解更多</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</header>\r\n');
INSERT INTO `cms_theme_fragment` VALUES (119, 44, '首页_提供你想要的服务', '2020-03-28 12:55:30', '2020-03-28 12:55:30', '<!-- About Section -->\r\n<section class=\"page-section bg-primary\" id=\"about\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <div class=\"col-lg-8 text-center\">\r\n                <h2 class=\"text-white mt-0\">提供你想要的服务</h2>\r\n                <hr class=\"divider light my-4\">\r\n                <p class=\"text-white-50 mb-4\">RKCMS可以用于快速创建你的网站！下载免费源码，获取你所需要的主题，你的目标很快就能达成！</p>\r\n                <a class=\"btn btn-light btn-xl js-scroll-trigger\" href=\"#services\">立即开始</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (120, 44, '首页_我们的服务', '2020-03-28 12:58:22', '2020-03-28 12:58:22', '<!-- Services Section -->\r\n<section class=\"page-section\" id=\"services\">\r\n    <div class=\"container\">\r\n        <h2 class=\"text-center mt-0\">我们的服务</h2>\r\n        <hr class=\"divider my-4\">\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-gem text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">优质的主题</h3>\r\n                    <p class=\"text-muted mb-0\">应用市场提供多种行业所需的优质主题</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-laptop-code text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">永久更新</h3>\r\n                    <p class=\"text-muted mb-0\">开源代码库始终可开发进行中的代码保持一致</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-globe text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">快速改版</h3>\r\n                    <p class=\"text-muted mb-0\">可以通过后台主题模板编辑快速修改页面内容</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-heart text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">按需定制</h3>\r\n                    <p class=\"text-muted mb-0\">如果你有特殊需求，可以根据你的需求进行定制</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (121, 44, '首页_案例', '2020-03-28 12:58:44', '2020-03-28 13:07:01', '<!-- Portfolio Section -->\r\n<section id=\"portfolio\">\r\n    <div class=\"container-fluid p-0\">\r\n        <div class=\"row no-gutters\">\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/1.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/1.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/2.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/2.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/3.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/3.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/4.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/4.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/5.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/5.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/6.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/6.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption p-3\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n');
INSERT INTO `cms_theme_fragment` VALUES (122, 44, '首页_免费获取', '2020-03-28 12:59:08', '2020-03-28 12:59:08', '<!-- Call to Action Section -->\r\n<section class=\"page-section bg-dark text-white\">\r\n    <div class=\"container text-center\">\r\n        <h2 class=\"mb-4\">免费获取</h2>\r\n        <a class=\"btn btn-light btn-xl\" href=\"http://www.ranko.cn/opensource-2.html\">立即下载</a>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (123, 44, '首页_联系我们', '2020-03-28 12:59:28', '2020-03-28 12:59:28', '<!-- Contact Section -->\r\n<section class=\"page-section\" id=\"contact\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <div class=\"col-lg-8 text-center\">\r\n                <h2 class=\"mt-0\">联系我们</h2>\r\n                <hr class=\"divider my-4\">\r\n                <p class=\"text-muted mb-5\">你是否准备创建自己的网站？想了解更多关于RKCMS的信息，你可以通过电话、邮箱联系我们，我们\r\n                    将尽快给予回复！</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-4 ml-auto text-center mb-5 mb-lg-0\">\r\n                <i class=\"fas fa-phone fa-3x mb-3 text-muted\"></i>\r\n                <div>+86 18068252703</div>\r\n            </div>\r\n            <div class=\"col-lg-4 mr-auto text-center\">\r\n                <i class=\"fas fa-envelope fa-3x mb-3 text-muted\"></i>\r\n                <a class=\"d-block\" href=\"mailto:458820281@qq.com\">458820281@qq.com</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (124, 44, '首页_META', '2020-03-28 13:14:16', '2020-03-28 13:14:16', '<?php\r\n$this->context->setMeta(\"无锡蓝科创想科技有限公司\", \"无锡，蓝科，无锡蓝科，蓝科创想\",\r\n    \"无锡蓝科创想科技有限公司，主要从事软件研发的软件企业。创新，责任，为服务的企业创造价值，是我们的初衷；合作共赢，是我们的愿景！\r\n\")\r\n?>');

-- ----------------------------
-- Table structure for cms_theme_layout
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme_layout`;
CREATE TABLE `cms_theme_layout`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layoutName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `themeId` int(11) NOT NULL,
  `widgetjson` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 22 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_layout
-- ----------------------------
INSERT INTO `cms_theme_layout` VALUES (20, '布局', '2020-03-09 09:43:44', '2020-03-26 19:51:04', 44, '{\"header\":[\"116\"],\"top\":[\"117\"],\"footer\":[\"115\",\"114\"]}');

-- ----------------------------
-- Table structure for cms_theme_page
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme_page`;
CREATE TABLE `cms_theme_page`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeId` int(11) NULL DEFAULT NULL,
  `pageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `pageType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `isDefault` tinyint(4) NOT NULL DEFAULT 0,
  `layoutId` int(11) NOT NULL,
  `widgetjson` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 81 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_page
-- ----------------------------
INSERT INTO `cms_theme_page` VALUES (69, 44, '首页', '2020-03-09 10:00:43', '2020-03-28 13:14:31', 'home', 1, 20, '[\"124\",\"118\",\"119\",\"120\",\"121\",\"122\",\"123\"]');

-- ----------------------------
-- Table structure for plugin_feedback
-- ----------------------------
DROP TABLE IF EXISTS `plugin_feedback`;
CREATE TABLE `plugin_feedback`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `message` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `themeid` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of plugin_feedback
-- ----------------------------
INSERT INTO `plugin_feedback` VALUES (1, '张三', 'zhujun@ranko.cn', 'hello world', 'hello world', '2020-02-24 10:07:54', NULL, 44);

-- ----------------------------
-- Table structure for plugin_message
-- ----------------------------
DROP TABLE IF EXISTS `plugin_message`;
CREATE TABLE `plugin_message`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `themeid` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `reply` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of plugin_message
-- ----------------------------
INSERT INTO `plugin_message` VALUES (1, '测试主题', '用户名', '内容', '2020-02-24 10:29:22', '0000-00-00 00:00:00', 44, '0', NULL);

SET FOREIGN_KEY_CHECKS = 1;
