<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson, true);

$layoutObject = $this->context->data['CMS_LAYOUT'];

$editabled = false;
if (isset($this->context->data['EDITABLED']) && $this->context->data['EDITABLED'] == 1) {
    $editabled = true;
}
?>
<!DOCTYPE html>
<html dir="ltr">
<head>

    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>

    <!-- Stylesheets
    ============================================= -->
    <link rel="stylesheet" href="static/frontend/css/bootstrap.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/style.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/swiper.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/dark.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/font-icons.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/animate.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/magnific-popup.css" type="text/css"/>

    <link rel="stylesheet" href="static/frontend/css/responsive.css" type="text/css"/>
    <link rel="stylesheet" href="static/frontend/css/responsive-rtl.css" type="text/css"/>

    <link rel="stylesheet" href="static/frontend/css/lib/font-awesome/css/font-awesome.min.css" type="text/css"/>

    <?php
    if ($editabled) {
        ?>
        <link rel="stylesheet" href="static/frontend_custom/css/editor.css" type="text/css"/>
        <?php
    }
    ?>

    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <!--[if lt IE 9]>
    <script src="https://cdn.bootcss.com/livingston-css3-mediaqueries-js/1.0.0/css3-mediaqueries.min.js"></script>
    <![endif]-->

    <meta name="keywords" content="<?php echo $this->context->data['meta_keywords']; ?>">
    <meta name="description" content="<?php echo $this->context->data['meta_description']; ?>">

    <title><?php echo $this->context->data['meta_title']; ?> - Powered by ranko.cn </title>
    <?php
    if (isset($widgetObject['header'])) {
        foreach ($widgetObject['header'] as $id) {
            echo $this->context->renderFragment($id);
        }
    }
    ?>
</head>

