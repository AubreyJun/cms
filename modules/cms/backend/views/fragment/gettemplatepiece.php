<div class="editor-border" id="fragment-<?php echo $widget; ?>">
    <div class="btn-group " style="position: absolute;right: 0px;z-index: 99;" id="editor-content-tools-<?php echo $widget; ?>"  >
        <button type="button" class="btn btn-primary " onclick="loadEditor(<?php echo $widget; ?>)"><i class="fa fa-pencil-square-o"></i></button>
        <button type="button" class="btn btn-info" onclick="loadWidget(<?php echo $widget; ?>)" ><i class="fa fa-plug"></i></button>
        <button type="button" class="btn btn-success widget-handle"><i class="fa fa-arrows"></i></button>
        <button type="button" class="btn btn-danger" onclick="delFragment(<?php echo $widget; ?>)"><i class="fa fa-trash"></i></button>
    </div>
    <div class="editor-content-view" id="editor-content-view-<?php echo $widget; ?>"  >
        <?php
        echo $body;
        ?>
    </div>
    <div class="editor-content-body" id="editor-content-body-<?php echo $widget; ?>" >
        <div  id="editor-<?php echo $widget; ?>" >
            <?php
            echo $body;
            ?>
        </div>
    </div>
</div>