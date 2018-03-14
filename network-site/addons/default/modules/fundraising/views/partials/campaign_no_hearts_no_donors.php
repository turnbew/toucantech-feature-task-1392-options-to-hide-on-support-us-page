

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
                </div>
            </div>
            <div class="col-md-6 col-sm-6 right-content">
                <div class="col-md-12">
                    <div class="text-center target-total bold-font ubuntu"
                         style="color:<?= Settings::get('theme_colour'); ?>">
                        Total target: <?=default_currency_html_entity?><?php echo $campaign1->target_amount; ?>
                    </div>
                </div>
                <div class="col-xs-12 campaign-button-with-currency">
                    <button data-donation-amount="<?= $campaign1->campaign_widget_quick_amount ?>"
                            data-campaign-id="<?= $campaign1->id ?>"
                            class="gift-aid payment-button donate-button uppercase ubuntu"
                            type="button" name="button"
                            style="background-color:<?= Settings::get('theme_colour') ?>">
						<span></span>
						<div class="button-label">Donate Now</div>
                    </button>
                </div>
            </div>
        </div>

