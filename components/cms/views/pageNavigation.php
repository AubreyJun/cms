<?php
function getLink($navObject){
    if($navObject['navigationType']=='link'){
        return $navObject['link'];
    }else{
        return $navObject['navigationType'].'-'.$navObject['navigationRel'].'.html';
    }
}
function echoNavigation($navigation)
{
    foreach ($navigation as $nav) {
        if (isset($nav['children'])) {
            ?>
            <li><a href="<?php echo getLink($nav['object']); ?>" >
                    <div><?php echo $nav['object']['catalogName']; ?></div>
                </a>
                <ul>
                    <?php echoNavigation($nav['children']); ?>
                </ul>
            </li>
            <?php
        } else {
            ?>
            <li><a href="<?php echo getLink($nav['object']); ?>"">
                    <div><?php echo $nav['object']['catalogName']; ?></div>
                </a></li>
            <?php
        }

    }
}
if ($style['pvalue'] == 'common') {
    ?>
    <div class="container clearfix">

        <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

        <!-- Logo
        ============================================= -->
        <div id="logo">
            <a href="index.html" class="standard-logo" data-dark-logo="<?php echo $logo1['pvalue']; ?>"><img
                        src="<?php echo $logo1['pvalue']; ?>" alt="<?php echo $title['pvalue']; ?>"></a>
            <a href="index.html" class="retina-logo" data-dark-logo="<?php echo $logo2['pvalue']; ?>"><img
                        src="<?php echo $logo2['pvalue']; ?>" alt="<?php echo $title['pvalue']; ?>"></a>
        </div>
        <!-- #logo end -->

        <!-- Primary Navigation
        ============================================= -->
        <nav id="primary-menu">

            <ul class="sf-js-enabled" style="touch-action: pan-y;">
                <?php
                echoNavigation($navigation);
                ?>
            </ul>

        </nav><!-- #primary-menu end -->

    </div>
    <?php
}
?>

