

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
  `createtime` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of cms_admin
-- ----------------------------
INSERT INTO `cms_admin` VALUES (2, 'ranko', '21232f297a57a5a743894a0e4a801fc3', '2020-01-09 13:15:42', '2020-03-03 21:44:02');

-- ----------------------------
-- Table structure for cms_catalog
-- ----------------------------
DROP TABLE IF EXISTS `cms_catalog`;
CREATE TABLE `cms_catalog`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `parentId` int(11) NOT NULL DEFAULT 0,
  `sequenceNumber` int(11) NULL DEFAULT 0,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `deleted` tinyint(255) NOT NULL DEFAULT 0,
  `catalogPath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `themeId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 90 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;


-- ----------------------------
-- Table structure for cms_config
-- ----------------------------
DROP TABLE IF EXISTS `cms_config`;
CREATE TABLE `cms_config`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cfgkey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `cfgvalue` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
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
-- Table structure for cms_mapping
-- ----------------------------
DROP TABLE IF EXISTS `cms_mapping`;
CREATE TABLE `cms_mapping`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `themeId` int(11) NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_mapping
-- ----------------------------
INSERT INTO `cms_mapping` VALUES (1, 'dev.biz.cms.cn', 40, '0000-00-00 00:00:00', '2020-02-08 15:07:32');

-- ----------------------------
-- Table structure for cms_plugin
-- ----------------------------
DROP TABLE IF EXISTS `cms_plugin`;
CREATE TABLE `cms_plugin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pluginName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pluginId` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NULL DEFAULT CURRENT_TIMESTAMP,
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
INSERT INTO `cms_plugin` VALUES (6, '联系表单', 'feedback', '2019-12-19 14:25:53', '2020-01-12 13:49:59', '页面的联系信息表单提交功能', 'active', 1, 38);
INSERT INTO `cms_plugin` VALUES (7, '在线留言', 'message', '2019-12-19 14:44:50', '2020-01-12 13:50:00', '用户留言信息并反馈', 'active', 1, 38);

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
) ENGINE = InnoDB AUTO_INCREMENT = 77 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 58 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cms_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `cms_post_tag`;
CREATE TABLE `cms_post_tag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `postId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 115 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_select
-- ----------------------------
INSERT INTO `cms_select` VALUES (11, 'articleStatus', 0);
INSERT INTO `cms_select` VALUES (19, 'article_properties', 0);
INSERT INTO `cms_select` VALUES (10, 'configtype', 0);
INSERT INTO `cms_select` VALUES (12, 'contentType', 0);
INSERT INTO `cms_select` VALUES (14, 'download_properties', 0);
INSERT INTO `cms_select` VALUES (23, 'fragmentType', 0);
INSERT INTO `cms_select` VALUES (13, 'image_properties', 38);
INSERT INTO `cms_select` VALUES (21, 'image_properties', 39);
INSERT INTO `cms_select` VALUES (8, 'pageType', 0);
INSERT INTO `cms_select` VALUES (16, 'product_properties', 38);
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
  `widgetClass` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 195 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_select_options
