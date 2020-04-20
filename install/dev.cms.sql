
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
INSERT INTO `cms_admin` VALUES (2, 'ranko', '21232f297a57a5a743894a0e4a801fc3', '2020-01-09 13:15:42', '2020-04-03 15:51:03');

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
) ENGINE = InnoDB AUTO_INCREMENT = 135 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

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
) ENGINE = InnoDB AUTO_INCREMENT = 43 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_config
-- ----------------------------
INSERT INTO `cms_config` VALUES (38, 'themeColor', '0000FF', '2020-02-09 14:07:20', '2020-02-09 14:11:20', '网站主色调', 'basic', 40);

-- ----------------------------
-- Table structure for cms_fragment
-- ----------------------------
DROP TABLE IF EXISTS `cms_fragment`;
CREATE TABLE `cms_fragment`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fragmentName` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `fragmentKey` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `createtime` datetime(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  `updatetime` datetime(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  `fragmentType` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sequencenumber` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_fragmentkey`(`fragmentKey`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 27 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_fragment
-- ----------------------------
INSERT INTO `cms_fragment` VALUES (1, '页面内容块_开始', 'common_pagecontent_start', '2020-04-11 14:24:10', '2020-04-17 10:32:56', 'common', 0);
INSERT INTO `cms_fragment` VALUES (2, '页面内容块_结束', 'common_pagecontent_end', '2020-04-11 14:24:20', '2020-04-17 10:33:37', 'common', 0);
INSERT INTO `cms_fragment` VALUES (3, '通用浅色', 'navgation_common_light', '2020-04-11 15:16:27', '2020-04-17 10:33:37', 'navgation', 0);
INSERT INTO `cms_fragment` VALUES (4, '最近更新的文章', 'article_content_recent', '2020-04-11 15:25:12', '2020-04-17 10:33:37', 'article_content', 0);
INSERT INTO `cms_fragment` VALUES (5, '文章内容页面', 'article_content_info', '2020-04-11 19:29:37', '2020-04-17 10:33:37', 'article_content', 0);
INSERT INTO `cms_fragment` VALUES (6, '文章列表页面', 'article_content_list', '2020-04-11 19:31:29', '2020-04-17 10:33:37', 'article_content', 0);
INSERT INTO `cms_fragment` VALUES (7, '三栏', 'team_3', '2020-04-11 19:34:33', '2020-04-17 10:33:37', 'team', 0);
INSERT INTO `cms_fragment` VALUES (8, '常规', 'page_titles_common', '2020-04-11 19:44:58', '2020-04-17 10:14:27', 'page_titles', 0);
INSERT INTO `cms_fragment` VALUES (9, '设置META', 'common_pagecontent_setmeta', '2020-04-11 19:46:22', '2020-04-17 10:33:37', 'common', 1);
INSERT INTO `cms_fragment` VALUES (10, '设置META_文章', 'common_pagecontent_setmeta_article', '2020-04-11 19:47:31', '2020-04-17 10:33:37', 'common', 1);
INSERT INTO `cms_fragment` VALUES (11, '客户图标滚动', 'client_scroll', '2020-04-11 19:51:45', '2020-04-17 10:33:37', 'client', 0);
INSERT INTO `cms_fragment` VALUES (12, '常规幻灯片_文字居中', 'silders_common', '2020-04-11 19:56:31', '2020-04-17 10:00:27', 'silders', 0);
INSERT INTO `cms_fragment` VALUES (13, 'QQ地图', 'map_qq', '2020-04-11 20:00:09', '2020-04-17 10:33:37', 'map', 0);
INSERT INTO `cms_fragment` VALUES (14, '推荐栏', 'promo_box', '2020-04-11 20:01:48', '2020-04-17 10:14:22', 'promo', 0);
INSERT INTO `cms_fragment` VALUES (15, '图标盒子', 'iconbox_4_centered', '2020-04-11 20:03:30', '2020-04-17 10:33:37', 'iconbox', 0);
INSERT INTO `cms_fragment` VALUES (16, '图片盒子3栏', 'imagelist_3', '2020-04-11 20:07:59', '2020-04-17 10:33:37', 'imagelist', 0);
INSERT INTO `cms_fragment` VALUES (17, '图片盒子4栏', 'imagelist_4', '2020-04-11 20:11:24', '2020-04-17 10:33:37', 'imagelist', 0);
INSERT INTO `cms_fragment` VALUES (18, '查询更新的图片', 'imagelist_recent', '2020-04-11 20:11:47', '2020-04-17 10:33:37', 'imagelist', 0);
INSERT INTO `cms_fragment` VALUES (19, '常规', 'footer_common', '2020-04-11 20:32:42', '2020-04-17 10:33:37', 'footer', 0);
INSERT INTO `cms_fragment` VALUES (20, '三栏数据统计', 'counter_3', '2020-04-11 20:34:48', '2020-04-17 10:33:37', 'counter', 0);
INSERT INTO `cms_fragment` VALUES (21, '左侧内容块', 'contentBlock_left', '2020-04-11 20:39:50', '2020-04-17 10:33:37', 'contentBlock', 0);
INSERT INTO `cms_fragment` VALUES (22, '右侧内容块', 'contentBlock_right', '2020-04-11 20:42:08', '2020-04-17 10:33:37', 'contentBlock', 0);
INSERT INTO `cms_fragment` VALUES (23, '页面内容标题', 'heading_center', '2020-04-11 20:44:57', '2020-04-16 19:43:17', 'heading', 0);
INSERT INTO `cms_fragment` VALUES (24, '分类图片过滤', 'imageblock_filter', '2020-04-13 14:53:50', '2020-04-17 10:33:37', 'imageblock', 0);
INSERT INTO `cms_fragment` VALUES (26, '砖石块布局', 'imageblock_masonry', '2020-04-13 14:55:14', '2020-04-17 10:33:37', 'imageblock', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 224 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 207 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for cms_post_tag
-- ----------------------------
DROP TABLE IF EXISTS `cms_post_tag`;
CREATE TABLE `cms_post_tag`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `postId` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 274 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

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
) ENGINE = InnoDB AUTO_INCREMENT = 32 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_select
-- ----------------------------
INSERT INTO `cms_select` VALUES (11, 'articleStatus', 0);
INSERT INTO `cms_select` VALUES (19, 'article_properties', 0);
INSERT INTO `cms_select` VALUES (12, 'content_type', 0);
INSERT INTO `cms_select` VALUES (14, 'download_properties', 0);
INSERT INTO `cms_select` VALUES (31, 'fragment_type', 0);
INSERT INTO `cms_select` VALUES (13, 'image_properties', 0);
INSERT INTO `cms_select` VALUES (16, 'product_properties', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 246 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_select_options
-- ----------------------------
INSERT INTO `cms_select_options` VALUES (50, 11, '上线', 'online', 1);
INSERT INTO `cms_select_options` VALUES (51, 11, '下线', 'offline', 0);
INSERT INTO `cms_select_options` VALUES (52, 12, '文章', 'article', 0);
INSERT INTO `cms_select_options` VALUES (53, 12, '图片', 'image', 1);
INSERT INTO `cms_select_options` VALUES (54, 12, '下载', 'download', 2);
INSERT INTO `cms_select_options` VALUES (55, 12, '产品', 'product', 3);
INSERT INTO `cms_select_options` VALUES (56, 12, '招聘', 'employee', 4);
INSERT INTO `cms_select_options` VALUES (58, 13, '图片地址', 'image_url,selectImage', 0);
INSERT INTO `cms_select_options` VALUES (59, 14, '下载地址', 'download_url,selectFile', 0);
INSERT INTO `cms_select_options` VALUES (81, 16, '产品主图', 'product_image_main,selectImage', 0);
INSERT INTO `cms_select_options` VALUES (229, 31, '通用', 'common', 0);
INSERT INTO `cms_select_options` VALUES (230, 31, '导航菜单', 'navgation', 1);
INSERT INTO `cms_select_options` VALUES (231, 31, '幻灯片', 'silders', 2);
INSERT INTO `cms_select_options` VALUES (232, 31, '页面标题', 'page_titles', 3);
INSERT INTO `cms_select_options` VALUES (233, 31, '联系表单', 'contact_form', 4);
INSERT INTO `cms_select_options` VALUES (234, 31, '底部面板', 'footer', 5);
INSERT INTO `cms_select_options` VALUES (235, 31, '文章内容', 'article_content', 6);
INSERT INTO `cms_select_options` VALUES (236, 31, '团队信息', 'team', 7);
INSERT INTO `cms_select_options` VALUES (237, 31, '客户', 'client', 8);
INSERT INTO `cms_select_options` VALUES (238, 31, '地图', 'map', 0);
INSERT INTO `cms_select_options` VALUES (239, 31, '推荐栏', 'promo', 0);
INSERT INTO `cms_select_options` VALUES (240, 31, '图标盒', 'iconbox', 0);
INSERT INTO `cms_select_options` VALUES (241, 31, '图片盒子', 'imagelist', 0);
INSERT INTO `cms_select_options` VALUES (242, 31, '数据统计', 'counter', 0);
INSERT INTO `cms_select_options` VALUES (243, 31, '内容块', 'contentBlock', 0);
INSERT INTO `cms_select_options` VALUES (244, 31, '标题', 'heading', 0);
INSERT INTO `cms_select_options` VALUES (245, 31, '图片展示', 'imageblock', 0);

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
) ENGINE = InnoDB AUTO_INCREMENT = 53 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme
-- ----------------------------
INSERT INTO `cms_theme` VALUES (44, 'Hello World !', '2020-03-09 09:37:05', '2020-04-20 13:51:51', 1, 1);

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
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 289 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_fragment
-- ----------------------------
INSERT INTO `cms_theme_fragment` VALUES (114, 44, '共用_底部引入', '2020-03-26 19:28:34', '2020-03-28 13:17:39');
INSERT INTO `cms_theme_fragment` VALUES (115, 44, '共用_版权所有', '2020-03-26 19:29:34', '2020-03-26 19:29:34');
INSERT INTO `cms_theme_fragment` VALUES (116, 44, '共用_HEADER', '2020-03-26 19:30:45', '2020-03-26 19:30:45');
INSERT INTO `cms_theme_fragment` VALUES (117, 44, '共用_导航片段', '2020-03-26 19:50:54', '2020-04-04 11:18:08');
INSERT INTO `cms_theme_fragment` VALUES (118, 44, '首页_RKCMS介绍', '2020-03-26 19:52:08', '2020-03-26 19:52:08');
INSERT INTO `cms_theme_fragment` VALUES (119, 44, '首页_提供你想要的服务', '2020-03-28 12:55:30', '2020-03-28 12:55:30');
INSERT INTO `cms_theme_fragment` VALUES (120, 44, '首页_我们的服务', '2020-03-28 12:58:22', '2020-03-30 11:30:13');
INSERT INTO `cms_theme_fragment` VALUES (121, 44, '首页_案例', '2020-03-28 12:58:44', '2020-03-28 13:07:01');
INSERT INTO `cms_theme_fragment` VALUES (122, 44, '首页_免费获取', '2020-03-28 12:59:08', '2020-03-30 11:19:44');
INSERT INTO `cms_theme_fragment` VALUES (123, 44, '首页_联系我们', '2020-03-28 12:59:28', '2020-03-28 12:59:28');
INSERT INTO `cms_theme_fragment` VALUES (124, 44, '首页_META', '2020-03-28 13:14:16', '2020-03-28 13:14:16');

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
) ENGINE = InnoDB AUTO_INCREMENT = 33 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_layout
-- ----------------------------
INSERT INTO `cms_theme_layout` VALUES (20, '布局', '2020-03-09 09:43:44', '2020-04-01 15:55:14', 44, '{\"header\":[\"116\"],\"top\":[\"117\"],\"footer\":[\"115\",\"114\"]}');
INSERT INTO `cms_theme_layout` VALUES (22, '预览布局', '2020-04-01 15:55:07', '2020-04-03 17:22:24', 44, '{\"header\":[\"116\"],\"top\":[],\"footer\":[\"114\"]}');

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
  `pagePath` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `layoutId` int(11) NOT NULL,
  `widgetjson` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 115 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of cms_theme_page
-- ----------------------------
INSERT INTO `cms_theme_page` VALUES (69, 44, '首页', '2020-03-09 10:00:43', '2020-03-30 11:03:55', 'home', 20, '[\"124\",\"118\",\"119\",\"120\",\"121\",\"122\",\"123\"]');

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
  `phone` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of plugin_feedback
-- ----------------------------
INSERT INTO `plugin_feedback` VALUES (1, '张三', 'zhujun@ranko.cn', 'hello world', 'hello world', '2020-02-24 10:07:54', NULL, 44, NULL);

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
