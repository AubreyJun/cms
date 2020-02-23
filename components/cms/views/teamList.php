<div class="container clearfix">

    <div class="row clearfix">

        <?php
        foreach ($teamlist['item'] as $team) {
            ?>
            <div class="col-lg-6 bottommargin">
                <div class="team team-list clearfix">
                    <div class="team-image">
                        <img src="<?php echo $team['@attributes']['image']; ?>" alt="<?php echo $team['@attributes']['name']; ?>">
                    </div>
                    <div class="team-desc">
                        <div class="team-title"><h4><?php echo $team['@attributes']['name']; ?></h4>
                            <span><?php echo $team['@attributes']['title']; ?></span></div>
                        <div class="team-content">
                            <p><?php echo $team['@attributes']['description']; ?></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>

    </div>

</div>