-- ----------------------------
INSERT INTO `cms_select_options` VALUES (35, 8, '首页', 'home', 0, NULL);
INSERT INTO `cms_select_options` VALUES (36, 8, '文章列表', 'articleList', 1, NULL);
INSERT INTO `cms_select_options` VALUES (37, 8, '文章详情', 'article', 2, NULL);
INSERT INTO `cms_select_options` VALUES (38, 8, '图片列表', 'imageList', 3, NULL);
INSERT INTO `cms_select_options` VALUES (39, 8, '图片详情', 'image', 4, NULL);
INSERT INTO `cms_select_options` VALUES (40, 8, '产品列表', 'productList', 5, NULL);
INSERT INTO `cms_select_options` VALUES (41, 8, '产品详情', 'product', 6, NULL);
INSERT INTO `cms_select_options` VALUES (42, 8, '下载列表', 'downloadList', 7, NULL);
INSERT INTO `cms_select_options` VALUES (43, 8, '下载详情', 'download', 8, NULL);
INSERT INTO `cms_select_options` VALUES (44, 8, '招聘列表', 'employeeList', 9, NULL);
INSERT INTO `cms_select_options` VALUES (45, 8, '招聘详情', 'employee', 10, NULL);
INSERT INTO `cms_select_options` VALUES (46, 9, '导航栏', 'navbar', 0, NULL);
INSERT INTO `cms_select_options` VALUES (47, 9, '底部', 'footer', 10, NULL);
INSERT INTO `cms_select_options` VALUES (48, 10, '基本参数', 'basic', 0, NULL);
INSERT INTO `cms_select_options` VALUES (49, 10, '其他', 'other', 1, NULL);
INSERT INTO `cms_select_options` VALUES (50, 11, '上线', 'online', 1, NULL);
INSERT INTO `cms_select_options` VALUES (51, 11, '下线', 'offline', 0, NULL);
INSERT INTO `cms_select_options` VALUES (52, 12, '文章', 'article', 0, NULL);
INSERT INTO `cms_select_options` VALUES (53, 12, '图片', 'image', 1, NULL);
INSERT INTO `cms_select_options` VALUES (54, 12, '下载', 'download', 2, NULL);
INSERT INTO `cms_select_options` VALUES (55, 12, '产品', 'product', 3, NULL);
INSERT INTO `cms_select_options` VALUES (56, 12, '招聘', 'employee', 4, NULL);
INSERT INTO `cms_select_options` VALUES (58, 13, '图片地址', 'imageUrl', 0, 'fileSelect');
INSERT INTO `cms_select_options` VALUES (59, 14, '下载地址', 'downloadUrl', 0, 'fileSelect');
INSERT INTO `cms_select_options` VALUES (60, 8, '单页', 'page', 11, NULL);
INSERT INTO `cms_select_options` VALUES (71, 18, '头部HTML', 'headHtml', 0, NULL);
INSERT INTO `cms_select_options` VALUES (72, 18, '底部HTML', 'footHtml', 100, NULL);
INSERT INTO `cms_select_options` VALUES (73, 18, '导航菜单', 'navgation', 0, NULL);
INSERT INTO `cms_select_options` VALUES (74, 18, '内容', 'content', 0, NULL);
INSERT INTO `cms_select_options` VALUES (75, 8, '公司简介', 'companyinfo', 10, NULL);
INSERT INTO `cms_select_options` VALUES (76, 8, '在线留言', 'message', 10, NULL);
INSERT INTO `cms_select_options` VALUES (77, 8, '在线反馈', 'feedback', 10, NULL);
INSERT INTO `cms_select_options` VALUES (78, 8, '共用片段', 'include', 10, NULL);
INSERT INTO `cms_select_options` VALUES (79, 8, '登入页面', 'login', 10, NULL);
INSERT INTO `cms_select_options` VALUES (80, 8, '注册页面', 'register', 10, NULL);
INSERT INTO `cms_select_options` VALUES (81, 16, '产品主图', 'product_image_main', 0, 'fileSelect');
INSERT INTO `cms_select_options` VALUES (84, 8, '网站地图', 'sitemap', 10, NULL);
INSERT INTO `cms_select_options` VALUES (116, 20, '首页', 'home', 0, NULL);
INSERT INTO `cms_select_options` VALUES (117, 20, '文章列表', 'articleList', 1, NULL);
INSERT INTO `cms_select_options` VALUES (118, 20, '文章详情', 'article', 2, NULL);
INSERT INTO `cms_select_options` VALUES (119, 20, '图片列表', 'imageList', 3, NULL);
INSERT INTO `cms_select_options` VALUES (120, 20, '图片详情', 'image', 4, NULL);
INSERT INTO `cms_select_options` VALUES (121, 20, '产品列表', 'productList', 5, NULL);
INSERT INTO `cms_select_options` VALUES (122, 20, '产品详情', 'product', 6, NULL);
INSERT INTO `cms_select_options` VALUES (123, 20, '下载列表', 'downloadList', 7, NULL);
INSERT INTO `cms_select_options` VALUES (124, 20, '下载详情', 'download', 8, NULL);
INSERT INTO `cms_select_options` VALUES (125, 20, '招聘列表', 'employeeList', 9, NULL);
INSERT INTO `cms_select_options` VALUES (126, 20, '招聘详情', 'employee', 10, NULL);
INSERT INTO `cms_select_options` VALUES (127, 20, '单页', 'page', 11, NULL);
INSERT INTO `cms_select_options` VALUES (128, 20, '公司简介', 'companyinfo', 10, NULL);
INSERT INTO `cms_select_options` VALUES (129, 20, '在线留言', 'message', 10, NULL);
INSERT INTO `cms_select_options` VALUES (130, 20, '在线反馈', 'feedback', 10, NULL);
INSERT INTO `cms_select_options` VALUES (131, 20, '共用片段', 'include', 10, NULL);
INSERT INTO `cms_select_options` VALUES (132, 20, '登入页面', 'login', 10, NULL);
INSERT INTO `cms_select_options` VALUES (133, 20, '注册页面', 'register', 10, NULL);
INSERT INTO `cms_select_options` VALUES (134, 20, '网站地图', 'sitemap', 10, NULL);
INSERT INTO `cms_select_options` VALUES (147, 21, '图片地址', 'imageUrl', 0, 'fileSelect');
INSERT INTO `cms_select_options` VALUES (159, 25, '首页', 'home', 0, NULL);
INSERT INTO `cms_select_options` VALUES (160, 25, '文章列表', 'articleList', 1, NULL);
INSERT INTO `cms_select_options` VALUES (161, 25, '文章详情', 'article', 2, NULL);
INSERT INTO `cms_select_options` VALUES (162, 25, '图片列表', 'imageList', 3, NULL);
INSERT INTO `cms_select_options` VALUES (163, 25, '图片详情', 'image', 4, NULL);
INSERT INTO `cms_select_options` VALUES (164, 25, '产品列表', 'productList', 5, NULL);
INSERT INTO `cms_select_options` VALUES (165, 25, '产品详情', 'product', 6, NULL);
INSERT INTO `cms_select_options` VALUES (166, 25, '下载列表', 'downloadList', 7, NULL);
INSERT INTO `cms_select_options` VALUES (167, 25, '下载详情', 'download', 8, NULL);
INSERT INTO `cms_select_options` VALUES (168, 25, '招聘列表', 'employeeList', 9, NULL);
INSERT INTO `cms_select_options` VALUES (169, 25, '招聘详情', 'employee', 10, NULL);
INSERT INTO `cms_select_options` VALUES (170, 25, '单页', 'page', 11, NULL);
INSERT INTO `cms_select_options` VALUES (171, 25, '公司简介', 'companyinfo', 10, NULL);
INSERT INTO `cms_select_options` VALUES (172, 25, '在线留言', 'message', 10, NULL);
INSERT INTO `cms_select_options` VALUES (173, 25, '在线反馈', 'feedback', 10, NULL);
INSERT INTO `cms_select_options` VALUES (174, 25, '共用片段', 'include', 10, NULL);
INSERT INTO `cms_select_options` VALUES (175, 25, '登入页面', 'login', 10, NULL);
INSERT INTO `cms_select_options` VALUES (176, 25, '注册页面', 'register', 10, NULL);
INSERT INTO `cms_select_options` VALUES (177, 25, '网站地图', 'sitemap', 10, NULL);
INSERT INTO `cms_select_options` VALUES (193, 23, '页面片段', 'pagePiece', 0, NULL);
INSERT INTO `cms_select_options` VALUES (194, 23, '页面META', 'pageMeta', 0, NULL);

