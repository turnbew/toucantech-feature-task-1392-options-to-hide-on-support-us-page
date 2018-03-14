

        <div class="header-current-campaigns">
            <h3 class="ubuntu-light capitalize title-support title-support-length"
                style="color:<?= Settings::get('theme_colour') ?>"><?= $campaign1->campaign_support_us_title ?></h3>
            <img class="icons-custom"
                 src="/addons/default/themes/toucantechV2/img/category_icons/Fundraisingnews.png"
                 alt="">
            <span class="traits-support"></span>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="row current-campaigns-row">
                    <?php if ($campaign1->campaign_image && $campaign1->campaign_image != "dummy"): ?>
                        <div class="col-xs-12">
                            <img class="main-img-current"
                                 src="<?= site_url() ?>files/thumb/<?= $campaign1->campaign_image ?>/220/180/fit">
                        </div>
                        <div class="col-xs-12">
                            <p class="Ubuntu camp-description">
                                <?= $campaign1->campaign_support_us_description ?>
                            </p>
                        </div>
                    <?php else: ?>
                        <div class="col-md-12 col-sm-12">
                            <p class="Ubuntu camp-description">
                                <?= $campaign1->campaign_support_us_description ?>
                            </p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row donor-row">
            <div class="col-md-6">
                <div class="relative-wrapper text-center">
                    <div class="full-heart">
                        <img src="/addons/default/modules/network_settings/img/fundraising/fheart-full.png" style="width:120px;">
                    </div>
                    <?php if($campaign1->progress==0) {$height=100;}
                    else if($campaign1->progress>=100) {$height=0;}
                    else if($campaign1->progress>92) {$height=(100-$campaign1->progress);}
                    else {$height=(92-$campaign1->progress);}
                    ?>
                    <div class="empty-heart" style="height: <?=$height?>%;">
                        <img src="/addons/default/modules/network_settings/img/fundraising/fheart-empty.png" style="width:120px;">
                    </div>
                </div>
                <div class="progress-percentage text-center font-colour-one">
                    <?php if($height>43){$col='black';}else{$col='white';} ?>
                    <p id="progress-percetnage-text" style="color: <?=$col;?>; text-shadow: rgb(255, 255,255) -1px -1px 6px;"><?=$campaign1->progress?>%</p>
                </div>
                <script type="text/javascript">
                    var realProgress = "<?php echo trim($campaign1->progress, '%'); ?>";
                </script>
            </div>
            <div class="col-md-6 col-sm-6 right-content">
                <div class="col-md-12">
                    <div class="text-center target-total bold-font ubuntu"
                         style="color:<?= Settings::get('theme_colour'); ?>">
                        Total target: <?=default_currency_html_entity?><?php echo $campaign1->target_amount; ?>
                    </div>
                </div>
                <div class="col-xs-12">
                    <?php if (!empty($campaign1->subscribers)) { ?>
                        <ul class="donors-list">
                            <?php
                            $profileImgCount = 0;
                            foreach ($campaign1->subscribers as $subscriber) {
                                if ($subscriber->payment_anonymous != 1 &&
                                    $subscriber->image != null &&
                                    $profileImgCount <= 6
                                ) { ?>
                                    <li class="col-sm-3">
                                        <img src="<?php echo '/uploads/default/users/images/' . $subscriber->image; ?>">
                                    </li>
                                <?php }
                                $profileImgCount++;
                            } ?>
                        </ul>
                    <?php } ?>
                </div>
            </div>
        </div>

