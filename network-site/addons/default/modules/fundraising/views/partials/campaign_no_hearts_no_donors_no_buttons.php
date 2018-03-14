

        <div class="header-current-campaigns">
            <h3 class="ubuntu-light capitalize title-support title-support-length"
                style="color:<?= Settings::get('theme_colour') ?>"><?= $campaign1->campaign_support_us_title ?></h3>
            <img class="icons-custom"
                 src="/addons/default/themes/toucantechV2/img/category_icons/Fundraisingnews.png"
                 alt="">
            <span class="traits-support"></span>
        </div>
        <div class="row">
            <div class="col-md-12">
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
			<div class="col-md-12">
				<div class="text-center target-total bold-font ubuntu"
					 style="color:<?= Settings::get('theme_colour'); ?>">
					Total target: <?=default_currency_html_entity?><?php echo $campaign1->target_amount; ?>
				</div>
			</div>
        </div>


