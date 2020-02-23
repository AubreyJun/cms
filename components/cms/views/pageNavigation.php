<?php
if($style=='common'){
    ?>
    <header id="header" class="<?php echo $transparent==true?"transparent-header full-header":""; ?>">

        <div id="header-wrap">

            <div class="container clearfix">

                <div id="primary-menu-trigger"><i class="icon-reorder"></i></div>

                <!-- Logo
                ============================================= -->
                <div id="logo">
                    <a href="index.html" class="standard-logo" data-dark-logo="<?php echo $logo1; ?>"><img
                            src="<?php echo $logo1; ?>"></a>
                    <a href="index.html" class="retina-logo" data-dark-logo="<?php echo $logo2; ?>"><img
                            src="<?php echo $logo2; ?>" ></a>
                </div><!-- #logo end -->

                <!-- Primary Navigation
                ============================================= -->
                <nav id="primary-menu">

                    <ul class="sf-js-enabled" style="touch-action: pan-y;">
                        <?php
                        foreach ($menus['item'] as $menuitem){
                            if($PAGE_TYPE == $menuitem['@attributes']['pageType']){
                                ?>
                                <li class="current"><a href="<?php echo $menuitem['@attributes']['href']; ?>">
                                        <div><?php echo $menuitem['@attributes']['title']; ?></div>
                                    </a></li>
                                <?php
                            }else{
                                ?>
                                <li><a href="<?php echo $menuitem['@attributes']['href']; ?>">
                                        <div><?php echo $menuitem['@attributes']['title']; ?></div>
                                    </a></li>
                                <?php
                            }

                        }
                        ?>
                    </ul>

                </nav><!-- #primary-menu end -->

            </div>

        </div>

    </header>
    <?php
}