-- ----------------------------
-- Table structure for cms_theme
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme`;
CREATE TABLE `cms_theme`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `themeKey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NULL,
  `updatetime` datetime(0) NOT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT 0,
  `isEdit` tinyint(255) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `THEME_KEY`(`themeKey`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme
-- ----------------------------
INSERT INTO `cms_theme` VALUES (29, '基础版本', 'basic', '2019-08-03 17:36:11', '2020-01-28 13:05:54', 0, 1);

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
  `fragmentType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `properties` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 23 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_fragment
-- ----------------------------
INSERT INTO `cms_theme_fragment` VALUES (17, 29, '我们的服务', '2020-03-03 19:13:10', '2020-03-03 19:32:56', 'pagePiece', '<root>\r\n 	<content>\r\n  <![CDATA[\r\n  <section class=\"page-section\" id=\"services\">\r\n    <div class=\"container\">\r\n        <h2 class=\"text-center mt-0\">我们的服务</h2>\r\n        <hr class=\"divider my-4\">\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-gem text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">优质的主题</h3>\r\n                    <p class=\"text-muted mb-0\">应用市场提供多种行业所需的优质主题</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-laptop-code text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">永久更新</h3>\r\n                    <p class=\"text-muted mb-0\">开源代码库始终可开发进行中的代码保持一致</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-globe text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">快速改版</h3>\r\n                    <p class=\"text-muted mb-0\">可以通过后台主题模板编辑快速修改页面内容</p>\r\n                </div>\r\n            </div>\r\n            <div class=\"col-lg-3 col-md-6 text-center\">\r\n                <div class=\"mt-5\">\r\n                    <i class=\"fas fa-4x fa-heart text-primary mb-4\"></i>\r\n                    <h3 class=\"h4 mb-2\">按需定制</h3>\r\n                    <p class=\"text-muted mb-0\">如果你有特殊需求，可以根据你的需求进行定制</p>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n  ]]>\r\n  	</content>\r\n </root>');
INSERT INTO `cms_theme_fragment` VALUES (18, 29, '案例欣赏', '2020-03-03 19:34:50', '2020-03-03 21:53:29', 'pagePiece', '<root>\r\n 	<content>\r\n  <![CDATA[\r\n  <section id=\"portfolio\">\r\n    <div class=\"container-fluid p-0\">\r\n        <div class=\"row no-gutters\">\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/1.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/1.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                           项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/2.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/2.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                           项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/3.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/3.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                           项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/4.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/4.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                       <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                           项目名称\r\n                        </div>>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/5.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/5.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                           项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n            <div class=\"col-lg-4 col-sm-6\">\r\n                <a class=\"portfolio-box\" href=\"themes/basic/img/portfolio/fullsize/6.jpg\">\r\n                    <img class=\"img-fluid\" src=\"themes/basic/img/portfolio/thumbnails/6.jpg\" alt=\"\">\r\n                    <div class=\"portfolio-box-caption p-3\">\r\n                        <div class=\"project-category text-white-50\">\r\n                            分类\r\n                        </div>\r\n                        <div class=\"project-name\">\r\n                           项目名称\r\n                        </div>\r\n                    </div>\r\n                </a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n  ]]>\r\n  	</content>\r\n </root>');
INSERT INTO `cms_theme_fragment` VALUES (19, 29, '免费获取', '2020-03-03 19:35:31', '2020-03-03 19:35:56', 'pagePiece', '<root>\r\n 	<content>\r\n  <![CDATA[\r\n  <section class=\"page-section bg-dark text-white\">\r\n    <div class=\"container text-center\">\r\n        <h2 class=\"mb-4\">免费获取</h2>\r\n        <a class=\"btn btn-light btn-xl\" href=\"http://www.ranko.cn/opensource-2.html\">立即下载</a>\r\n    </div>\r\n</section>\r\n  ]]>\r\n  	</content>\r\n </root>');
INSERT INTO `cms_theme_fragment` VALUES (20, 29, '联系我们', '2020-03-03 19:36:08', '2020-03-03 19:36:29', 'pagePiece', '<root>\r\n 	<content>\r\n  <![CDATA[\r\n  <section class=\"page-section\" id=\"contact\">\r\n    <div class=\"container\">\r\n        <div class=\"row justify-content-center\">\r\n            <div class=\"col-lg-8 text-center\">\r\n                <h2 class=\"mt-0\">联系我们</h2>\r\n                <hr class=\"divider my-4\">\r\n                <p class=\"text-muted mb-5\">你是否准备创建自己的网站？想了解更多关于RKCMS的信息，你可以通过电话、邮箱联系我们，我们\r\n                    将尽快给予回复！</p>\r\n            </div>\r\n        </div>\r\n        <div class=\"row\">\r\n            <div class=\"col-lg-4 ml-auto text-center mb-5 mb-lg-0\">\r\n                <i class=\"fas fa-phone fa-3x mb-3 text-muted\"></i>\r\n                <div>+86 18068252703</div>\r\n            </div>\r\n            <div class=\"col-lg-4 mr-auto text-center\">\r\n                <i class=\"fas fa-envelope fa-3x mb-3 text-muted\"></i>\r\n                <a class=\"d-block\" href=\"mailto:458820281@qq.com\">458820281@qq.com</a>\r\n            </div>\r\n        </div>\r\n    </div>\r\n</section>\r\n  ]]>\r\n  	</content>\r\n </root>');
INSERT INTO `cms_theme_fragment` VALUES (21, 29, '首页META', '2020-03-03 21:48:06', '2020-03-03 21:48:06', 'pageMeta', '<root>\r\n<meta_title>RKCMS - Powered by ranko.cn</meta_title>\r\n<meta_keywords>RKCMS,无锡蓝科，蓝科创想</meta_keywords>\r\n<meta_description>无锡蓝科创想科技有限公司</meta_description>\r\n</root>  ');

-- ----------------------------
-- Table structure for cms_theme_layout
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme_layout`;
CREATE TABLE `cms_theme_layout`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layoutName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `layoutText` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `themeId` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 20 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_layout
-- ----------------------------
INSERT INTO `cms_theme_layout` VALUES (11, '布局', '<!DOCTYPE html>\r\n<html>\r\n\r\n<head>\r\n\r\n    <meta charset=\"utf-8\">\r\n    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1, shrink-to-fit=no\">\r\n    <meta name=\"keywords\" content=\"<?php echo $this->context->data[\'meta_keywords\']; ?>\">\r\n    <meta name=\"description\" content=\"<?php echo $this->context->data[\'meta_description\']; ?>\">\r\n\r\n    <title><?php echo $this->context->data[\'meta_title\']; ?> - Powered by ranko.cn </title>\r\n\r\n    <!-- Font Awesome Icons -->\r\n    <link href=\"themes/basic/vendor/fontawesome-free/css/all.min.css\" rel=\"stylesheet\" type=\"text/css\">\r\n\r\n    <!-- Plugin CSS -->\r\n    <link href=\"themes/basic/vendor/magnific-popup/magnific-popup.css\" rel=\"stylesheet\">\r\n\r\n    <!-- Theme CSS - Includes Bootstrap -->\r\n    <link href=\"themes/basic/css/creative.css\" rel=\"stylesheet\">\r\n\r\n</head>\r\n\r\n<body id=\"page-top\">\r\n\r\n<?php echo $content ?>\r\n\r\n<!-- Footer -->\r\n<footer class=\"bg-light py-5\">\r\n    <div class=\"container\">\r\n        <div class=\"small text-center text-muted\">版权所有 &copy; <?php echo date(\'Y\'); ?> - 无锡市蓝科创想科技有限公司</div>\r\n    </div>\r\n</footer>\r\n\r\n<!-- Bootstrap core JavaScript -->\r\n<script src=\"themes/basic/vendor/jquery/jquery.min.js\"></script>\r\n<script src=\"themes/basic/vendor/bootstrap/js/bootstrap.bundle.min.js\"></script>\r\n\r\n<!-- Plugin JavaScript -->\r\n<script src=\"themes/basic/vendor/jquery-easing/jquery.easing.min.js\"></script>\r\n<script src=\"themes/basic/vendor/magnific-popup/jquery.magnific-popup.min.js\"></script>\r\n\r\n<!-- Custom scripts for this template -->\r\n<script src=\"themes/basic/js/creative.min.js\"></script>\r\n\r\n</body>\r\n\r\n</html>\r\n', '2019-10-02 17:33:34', '2020-01-18 17:28:05', 29);

-- ----------------------------
-- Table structure for cms_theme_page
-- ----------------------------
DROP TABLE IF EXISTS `cms_theme_page`;
CREATE TABLE `cms_theme_page`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `themeId` int(11) NULL DEFAULT NULL,
  `pageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `pageText` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `pageType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `isDefault` tinyint(4) NOT NULL DEFAULT 0,
  `layoutId` int(11) NOT NULL,
  `widgetjson` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 69 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_page
-- ----------------------------
INSERT INTO `cms_theme_page` VALUES (31, 29, '首页演示页面', '<?php\r\n$widgetjson = $page[\'widgetjson\'];\r\n$widgetObject = json_decode($widgetjson,true);\r\n\r\n$layout = $page[\'layout\'];\r\n$layoutList = explode(\",\",$layout);\r\n\r\n$index = 0;\r\nforeach ($layoutList as $item){\r\n    ?>\r\n    <div class=\"col-lg-<?php echo $item; ?>\">\r\n        <?php\r\n        if(isset($widgetObject[$index])){\r\n            foreach ($widgetObject[$index] as $widgetId){\r\n                echo $this->context->widget($widgetId);\r\n            }\r\n        }\r\n        ?>\r\n    </div>\r\n    <?php\r\n    $index ++;\r\n}\r\n\r\n?>\r\n\r\n\r\n', '2019-10-11 16:24:37', '2020-03-03 21:48:21', 'home', 1, 11, '[\"17\",\"18\",\"19\",\"20\",\"21\"]');

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
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `themeid` int(11) NULL DEFAULT NULL,
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for plugin_message
-- ----------------------------
DROP TABLE IF EXISTS `plugin_message`;
CREATE TABLE `plugin_message`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `username` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `content` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updatetime` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '0' COMMENT '状态:0:未生效,1:有效',
  `reply` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '回复的内容',
  `themeid` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

SET FOREIGN_KEY_CHECKS = 1;