<body class="stretched">
<div id="wrapper" class="clearfix" >
    <header id="header" class="full-header">
        <?php
        if (isset($widgetObject['top'])) {
            foreach ($widgetObject['top'] as $widget) {
                $wObject = \app\models\cms\backend\BKFragment::findOne($widget);
                $cmsFragment = $this->context->query("select * from cms_fragment where fragmentKey = :fragmentKey")
                    ->bindParam(":fragmentKey", $wObject['fragmentType'])->queryOne();
                ?>
                <div class="editor-border" id="fragment-<?php echo $widget; ?>">
                    <div class="btn-group " style="position: absolute;right: 0px;z-index: 99;"
                         id="editor-content-tools-<?php echo $widget; ?>">
                        <?php
                        if ($cmsFragment['script'] == 'html') {
                            ?>
                            <button type="button" class="btn btn-primary "
                                    onclick="loadEditor(<?php echo $widget; ?>)"><i
                                        class="fa fa-pencil-square-o"></i></button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-info" onclick="loadWidget(<?php echo $widget; ?>)"><i
                                    class="fa fa-plug"></i></button>
                        <button type="button" class="btn btn-success widget-handle"><i class="fa fa-arrows"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="delFragment(<?php echo $widget; ?>)">
                            <i class="fa fa-trash"></i></button>
                    </div>
                    <div class="editor-content-view" id="editor-content-view-<?php echo $widget; ?>">
                        <?php
                        $html = $this->context->renderFragment($widget);
                        echo $html;
                        ?>
                    </div>
                    <div class="editor-content-body" id="editor-content-body-<?php echo $widget; ?>">
                        <div id="editor-<?php echo $widget; ?>">
                            <?php
                            echo $html;
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </header>
    <?php
    echo $content;
    ?>
    <footer id="footer">
        <?php
        if (isset($widgetObject['footer'])) {
            foreach ($widgetObject['footer'] as $widget) {
                $wObject = \app\models\cms\backend\BKFragment::findOne($widget);
                $cmsFragment = $this->context->query("select * from cms_fragment where fragmentKey = :fragmentKey")
                    ->bindParam(":fragmentKey", $wObject['fragmentType'])->queryOne();
                ?>
                <div class="editor-border" id="fragment-<?php echo $widget; ?>">
                    <div class="btn-group " style="position: absolute;right: 0px;z-index: 99;"
                         id="editor-content-tools-<?php echo $widget; ?>">
                        <?php
                        if ($cmsFragment['script'] == 'html') {
                            ?>
                            <button type="button" class="btn btn-primary "
                                    onclick="loadEditor(<?php echo $widget; ?>)"><i
                                        class="fa fa-pencil-square-o"></i></button>
                            <?php
                        }
                        ?>
                        <button type="button" class="btn btn-info" onclick="loadWidget(<?php echo $widget; ?>)"><i
                                    class="fa fa-plug"></i></button>
                        <button type="button" class="btn btn-success widget-handle"><i class="fa fa-arrows"></i>
                        </button>
                        <button type="button" class="btn btn-danger" onclick="delFragment(<?php echo $widget; ?>)">
                            <i class="fa fa-trash"></i></button>
                    </div>
                    <div class="editor-content-view" id="editor-content-view-<?php echo $widget; ?>">
                        <?php
                        $html = $this->context->renderFragment($widget);
                        echo $html;
                        ?>
                    </div>
                    <div class="editor-content-body" id="editor-content-body-<?php echo $widget; ?>">
                        <div id="editor-<?php echo $widget; ?>">
                            <?php
                            echo $html;
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </footer>
</div>
<!-- Go To Top
============================================= -->
<div id="gotoTop" class="icon-angle-up"></div>
<!-- External JavaScripts
============================================= -->
<script src="static/frontend/js/jquery.js"></script>
<script src="static/frontend/js/plugins.js"></script>

<!-- Footer Scripts
============================================= -->
<script src="static/frontend/js/functions.js"></script>
<?php
if ($editabled) {
    ?>
    <div id="dialog-template" style="display: none;">
        <div class="form-group">
            <label>
                片段模板
            </label>
            <select id="widget-template" class="form-control ">
                <option value="0">无</option>
                <?php
                foreach ($this->context->data['fragmentTypes'] as $fragmentType) {
                    ?>
                    <optgroup label="<?php echo $fragmentType['object']['optionDesc']; ?>">
                        <?php
                        if (sizeof($fragmentType['list']) > 0) {
                            foreach ($fragmentType['list'] as $item) {
                                ?>
                                <option value="<?php echo $item['fragmentKey']; ?>"><?php echo $item['fragmentName']; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </optgroup>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <script src="static/frontend_custom/lib/sortable/Sortable.min.js"></script>
    <script src="static/frontend_custom/lib/artdialog/dist/dialog-plus.js"></script>
    <link href="static/backend/lib/jodit/jodit.min.css" rel="stylesheet">
    <script src="static/backend/lib/jodit/jodit.min.js"></script>
    <script>

        var dialogModel = null;
        var currentId = null;

        $(function () {

            var footer = document.getElementById('footer');
            new Sortable(footer, {
                handle: '.widget-handle',
                animation: 150
            });

            var header = document.getElementById('header');
            new Sortable(header, {
                handle: '.widget-handle',
                animation: 150
            });


        });

        function loadEditor(widget) {
            $("#editor-content-view-" + widget).hide();
            $("#editor-content-body-" + widget).show();
            newEditor(widget);
        }

        function loadWidget(id) {
            var dialogTemplate = document.getElementById('dialog-template');
            dialogModel = dialog({
                title: '选择组件',
                content: dialogTemplate,
                button: [
                    {
                        value: '新增',
                        callback: function () {
                            var widgetKey = $("#widget-template").val();
                            loadTemplate(widgetKey);
                            return false;
                        },
                        autofocus: true
                    },
                    {
                        value: '替换',
                        callback: function () {
                            return false;
                        }
                    }
                ]
            }).width(500).height(305);
            dialogModel.showModal();
            currentId = id;
        }

        function newEditor(widgetId) {
            if (!Jodit.instances["editor-" + widgetId]) {
                Object.keys(Jodit.instances).forEach(function (id) {
                    Jodit.instances[id].destruct();
                });
                var editor = new Jodit("#editor-" + widgetId, {
                    // "preset": "inline",
                    language: 'zh_cn',
                    uploader: {
                        url: 'static/backend/lib/jodit/connector/index.php?action=fileUpload'
                    },
                    filebrowser: {
                        ajax: {
                            url: 'static/backend/lib/jodit/connector/index.php'
                        }
                    },
                    buttons: Jodit.defaultOptions.buttons.concat([{
                        name: 'save',
                        icon: 'save',
                        exec: function (editor) {
                            $("#editor-content-view-" + widgetId).show();
                            $("#editor-content-body-" + widgetId).hide();

                            var editValue = editor.value;
                            $("#editor-content-view-" + widgetId).html(editValue);
                            $("#editor-" + widgetId).html(editValue);

                            //saveFragment

                        }
                    }]),
                    cleanHTML: {
                        "timeout": 300,
                        "removeEmptyElements": false,
                        "fillEmptyParagraph": false,
                        "replaceNBSP": false,
                        "replaceOldTags": {
                            "i": "em",
                            "b": "strong"
                        },
                        "allowTags": false,
                        "denyTags": false
                    }

                });
            }

        }

        function delFragment(widgetId) {
            $("#fragment-" + widgetId).remove();
        }

        function loadTemplate(fragmentKey) {
            if (fragmentKey != '0') {
                $.post('index.php?r=cms-backend/layout/gettemplatepiece', {
                    'fragmentKey': fragmentKey,
                    'fragmentid': currentId,
                    'layoutId':<?php echo $layoutObject['id']; ?>,
                    '_csrf': '<?= Yii::$app->request->csrfToken ?>'
                }, function (data) {
                    $("#fragment-" + currentId).after(data.html);

                    $("#editor-content-view-" + data.id).show();
                    $("#editor-content-body-" + data.id).hide();

                }, 'json');
            }
        }
    </script>
    <?php
}
?>
</body>

</html>
