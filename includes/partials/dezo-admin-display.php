<?php

require_once dirname(dirname( __FILE__ )).'/dezo-tools-const.php';
$dezo_const = dezo_get_const();

?>

<div class="wrap <?= $dezo_const->dashname?>-wrap">

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

                <?php if ($update != 0) : ?>
                    <div class="notice notice-success is-dismissible">
                        <p><?php _e( 'Registered options.', 'dezo-tools' ); ?></p>
                        <button type="button" class="notice-dismiss"><span class="screen-reader-text">Ne pas tenir compte de ce message.</span></button>
                    </div>
                <?php endif; ?>

                <h2 class="nav-tab-wrapper">
                    <a href="#<?= $dezo_const->dashname?>-general" class="nav-tab nav-tab-active"><?php _e('General','dezo-tools') ?></a>
                    <a href="#<?= $dezo_const->dashname?>-code" class="nav-tab"><?php _e('Code','dezo-tools') ?></a>
                    <a href="#<?= $dezo_const->dashname?>-performance" class="nav-tab"><?php _e('Performance','dezo-tools') ?></a>
                </h2><!-- Nav tabs -->

                <form method="post" action="admin.php?page=dezotools-admin-page">
                    <div class="tab-content" id="<?= $dezo_const->dashname?>-general">

                        <h3><?php _e('Site features', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="<?php echo $cookieDisplay; ?>">
                                <input name="<?php echo $cookieDisplay; ?>" type="checkbox" id="<?php echo $cookieDisplay; ?>" <?php checked( 1, get_option($cookieDisplay)); ?> value="1" />
                                <span><?php _e( 'Display the message for notifying the use of cookies', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="<?php echo $lightboxDisplay; ?>">
                                <input name="<?php echo $lightboxDisplay; ?>" type="checkbox" id="<?php echo $lightboxDisplay; ?>" <?php checked( 1, get_option($lightboxDisplay)); ?> value="1" />
                                <span><?php _e( 'Enable display of images over the site, click on the images. (lightbox)', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>

                        <h3><?php _e('Wordpress Admin', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="<?php echo $logoInLogin; ?>">
                                <input name="<?php echo $logoInLogin; ?>" type="checkbox" id="<?php echo $logoInLogin; ?>" <?php checked( 1, get_option($logoInLogin)); ?> value="1" />
                                <span><?php _e( 'Display the site logo in the login page', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>


                        <div class="postbox" style="margin-top: 20px;">

    						<h3><span><?= __('Informations', 'dezo-tools'); ?> </span></h3>

    						<div class="inside">

                                <h4><?= __('Cookie notice', 'dezo-tools') ?></h4>
                                <p><?= __('In cookies notice bar, a link "More informations" is present, for compliance obligation. You must create an information page explaining the use of cookies, with the slug "cookies".', 'dezo-tools') ?></p>

                                <h4><?= __('Lightbox', 'dezo-tools') ?></h4>
                                <p><?= __('To use the lightbox, you need to link your images to media files. Lightbox is automatically available in the <code>#content</code>. For developers, you must add the following code: <code>class="dezo-lightbox" rel="dezo-gallery"</code> to activate the lightbox.', 'dezo-tools') ?></p>

    						</div>
    						<!-- .inside -->

    					</div>
                    </div>
                    <div class="tab-content ui-tabs-hide" id="<?= $dezo_const->dashname ?>-code">
                        <h3><?php _e('Add code to header', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <textarea id="<?php echo $headerCode; ?>" name="<?php echo $headerCode; ?>" cols="80" rows="10"><?php echo (get_option($headerCode) != null) ? get_option($headerCode) : '' ; ?></textarea><br>
                        </fieldset>
                        <h3><?php _e('Add code to footer', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <textarea id="<?php echo $footerCode; ?>" name="<?php echo $footerCode; ?>" cols="80" rows="10"><?php echo (get_option($footerCode) != null) ? get_option($footerCode) : '' ; ?></textarea><br>
                        </fieldset>
                    </div>
                    <div class="tab-content ui-tabs-hide" id="<?= $dezo_const->dashname?>-performance">
                        <h3><?php _e('Performance setting', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="<?php echo $logoInLogin; ?>">
                                <span class="dezo-label"><?php _e( 'Number of revision : ', 'dezo-tools' ); ?></span>
                                <input type="number" class="dezo-input" id="<?php echo $postRevision; ?>" name="<?php echo $postRevision; ?>" min="0" max="15" value="<?php echo (get_option($postRevision) != null) ? get_option($postRevision) : '' ; ?>">
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="<?php echo $logoInLogin; ?>">
                                <span class="dezo-label"><?php _e( 'Post auto-save interval : ', 'dezo-tools' ); ?></span>
                                <input type="number" class="dezo-input" id="<?php echo $postInterval; ?>" name="<?php echo $postInterval; ?>" min="20" max="120" value="<?php echo (get_option($postInterval) != null) ? get_option($postInterval) : '' ; ?>">
                            </label>
                        </fieldset>

                    </div>

                    <input type="hidden" name="token" value="9A64E2178">
                    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
                </form>


			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h2><span><?php _e( 'Supporting the Plugin creator', 'dezo-tools' ); ?></span></h2>

						<div class="inside">
							<p><?php _e('This plugin is available for free. So we can offer you even more features, made a donation to the plugin creator, DezoDev, or made mention of the plugin.', 'dezo-tools' ); ?></p>
                            <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                <input type="hidden" name="cmd" value="_s-xclick">
                                <input type="hidden" name="hosted_button_id" value="CQ73UR2T4X4RC">
                                <input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
                                <img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
                            </form>

						</div>
						<!-- .inside -->

					</div>
					<!-- .postbox -->



				</div>
				<!-- .meta-box-sortables -->

			</div>
			<!-- #postbox-container-1 .postbox-container -->

		</div>
		<!-- #post-body .metabox-holder .columns-2 -->

		<br class="clear">
	</div>
	<!-- #poststuff -->

</div>
