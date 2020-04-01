<?php
$widgetJson = $this->context->data['CMS_LAYOUT']['widgetjson'];
$widgetObject = json_decode($widgetJson,true);
?>
<!DOCTYPE html>
<html>
<head>
    <?php
    if(isset($widgetObject['header'])){
        foreach ($widgetObject['header'] as $id){
            echo $this->context->renderFragment($id);
        }
    }
    if($this->context->data['REVIEW']==1){
        ?>
        <style>
            html{
                overflow-y: scroll !important;
            }
            ::-webkit-scrollbar {/*滚动条整体样式*/
                width: 4px;     /*高宽分别对应横竖滚动条的尺寸*/
                height: 4px;
            }
            ::-webkit-scrollbar-thumb {/*滚动条里面小方块*/
                border-radius: 5px;
                -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
                background: rgba(0,0,0,0.2);
            }
            ::-webkit-scrollbar-track {/*滚动条里面轨道*/
                -webkit-box-shadow: inset 0 0 5px rgba(0,0,0,0.2);
                border-radius: 0;
                background: rgba(0,0,0,0.1);
            }
        </style>
        <?php
    }
    ?>
</head>

<body>
<?php
if(isset($widgetObject['top'])){
    foreach ($widgetObject['top'] as $id){
        echo $this->context->renderFragment($id);
    }
}
if($this->context->data['REVIEW']==1){
    ?>
    <div id="fragment-content"></div>
    <?php
}else{
    echo $content;
}

if(isset($widgetObject['footer'])){
    foreach ($widgetObject['footer'] as $id){
        echo $this->context->renderFragment($id);
    }
}
?>
</body>

</html>
