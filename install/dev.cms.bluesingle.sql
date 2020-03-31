
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
INSERT INTO `cms_admin` VALUES (2, 'ranko', '21232f297a57a5a743894a0e4a801fc3', '2020-01-09 13:15:42', '2020-03-30 09:48:07');

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
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
INSERT INTO `cms_theme` VALUES (44, 'Hello World !', '2020-03-09 09:37:05', '2020-03-26 19:14:14', 0, 0);
INSERT INTO `cms_theme` VALUES (46, '蓝色单页公司', '2020-03-31 17:17:42', '2020-03-31 17:56:39', 1, 1);

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
) ENGINE = InnoDB AUTO_INCREMENT = 125 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_fragment
-- ----------------------------
INSERT INTO `cms_theme_fragment` VALUES (114, 44, '共用_底部引入', '2020-03-26 19:28:34', '2020-03-28 13:17:39', '<!-- Bootstrap core JavaScript -->\r\n<script src=\"themes/basic/vendor/jquery/jquery.min.js\"></script>\r\n<script src=\"themes/basic/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n\r\n<!-- Plugin JavaScript -->\r\n<script src=\"themes/basic/vendor/jquery-easing/jquery.easing.min.js\"></script>\r\n<script src=\"themes/basic/vendor/magnific-popup/jquery.magnific-popup.min.js\"></script>\r\n\r\n<!-- Custom scripts for this template -->\r\n<script src=\"themes/basic/js/creative.min.js\"></script>');
INSERT INTO `cms_theme_fragment` VALUES (115, 44, '共用_版权所有', '2020-03-26 19:29:34', '2020-03-26 19:29:34', '<!-- Footer -->\r\n<footer class=\"bg-light py-5\">\r\n    <div class=\"container\">\r\n        <div class=\"small text-center text-muted\">版权所有 &copy; <?php echo date(\'Y\'); ?> - 无锡市蓝科创想科技有限公司</div>\r\n    </div>\r\n</footer>');
INSERT INTO `cms_theme_fragment` VALUES (116, 44, '共用_HEADER', '2020-03-26 19:30:45', '2020-03-26 19:30:45', '<meta charset=\"utf-8\">\r\n<meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\r\n<meta name=\"keywords\" content=\"<?php echo $this->context->data[\'meta_keywords\']; ?>\">\r\n<meta name=\"description\" content=\"<?php echo $this->context->data[\'meta_description\']; ?>\">\r\n\r\n<title><?php echo $this->context->data[\'meta_title\']; ?> - Powered by ranko.cn </title>\r\n\r\n<!-- Font Awesome Icons -->\r\n<link href=\"themes/basic/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">\r\n\r\n<!-- Plugin CSS -->\r\n<link href=\"themes/basic/vendor/magnific-popup/magnific-popup.css\" rel=\"stylesheet\">\r\n\r\n<!-- Theme CSS - Includes Bootstrap -->\r\n<link href=\"themes/basic/css/creative.css\" rel=\"stylesheet\">');
INSERT INTO `cms_theme_fragment` VALUES (117, 44, '共用_导航片段', '2020-03-26 19:50:54', '2020-03-26 19:50:54', '<!-- Navigation -->\r\n<nav class=\"navbar navbar-expand-lg navbar-light fixed-top py-3\" id=\"mainNav\">\r\n    <div class=\"container\">\r\n        <a class=\"navbar-brand js-scroll-trigger\" href=\"#page-top\">RANKO.CN</a>\r\n        <button class=\"navbar-toggler navbar-toggler-right\" type=\"button\" data-toggle=\"collapse\"\r\n                data-target=\"#navbarResponsive\" aria-controls=\"navbarResponsive\" aria-expanded=\"false\"\r\n                aria-label=\"Toggle navigation\">\r\n            <span class=\"navbar-toggler-icon\"></span>\r\n        </button>\r\n        <div class=\"collapse navbar-collapse\" id=\"navbarResponsive\">\r\n            <ul class=\"navbar-nav ml-auto my-2 my-lg-0\">\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#about\">关于</a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#services\">服务</a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#portfolio\">案例</a>\r\n                </li>\r\n                <li class=\"nav-item\">\r\n                    <a class=\"nav-link js-scroll-trigger\" href=\"#contact\">联系</a>\r\n                </li>\r\n            </ul>\r\n        </div>\r\n    </div>\r\n</nav>');
INSERT INTO `cms_theme_fragment` VALUES (118, 44, '首页_RKCMS介绍', '2020-03-26 19:52:08', '2020-03-26 19:52:08', '<!-- Masthead -->\r\n<header class=\"masthead\">\r\n    <div class=\"container h-100\">\r\n        <div class=\"row h-100 align-items-center justify-content-center text-center\">\r\n            <div class=\"col-lg-10 align-self-end\">\r\n                <h1 class=\"text-uppercase text-white font-weight-bold\">RKCMS</h1>\r\n                <hr class=\"divider my-4\">\r\n            </div>\r\n            <div class=\"col-lg-8 align-self-baseline\">\r\n                <p class=\"text-white-75 font-weight-light mb-5\">开源、免费的企业网站系统!在GPL开源协议前提下，个人或者企业组织可以免费使用!</p>\r\n                <a class=\"btn btn-primary btn-xl js-scroll-trigger\" href=\"#about\">了解更多</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</header>\r\n');
INSERT INTO `cms_theme_fragment` VALUES (119, 44, '首页_提供你想要的服务', '2020-03-28 12:55:30', '2020-03-28 12:55:30', '<!-- About Section -->\r\n<section class=\"page-section bg-primary\" id=\"about\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <div class=\"col-lg-8 text-center\">\r\n                <h2 class=\"text-white mt-0\">提供你想要的服务</h2>\r\n                <hr class=\"divider light my-4\">\r\n                <p class=\"text-white-50 mb-4\">RKCMS可以用于快速创建你的网站！下载免费源码，获取你所需要的主题，你的目标很快就能达成！</p>\r\n                <a class=\"btn btn-light btn-xl js-scroll-trigger\" href=\"#services\">立即开始</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (120, 44, '首页_我们的服务', '2020-03-28 12:58:22', '2020-03-30 11:30:13', '<!-- Services Section -->\r\n<section class=\"page-section\" id=\"services\">\r\n    <div class=\"container\">\r\n        <h2 class=\"text-center mt-0\">我们的服务</h2>\r\n        <hr class=\"divider my-4\">\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-gem text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">优质的主题</h3>\r\n                    <p class=\"text-muted mb-0\">应用市场提供多种行业所需的优质主题</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-laptop-code text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">永久更新</h3>\r\n                    <p class=\"text-muted mb-0\">开源代码库始终可开发进行中的代码保持一致</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-globe text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">快速改版</h3>\r\n                    <p class=\"text-muted mb-0\">可以通过后台主题模板编辑快速修改页面内容</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-heart text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">按需定制</h3>\r\n                    <p class=\"text-muted mb-0\">如果你有特殊需求，可以根据你的需求进行定制</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (121, 44, '首页_案例', '2020-03-28 12:58:44', '2020-03-28 13:07:01', '<!-- Portfolio Section -->\r\n<section id=\"portfolio\">\r\n    <div class=\"container-fluid p-0\">\r\n        <div class=\"row no-gutters\">\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/1.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/1.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/2.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/2.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/3.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/3.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/4.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/4.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/5.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/5.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/6.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/6.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption p-3\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                            项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n');
INSERT INTO `cms_theme_fragment` VALUES (122, 44, '首页_免费获取', '2020-03-28 12:59:08', '2020-03-30 11:19:44', '<!-- Call to Action Section -->\r\n<section class=\"page-section bg-dark text-white\">\r\n    <div class=\"container text-center\">\r\n        <h2 class=\"mb-4\">免费获取</h2>\r\n        <a class=\"btn btn-light btn-xl\" href=\"http://www.ranko.cn/opensource-2.html\">立即下载</a>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (123, 44, '首页_联系我们', '2020-03-28 12:59:28', '2020-03-28 12:59:28', '<!-- Contact Section -->\r\n<section class=\"page-section\" id=\"contact\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <div class=\"col-lg-8 text-center\">\r\n                <h2 class=\"mt-0\">联系我们</h2>\r\n                <hr class=\"divider my-4\">\r\n                <p class=\"text-muted mb-5\">你是否准备创建自己的网站？想了解更多关于RKCMS的信息，你可以通过电话、邮箱联系我们，我们\r\n                    将尽快给予回复！</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-4 ml-auto text-center mb-5 mb-lg-0\">\r\n                <i class=\"fas fa-phone fa-3x mb-3 text-muted\"></i>\r\n                <div>+86 18068252703</div>\r\n            </div>\r\n            <div class=\"col-lg-4 mr-auto text-center\">\r\n                <i class=\"fas fa-envelope fa-3x mb-3 text-muted\"></i>\r\n                <a class=\"d-block\" href=\"mailto:458820281@qq.com\">458820281@qq.com</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>');
INSERT INTO `cms_theme_fragment` VALUES (124, 44, '首页_META', '2020-03-28 13:14:16', '2020-03-28 13:14:16', '<?php\r\n$this->context->setMeta(\"无锡蓝科创想科技有限公司\", \"无锡，蓝科，无锡蓝科，蓝科创想\",\r\n    \"无锡蓝科创想科技有限公司，主要从事软件研发的软件企业。创新，责任，为服务的企业创造价值，是我们的初衷；合作共赢，是我们的愿景！\r\n\")\r\n?>');
INSERT INTO `cms_theme_fragment` VALUES (125, 46, '共用_HEADER', '2020-03-31 17:28:31', '2020-03-31 17:28:31', '<meta charset=\"utf-8\">\r\n<title>企业网站系统 - POWERED BY RANKO.CN</title>\r\n<meta content=\"width=device-width, initial-scale=1.0\" name=\"viewport\">\r\n<meta content=\"\" name=\"keywords\">\r\n<meta content=\"\" name=\"description\">\r\n\r\n<!-- Favicons -->\r\n<link href=\"themes/bluesingle/img/favicon.ico\" rel=\"icon\">\r\n\r\n\r\n<!-- Bootstrap CSS File -->\r\n<link href=\"themes/bluesingle/lib/bootstrap/css/bootstrap.min.css\" rel=\"stylesheet\">\r\n\r\n<!-- Libraries CSS Files -->\r\n<link href=\"themes/bluesingle/lib/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\">\r\n<link href=\"themes/bluesingle/lib/animate/animate.min.css\" rel=\"stylesheet\">\r\n<link href=\"themes/bluesingle/lib/ionicons/css/ionicons.min.css\" rel=\"stylesheet\">\r\n<link href=\"themes/bluesingle/lib/owlcarousel/assets/owl.carousel.min.css\" rel=\"stylesheet\">\r\n<link href=\"themes/bluesingle/lib/lightbox/css/lightbox.min.css\" rel=\"stylesheet\">\r\n\r\n<!-- Main Stylesheet File -->\r\n<link href=\"themes/bluesingle/css/style.css\" rel=\"stylesheet\">');
INSERT INTO `cms_theme_fragment` VALUES (126, 46, '共用_FOOTER', '2020-03-31 17:29:59', '2020-03-31 17:29:59', '\r\n<footer id=\"footer\">\r\n    <div class=\"footer-top\">\r\n        <div class=\"container\">\r\n            <div class=\"row\">\r\n\r\n                <div class=\"col-lg-4 col-md-6 footer-info\">\r\n                    <h3>蓝科创想</h3>\r\n                    <p>从事软件研发，软件应用的创新型公司</p>\r\n                </div>\r\n\r\n                <div class=\"col-lg-2 col-md-6 footer-links\">\r\n                    <h4>常用链接</h4>\r\n                    <ul>\r\n                        <li><a href=\"#\">首页</a></li>\r\n                        <li><a href=\"#\">关于我们</a></li>\r\n                        <li><a href=\"#\">服务</a></li>\r\n                        <li><a href=\"#\">团队</a></li>\r\n                    </ul>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-6 footer-contact\">\r\n                    <h4>联系我们</h4>\r\n                    <p>\r\n                        江苏省，无锡市，惠山区<br>\r\n                        中国 <br>\r\n                        <strong>电话:</strong> 18068252703<br>\r\n                        <strong>邮箱:</strong> zhujun@ranko.cn<br>\r\n                    </p>\r\n\r\n\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-6 footer-newsletter\">\r\n                    <h4>邮件订阅</h4>\r\n                    <p>通过邮件订阅获取最新资讯</p>\r\n                    <form action=\"\" method=\"post\">\r\n                        <input type=\"email\" name=\"email\"><input type=\"submit\" value=\"订阅\">\r\n                    </form>\r\n                </div>\r\n\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n    <div class=\"container\">\r\n        <div class=\"copyright\">\r\n            &copy; Copyright <strong>RANKO.CN</strong>. All Rights Reserved\r\n        </div>\r\n\r\n    </div>\r\n</footer><!-- #footer -->\r\n<a href=\"#\" class=\"back-to-top\"><i class=\"fa fa-chevron-up\"></i></a>\r\n<!-- Uncomment below i you want to use a preloader -->\r\n<!-- <div id=\"preloader\"></div> -->\r\n\r\n<!-- JavaScript Libraries -->\r\n<script src=\"themes/bluesingle/lib/jquery/jquery.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/jquery/jquery-migrate.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/easing/easing.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/mobile-nav/mobile-nav.js\"></script>\r\n<script src=\"themes/bluesingle/lib/wow/wow.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/waypoints/waypoints.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/counterup/counterup.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/owlcarousel/owl.carousel.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/isotope/isotope.pkgd.min.js\"></script>\r\n<script src=\"themes/bluesingle/lib/lightbox/js/lightbox.min.js\"></script>\r\n<!-- Contact Form JavaScript File -->\r\n<script src=\"themes/bluesingle/contactform/contactform.js\"></script>\r\n\r\n<!-- Template Main Javascript File -->\r\n<script src=\"themes/bluesingle/js/main.js\"></script>');
INSERT INTO `cms_theme_fragment` VALUES (127, 46, '内容', '2020-03-31 17:30:38', '2020-03-31 17:30:38', '<!--==========================\r\nHeader\r\n============================-->\r\n<header id=\"header\" class=\"fixed-top\">\r\n    <div class=\"container\">\r\n\r\n        <div class=\"logo float-left\">\r\n            <!-- Uncomment below if you prefer to use an image logo -->\r\n            <!-- <h1 class=\"text-light\"><a href=\"#header\"><span>RANKO.CN</span></a></h1> -->\r\n            <a href=\"#intro\" class=\"scrollto\"><img src=\"themes/bluesingle/img/logo.png\" alt=\"\" class=\"img-fluid\"></a>\r\n        </div>\r\n\r\n        <nav class=\"main-nav float-right d-none d-lg-block\">\r\n            <ul>\r\n                <li class=\"active\"><a href=\"#intro\">首页</a></li>\r\n                <li><a href=\"#about\">关于我们</a></li>\r\n                <li><a href=\"#services\">服务</a></li>\r\n                <li><a href=\"#portfolio\">案例</a></li>\r\n                <li><a href=\"#team\">团队</a></li>\r\n                <li><a href=\"#contact\">联系我们</a></li>\r\n            </ul>\r\n        </nav><!-- .main-nav -->\r\n\r\n    </div>\r\n</header><!-- #header -->\r\n<!--==========================\r\n  Intro Section\r\n============================-->\r\n<section id=\"intro\" class=\"clearfix\">\r\n    <div class=\"container\">\r\n\r\n        <div class=\"intro-img\">\r\n            <img src=\"themes/bluesingle/img/intro-img.svg\" alt=\"\" class=\"img-fluid\">\r\n        </div>\r\n\r\n        <div class=\"intro-info\">\r\n            <h2>我们提供<br><span>企业软件应用</span><br>！</h2>\r\n            <div>\r\n                <a href=\"#about\" class=\"btn-get-started scrollto\">关于我们</a>\r\n                <a href=\"#services\" class=\"btn-services scrollto\">服 务</a>\r\n            </div>\r\n        </div>\r\n\r\n    </div>\r\n</section><!-- #intro -->\r\n\r\n<main id=\"main\">\r\n    <!--==========================\r\n  About Us Section\r\n============================-->\r\n    <section id=\"about\">\r\n        <div class=\"container\">\r\n\r\n            <header class=\"section-header\">\r\n                <h3>关于我们</h3>\r\n                <p>无锡蓝科创想科技有限公司</p>\r\n            </header>\r\n\r\n            <div class=\"row about-container\">\r\n\r\n                <div class=\"col-lg-6 content order-lg-1 order-2\">\r\n                    <p>\r\n                        企业应用软件是指可以在系统软件之外的所有应用软件上运行的为企业开发的应用·为满足企业应用需求而提供的软件。\r\n                    </p>\r\n\r\n                    <div class=\"icon-box wow fadeInUp\">\r\n                        <div class=\"icon\"><i class=\"fa fa-home\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">企业网站</a></h4>\r\n                        <p class=\"description\">\r\n                            企业网站是企业在互联网上进行网络营销和形象宣传的平台，相当于企业的网络名片，不但对企业的形象是一个良好的宣传，同时可以辅助企业的销售，通过网络直接帮助企业实现产品的销售，企业可以利用网站来进行宣传、产品资讯发布、招聘等。</p>\r\n                    </div>\r\n\r\n                    <div class=\"icon-box wow fadeInUp\" data-wow-delay=\"0.2s\">\r\n                        <div class=\"icon\"><i class=\"fa fa-group\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">论坛</a></h4>\r\n                        <p class=\"description\">网络论坛是一个和网络技术有关的网上交流场所。一般就是大家口中常提的BBS。 BBS的英文全称是Bulletin Board\r\n                            System，翻译为中文就是“电子公告板”。</p>\r\n                    </div>\r\n\r\n                    <div class=\"icon-box wow fadeInUp\" data-wow-delay=\"0.4s\">\r\n                        <div class=\"icon\"><i class=\"fa fa-user\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">博客</a></h4>\r\n                        <p class=\"description\">博客，仅音译，英文名为Blogger,为Web\r\n                            Log的混成词。它的正式名称为网络日记；又音译为部落格或部落阁等，是使用特定的软件，在网络上出版、发表和张贴个人文章的人，或者是一种通常由个人管理、不定期张贴新的文章的网站。</p>\r\n                    </div>\r\n\r\n                </div>\r\n\r\n                <div class=\"col-lg-6 background order-lg-2 order-1 wow fadeInUp\">\r\n                    <img src=\"themes/bluesingle/img/about-img.svg\" class=\"img-fluid\" alt=\"\">\r\n                </div>\r\n            </div>\r\n            <div class=\"row about-extra\">\r\n                <div class=\"col-lg-6 wow fadeInUp\">\r\n                    <img src=\"themes/bluesingle/img/about-extra-2.svg\" class=\"img-fluid\" alt=\"\">\r\n                </div>\r\n                <div class=\"col-lg-6 wow fadeInUp pt-5 pt-lg-0\">\r\n                    <h4>应用软件云服务</h4>\r\n                    <p>\r\n                        云服务可以将企业所需的软硬件、资料都放到网络上，在任何时间、地点，使用不同的IT设备互相连接，实现数据存取、运算等目的。当前，常见的云服务有公共云（Public\r\n                        Cloud）与私有云（Private Cloud）两种。\r\n                    </p>\r\n                    <p>\r\n                        公共云是最基础的服务，多个客户可共享一个服务提供商的系统资源，他们毋须架设任何设备及配备管理人员，便可享有专业的IT服务，这对于一般创业者、中小企来说，无疑是一个降低成本的好方法。\r\n                    </p>\r\n                    <p>\r\n                        按需计算服务的客户端基本上将这些服务作为异地虚拟服务器来使用。无须投资自己的物理基础设施，公司与云服务提供商之间执行现用现付的方案。\r\n                    </p>\r\n                    <p>\r\n                        云安全(Cloud\r\n                        Security)是一个从“云计算”演变而来的新名词。云安全的策略构想是：使用者越多，每个使用者就越安全，因为如此庞大的用户群，足以覆盖互联网的每个角落，只要某个网站被挂马或某个新木马病毒出现，就会立刻被截获。\r\n                    </p>\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n    </section><!-- #about -->\r\n    <!--==========================\r\n  Services Section\r\n============================-->\r\n    <section id=\"services\" class=\"section-bg\">\r\n        <div class=\"container\">\r\n\r\n            <header class=\"section-header\">\r\n                <h3>服务</h3>\r\n                <p>企业网站，博客，论坛，客户关系管理等企业应用软件</p>\r\n            </header>\r\n\r\n            <div class=\"row\">\r\n\r\n                <div class=\"col-md-6 col-lg-5 offset-lg-1 wow bounceInUp\" data-wow-duration=\"1.4s\">\r\n                    <div class=\"box\">\r\n                        <div class=\"icon\"><i class=\"ion-ios-analytics-outline\" style=\"color: #ff689b;\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">企业网站</a></h4>\r\n                        <p class=\"description\">企业网站，就是企业以网络营销为目的，为了在互联网上进行企业宣传，节约宣传成本，增加宣传方式而建设的网站。</p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md-6 col-lg-5 wow bounceInUp\" data-wow-duration=\"1.4s\">\r\n                    <div class=\"box\">\r\n                        <div class=\"icon\"><i class=\"ion-ios-bookmarks-outline\" style=\"color: #e9bf06;\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">博客</a></h4>\r\n                        <p class=\"description\">Blog就是以网络作为载体，简易迅速便捷地发布自己的心得，及时有效轻松地与他人进行交流，再集丰富多彩的个性化展示于一体的综合性平台。</p>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-md-6 col-lg-5 offset-lg-1 wow bounceInUp\" data-wow-delay=\"0.1s\"\r\n                     data-wow-duration=\"1.4s\">\r\n                    <div class=\"box\">\r\n                        <div class=\"icon\"><i class=\"ion-ios-paper-outline\" style=\"color: #3fcdc7;\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">论坛</a></h4>\r\n                        <p class=\"description\">网络论坛是一个和网络技术有关的网上交流场所。一般就是大家口中常提的BBS。</p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md-6 col-lg-5 wow bounceInUp\" data-wow-delay=\"0.1s\" data-wow-duration=\"1.4s\">\r\n                    <div class=\"box\">\r\n                        <div class=\"icon\"><i class=\"ion-ios-speedometer-outline\" style=\"color:#41cf2e;\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">客户管理</a></h4>\r\n                        <p class=\"description\">客户关系管理（CRM）是指对企业和客户之间的交互活动进行管理的过程。</p>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-md-6 col-lg-5 offset-lg-1 wow bounceInUp\" data-wow-delay=\"0.2s\"\r\n                     data-wow-duration=\"1.4s\">\r\n                    <div class=\"box\">\r\n                        <div class=\"icon\"><i class=\"ion-ios-world-outline\" style=\"color: #d6ff22;\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">商城管理</a></h4>\r\n                        <p class=\"description\">网上商城系统又称在线商城系统，是一个功能完善的在线购物系统，主要为在线销售和在线购物服务。</p>\r\n                    </div>\r\n                </div>\r\n                <div class=\"col-md-6 col-lg-5 wow bounceInUp\" data-wow-delay=\"0.2s\" data-wow-duration=\"1.4s\">\r\n                    <div class=\"box\">\r\n                        <div class=\"icon\"><i class=\"ion-ios-clock-outline\" style=\"color: #4680ff;\"></i></div>\r\n                        <h4 class=\"title\"><a href=\"\">采购管理</a></h4>\r\n                        <p class=\"description\">可以有效的为企业提供进出库的便捷方式，并且可以通过平常的系统录入可以进行直观的展示。</p>\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n    </section><!-- #services -->\r\n    <!--==========================\r\n  Why Us Section\r\n============================-->\r\n    <section id=\"why-us\" class=\"wow fadeIn\">\r\n        <div class=\"container\">\r\n            <header class=\"section-header\">\r\n                <h3>为什么选择我们？</h3>\r\n                <p>为客户创造价值，是我们的使命！</p>\r\n            </header>\r\n\r\n            <div class=\"row row-eq-height justify-content-center\">\r\n\r\n                <div class=\"col-lg-4 mb-4\">\r\n                    <div class=\"card wow bounceInUp\">\r\n                        <i class=\"fa fa-diamond\"></i>\r\n                        <div class=\"card-body\">\r\n                            <h5 class=\"card-title\">高品质服务</h5>\r\n                            <p class=\"card-text\">高品质服务，对于同一项服务，在不添加任何附加价值的情况下，通过提高服务意识、服务熟练度和服务质量，从而得到客户的高度认可的服务。</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 mb-4\">\r\n                    <div class=\"card wow bounceInUp\">\r\n                        <i class=\"fa fa-language\"></i>\r\n                        <div class=\"card-body\">\r\n                            <h5 class=\"card-title\">丰富实施经验</h5>\r\n                            <p class=\"card-text\">项目实施是指从项目的勘察设计、建设准备、计划安排、工程施工、生产准备、竣工验收、直到项目建成投产所进行的一系列工作。</p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 mb-4\">\r\n                    <div class=\"card wow bounceInUp\">\r\n                        <i class=\"fa fa-object-group\"></i>\r\n                        <div class=\"card-body\">\r\n                            <h5 class=\"card-title\">售后保障</h5>\r\n                            <p class=\"card-text\">售后服务由售后服务中心处理，顾客投诉的由投诉处处理，商品所在的楼层予以协助。 </p>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n\r\n            <div class=\"row counters\">\r\n\r\n                <div class=\"col-lg-3 col-6 text-center\">\r\n                    <span data-toggle=\"counter-up\">274</span>\r\n                    <p>客户</p>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-6 text-center\">\r\n                    <span data-toggle=\"counter-up\">421</span>\r\n                    <p>项目</p>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-6 text-center\">\r\n                    <span data-toggle=\"counter-up\">1,364</span>\r\n                    <p>支持工时</p>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-6 text-center\">\r\n                    <span data-toggle=\"counter-up\">18</span>\r\n                    <p>成员</p>\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n    </section>\r\n    <!--==========================\r\n      Portfolio Section\r\n    ============================-->\r\n    <section id=\"portfolio\" class=\"clearfix\">\r\n        <div class=\"container\">\r\n\r\n            <header class=\"section-header\">\r\n                <h3 class=\"section-title\">案例</h3>\r\n            </header>\r\n\r\n            <div class=\"row\">\r\n                <div class=\"col-lg-12\">\r\n                    <ul id=\"portfolio-flters\">\r\n                        <li data-filter=\"*\" class=\"filter-active\">所有</li>\r\n                        <li data-filter=\".filter-app\">手机应用</li>\r\n                        <li data-filter=\".filter-card\">设计</li>\r\n                        <li data-filter=\".filter-web\">网站</li>\r\n                    </ul>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"row portfolio-container\">\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-app\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/app1.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">App 1</a></h4>\r\n                            <p>App</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/app1.jpg\" data-lightbox=\"portfolio\"\r\n                                   data-title=\"App 1\" class=\"link-preview\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-web\" data-wow-delay=\"0.1s\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/web3.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">Web 3</a></h4>\r\n                            <p>Web</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/web3.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"Web 3\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-app\" data-wow-delay=\"0.2s\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/app2.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">App 2</a></h4>\r\n                            <p>App</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/app2.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"App 2\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-card\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/card2.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">Card 2</a></h4>\r\n                            <p>Card</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/card2.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"Card 2\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-web\" data-wow-delay=\"0.1s\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/web2.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">Web 2</a></h4>\r\n                            <p>Web</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/web2.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"Web 2\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-app\" data-wow-delay=\"0.2s\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/app3.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">App 3</a></h4>\r\n                            <p>App</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/app3.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"App 3\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-card\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/card1.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">Card 1</a></h4>\r\n                            <p>Card</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/card1.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"Card 1\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-card\" data-wow-delay=\"0.1s\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/card3.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">Card 3</a></h4>\r\n                            <p>Card</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/card3.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"Card 3\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-4 col-md-6 portfolio-item filter-web\" data-wow-delay=\"0.2s\">\r\n                    <div class=\"portfolio-wrap\">\r\n                        <img src=\"themes/bluesingle/img/portfolio/web1.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"portfolio-info\">\r\n                            <h4><a href=\"#\">Web 1</a></h4>\r\n                            <p>Web</p>\r\n                            <div>\r\n                                <a href=\"themes/bluesingle/img/portfolio/web1.jpg\" class=\"link-preview\"\r\n                                   data-lightbox=\"portfolio\" data-title=\"Web 1\" title=\"Preview\"><i\r\n                                            class=\"ion ion-eye\"></i></a>\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n    </section><!-- #portfolio -->\r\n    <!--==========================\r\n      Clients Section\r\n    ============================-->\r\n    <section id=\"testimonials\" class=\"section-bg\">\r\n        <div class=\"container\">\r\n\r\n            <header class=\"section-header\">\r\n                <h3>客户评价</h3>\r\n            </header>\r\n\r\n            <div class=\"row justify-content-center\">\r\n                <div class=\"col-lg-8\">\r\n\r\n                    <div class=\"owl-carousel testimonials-carousel wow fadeInUp\">\r\n\r\n                        <div class=\"testimonial-item\">\r\n                            <img src=\"themes/bluesingle/img/testimonial-1.jpg\" class=\"testimonial-img\" alt=\"\">\r\n                            <h3>张三</h3>\r\n                            <h4>CEO</h4>\r\n                            <p>\r\n                                蓝科公司为我们提供了多年的软件服务，产品易用性强，稳定，售后服务好，值得信赖。\r\n                            </p>\r\n                        </div>\r\n\r\n                        <div class=\"testimonial-item\">\r\n                            <img src=\"themes/bluesingle/img/testimonial-2.jpg\" class=\"testimonial-img\" alt=\"\">\r\n                            <h3>李四</h3>\r\n                            <h4>设计人员</h4>\r\n                            <p>\r\n                                蓝科公司每款产品都强大，技术过硬，稳定，服务态度好，不愧是有着10年资历的软件开发公司。\r\n                            </p>\r\n                        </div>\r\n\r\n                        <div class=\"testimonial-item\">\r\n                            <img src=\"themes/bluesingle/img/testimonial-3.jpg\" class=\"testimonial-img\" alt=\"\">\r\n                            <h3>王五</h3>\r\n                            <h4>店主</h4>\r\n                            <p>\r\n                                蓝科公司的软件和工具稳定，使我们更接近客户，了解他们想要什么。\r\n                            </p>\r\n                        </div>\r\n\r\n\r\n                    </div>\r\n\r\n                </div>\r\n            </div>\r\n\r\n\r\n        </div>\r\n    </section><!-- #testimonials -->\r\n    <!--==========================\r\n  Team Section\r\n============================-->\r\n    <section id=\"team\">\r\n        <div class=\"container\">\r\n            <div class=\"section-header\">\r\n                <h3>团队</h3>\r\n                <p>团队（Team）是由基层和管理层人员组成的一个共同体，它合理利用每一个成员的知识和技能协同工作，解决问题，达到共同的目标。</p>\r\n            </div>\r\n\r\n            <div class=\"row\">\r\n\r\n                <div class=\"col-lg-3 col-md-6 wow fadeInUp\">\r\n                    <div class=\"member\">\r\n                        <img src=\"themes/bluesingle/img/team-1.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"member-info\">\r\n                            <div class=\"member-info-content\">\r\n                                <h4>张三</h4>\r\n                                <span>PHP开发</span>\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-6 wow fadeInUp\" data-wow-delay=\"0.1s\">\r\n                    <div class=\"member\">\r\n                        <img src=\"themes/bluesingle/img/team-2.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"member-info\">\r\n                            <div class=\"member-info-content\">\r\n                                <h4>张三</h4>\r\n                                <span>PHP开发</span>\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-6 wow fadeInUp\" data-wow-delay=\"0.2s\">\r\n                    <div class=\"member\">\r\n                        <img src=\"themes/bluesingle/img/team-3.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"member-info\">\r\n                            <div class=\"member-info-content\">\r\n                                <h4>张三</h4>\r\n                                <span>PHP开发</span>\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-6 wow fadeInUp\" data-wow-delay=\"0.3s\">\r\n                    <div class=\"member\">\r\n                        <img src=\"themes/bluesingle/img/team-4.jpg\" class=\"img-fluid\" alt=\"\">\r\n                        <div class=\"member-info\">\r\n                            <div class=\"member-info-content\">\r\n                                <h4>张三</h4>\r\n                                <span>PHP开发</span>\r\n\r\n                            </div>\r\n                        </div>\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n    </section><!-- #team -->\r\n    <!--==========================\r\n      Clients Section\r\n    ============================-->\r\n    <section id=\"clients\" class=\"section-bg\">\r\n\r\n        <div class=\"container\">\r\n\r\n            <div class=\"section-header\">\r\n                <h3>客户</h3>\r\n                <p>客户或顾客可以指用金钱或某种有价值的物品来换取接受财产、服务、产品或某种创意的自然人或组织。</p>\r\n            </div>\r\n\r\n            <div class=\"row no-gutters clients-wrap clearfix wow fadeInUp\">\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-1.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-2.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-3.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-4.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-5.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-6.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-7.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n                <div class=\"col-lg-3 col-md-4 col-xs-6\">\r\n                    <div class=\"client-logo\">\r\n                        <img src=\"themes/bluesingle/img/clients/client-8.png\" class=\"img-fluid\" alt=\"\">\r\n                    </div>\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n\r\n    </section>\r\n    <!--==========================\r\n  Contact Section\r\n============================-->\r\n    <section id=\"contact\">\r\n        <div class=\"container\">\r\n\r\n            <div class=\"section-header\">\r\n                <h3>联系我们</h3>\r\n            </div>\r\n\r\n            <div class=\"row wow fadeInUp\">\r\n                <div class=\"col-lg-12\">\r\n                    <div class=\"row\">\r\n                        <div class=\"col-md-5 info\">\r\n                            <i class=\"ion-ios-location-outline\"></i>\r\n                            <p>江苏省，无锡市，惠山区</p>\r\n                        </div>\r\n                        <div class=\"col-md-4 info\">\r\n                            <i class=\"ion-ios-email-outline\"></i>\r\n                            <p>zhujun@ranko.cn</p>\r\n                        </div>\r\n                        <div class=\"col-md-3 info\">\r\n                            <i class=\"ion-ios-telephone-outline\"></i>\r\n                            <p>+86 18068252703</p>\r\n                        </div>\r\n                    </div>\r\n\r\n                    <form action=\"\" method=\"post\" role=\"form\" class=\"contactForm\">\r\n                        <input type=\'hidden\' id=\"_csrf\" name=\"_csrf\"\r\n                               value=\"<?php echo Yii::$app->request->csrfToken; ?>\"/>\r\n                        <div class=\"form-row\">\r\n                            <div class=\"form-group col-lg-6\">\r\n                                <input type=\"text\" name=\"username\" class=\"form-control\" id=\"name\"\r\n                                       placeholder=\"姓名\" data-rule=\"minlen:4\" data-msg=\"请输入至少4个字符\"/>\r\n                                <div class=\"validation\"></div>\r\n                            </div>\r\n                            <div class=\"form-group col-lg-6\">\r\n                                <input type=\"email\" class=\"form-control\" name=\"email\" id=\"email\"\r\n                                       placeholder=\"邮箱\" data-rule=\"email\" data-msg=\"请输入有效的邮箱\"/>\r\n                                <div class=\"validation\"></div>\r\n                            </div>\r\n                        </div>\r\n                        <div class=\"form-group\">\r\n                            <input type=\"text\" class=\"form-control\" name=\"subject\" id=\"subject\"\r\n                                   placeholder=\"主题\" data-rule=\"minlen:4\" data-msg=\"请输入至少4个字符以上的主题\"/>\r\n                            <div class=\"validation\"></div>\r\n                        </div>\r\n                        <div class=\"form-group\">\r\n                            <textarea class=\"form-control\" name=\"message\" rows=\"5\" data-rule=\"required\"\r\n                                      data-msg=\"请填写内容\" placeholder=\"内容\"></textarea>\r\n                            <div class=\"validation\"></div>\r\n                        </div>\r\n                        <div class=\"text-center\">\r\n                            <button type=\"submit\" title=\"留言\">留言</button>\r\n                        </div>\r\n                    </form>\r\n\r\n                </div>\r\n\r\n            </div>\r\n\r\n        </div>\r\n    </section><!-- #contact -->\r\n\r\n</main>');

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
INSERT INTO `cms_theme_layout` VALUES (20, '布局', '2020-03-09 09:43:44', '2020-03-30 10:36:00', 44, '{\"header\":[\"116\"],\"top\":[\"117\"],\"footer\":[\"115\",\"114\"]}');
INSERT INTO `cms_theme_layout` VALUES (22, '布局', '2020-03-31 17:30:50', '2020-03-31 17:31:01', 46, '{\"header\":[\"125\"],\"top\":[],\"footer\":[\"126\"]}');

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
INSERT INTO `cms_theme_page` VALUES (69, 44, '首页', '2020-03-09 10:00:43', '2020-03-30 11:03:55', 'home', 1, 20, '[\"124\",\"118\",\"119\",\"120\",\"121\",\"122\",\"123\"]');
INSERT INTO `cms_theme_page` VALUES (81, 46, '首页', '2020-03-31 17:31:16', '2020-03-31 17:31:29', 'home', 1, 22, '[\"127\"]');

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
