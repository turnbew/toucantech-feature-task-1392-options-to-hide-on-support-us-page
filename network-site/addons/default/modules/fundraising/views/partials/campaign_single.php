       <div class="current-campaigns">
            <div class="header-current-campaigns">
                <h3 class="ubuntu-light capitalize title-support"
                    style="color:<?= Settings::get('theme_colour') ?>"><?= $campaign->campaign_support_us_title ?></h3>
                <img class="icons-custom"
                     src="/addons/default/themes/toucantechV2/img/category_icons/Fundraisingnews.png" alt="">
                <span class="traits-support"></span>
            </div>
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <div class="row current-campaigns-row">
                        <?php if ($campaign->campaign_image && $campaign->campaign_image != "dummy"): ?>
                            <div class="col-md-6 col-sm-6">
                                <img class="main-img-current"
                                     src="<?= site_url() ?>files/thumb/<?= $campaign->campaign_image ?>/220/180/fit">
                            </div>
                            <div class="col-md-6 col-sm-6">
                                <p class="Ubuntu camp-description">
                                    <?= $campaign->campaign_support_us_description ?>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <?php if (!empty($campaign->subscribers)) { ?>
                                    <ul class="donors-list">
                                        <?php
                                        $profileImgCount = 0;
                                        foreach ($campaign->subscribers as $subscriber) {
                                            if ($subscriber->payment_anonymous != 1 &&
                                                $subscriber->image != null &&
                                                $profileImgCount <= 6
                                            ) { ?>
                                                <li class="col-sm-2">
                                                    <img src="<?php echo '/uploads/default/users/images/' . $subscriber->image; ?>">
                                                </li>
                                            <?php }
                                            $profileImgCount++;
                                        } ?>
                                    </ul>
                                <?php } ?>
                            </div>
                        <?php else: ?>
                            <div class="col-md-12 col-sm-12">
                                <p class="Ubuntu camp-description">
                                    <?= $campaign->campaign_support_us_description ?>
                                </p>
                            </div>
                            <div class="col-xs-12">
                                <?php if ( ! empty($campaign->subscribers) and (string)Settings::get('support_us_donors_list') == '1' ) : ?>
                                    <ul class="donors-list">
                                        <?php
                                        $profileImgCount = 0;
                                        foreach ($campaign->subscribers as $subscriber) {
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
                                 <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div >
                        <div class="relative-wrapper text-center">
							<?php if ( (string)Settings::get('support_us_hearts') == '1' ) : ?>
								<div class="full-heart">
									<img src="/addons/default/modules/network_settings/img/fundraising/fheart-full.png" style="width:120px;">
								</div>
								<?php
								if($campaign->progress==0) {$height=100;}
								else if($campaign->progress>=100) {$height=0;}
								else if($campaign->progress >= 55 && $campaign->progress< 60){$height=25;}
								else if($campaign->progress >= 60 && $campaign->progress< 70){$height=20;}
								else if($campaign->progress >= 70 && $campaign->progress< 80){$height=15;}
								else if($campaign->progress >= 80 && $campaign->progress< 90){$height=10;}
								else if($campaign->progress >= 90 && $campaign->progress<= 99){$height=5;}
								else {$height=(55-$campaign->progress);}?>
								<div class="empty-heart" style="height: <?=$height?>%;">
									<img src="/addons/default/modules/network_settings/img/fundraising/fheart-empty.png" style="width:120px;">
								</div>
							<?php endif; ?> 
                        </div>
                        <div class="progress-percentage text-center font-colour-one" style="top: 21%; bottom: auto;">
                            <?php if($height>20){$col='black';}else{$col='white';} ?>
                            <p id="progress-percetnage-text" style="color: <?=$col;?>; text-shadow: rgb(255, 255,255) -1px -1px 6px;"><?=$campaign->progress?>%</p>
                        </div>
                        <script type="text/javascript">
                            var realProgress = "<?php echo trim($campaign->progress, '%'); ?>";
                        </script>
                    </div>
                    <div class="text-center donor">
                        <?php if ($campaign->donorsNb == 0) :
                            echo 'No donors yet';
                        elseif ($campaign->donorsNb == 1) :
                            echo $campaign->donorsNb . ' donor';
                        else :
                            echo $campaign->donorsNb . ' donors';
                        endif; ?>
                    </div>
                    <div class="col-md-12 col-md-12">
                        <div class="text-center target-total bold-font ubuntu donor" style="color:<?= Settings::get('theme_colour'); ?>">
                            Total target: <?=default_currency_html_entity?><?php echo $campaign->target_amount; ?>
                        </div>
                    </div>
                    <div class="col-xs-12 campaign-button-with-currency">
						<?php if ( (string)Settings::get('support_us_donate_buttons') == '1' ) : ?>
							<button data-donation-amount="<?= $campaign->campaign_widget_quick_amount ?>"
									data-campaign-id="<?= $campaign->id ?>"
									class="gift-aid payment-button donate-button uppercase ubuntu"
									type="button" name="button"
									style="background-color:<?= Settings::get('theme_colour') ?>">
								<span></span>
	<!--                            <div class="currency" style="float: left;">--><?//=default_currency_html_entity?><!--<div>-->
								<div class="button-label">Donate Now</div>
							</button>
						<?php endif; ?> 
                    </div>
                </div>
            </div>
        </div>