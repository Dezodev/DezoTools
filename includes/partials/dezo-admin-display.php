<?php

require_once dirname(dirname( __FILE__ )).'/dezo-tools-const.php';
$dezo_const = dezo_get_const();

?>

<div class="wrap <?= $dezo_const->dashname?>-wrap">

    <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

    <?php if ($fl_save) : ?>
        <div class="notice notice-success is-dismissible">
            <p>Vos options ont bien été sauvegardé</p>
            <button type="button" class="notice-dismiss"></button>
        </div>
    <?php endif; ?>

    <div id="poststuff">

		<div id="post-body" class="metabox-holder columns-2">

			<!-- main content -->
			<div id="post-body-content">

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

                        <h3><?php _e('Maintenance', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="<?php echo $maintActivation; ?>">
                                <input name="<?php echo $maintActivation; ?>" type="checkbox" id="<?php echo $maintActivation; ?>" <?php checked( 1, get_option($maintActivation)); ?> value="1" />
                                <span><?php _e( 'Activate the page of maintenance ( Except for the administrators )', 'dezo-tools' ); // FR : Activer la page de maintenance (sauf pour les administrateurs) ?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <div class="dezo-field-text">
                                <div class="dezo-fild-name">
                                    <label for="<?php echo $maintReason; ?>">
                                        <?= __('Reason of the maintenance', 'dezo-tools') // FR : Raison de la maintenance ?><br/>
                                        <span class="description"><?= __('If empty, the message does not display', 'dezo-tools')  // FR : 'Si vide, le message ne s\'affiche pas' ?></span>
                                    </label>
                                </div>
                                <div class="dezo-fild-content">
                                    <textarea id="<?php echo $maintReason; ?>" name="<?php echo $maintReason; ?>" cols="80" rows="2"><?php echo (get_option($maintReason) != null) ? get_option($maintReason) : '' ; ?></textarea>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="dezo-field-text">
                                <div class="dezo-fild-name">
                                    <label for="<?php echo $maintenanceEndDate; ?>">
                                        <?= __('Reason of the maintenance', 'dezo-tools') // FR : Raison de la maintenance ?><br/>
                                        <span class="description"><?= __('If empty, the message does not display', 'dezo-tools')  // FR : 'Si vide, le message ne s\'affiche pas' ?></span>
                                    </label>
                                </div>
                                <div class="dezo-fild-content">
                                    <input type="text" id="<?php echo $maintenanceEndDate; ?>" name="<?php echo $maintenanceEndDate; ?>" value="<?php echo (get_option($maintenanceEndDate) != null) ? get_option($maintenanceEndDate) : '' ; ?>"></input>
                                </div>
                            </div>
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
                            <div class="dezo-field-text">
                                <div class="dezo-fild-name">
                                    <label for="<?php echo $logoInLogin; ?>"><span class="dezo-label"><?php _e( 'Number of revision : ', 'dezo-tools' ); ?></span></label>
                                </div>
                                <div class="dezo-fild-content">
                                    <input type="number" class="dezo-input" id="<?php echo $postRevision; ?>" name="<?php echo $postRevision; ?>" min="0" max="15" value="<?php echo (get_option($postRevision) != null) ? get_option($postRevision) : '' ; ?>">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <div class="dezo-field-text">
                                <div class="dezo-fild-name">
                                    <label for="<?php echo $logoInLogin; ?>"><span class="dezo-label"><?php _e( 'Post auto-save interval : ', 'dezo-tools' ); ?></span></label>
                                </div>
                                <div class="dezo-fild-content">
                                    <input type="number" class="dezo-input" id="<?php echo $postInterval; ?>" name="<?php echo $postInterval; ?>" min="20" max="120" value="<?php echo (get_option($postInterval) != null) ? get_option($postInterval) : '' ; ?>">
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <label for="<?php echo $htmlMinify; ?>">
                                <input name="<?php echo $htmlMinify; ?>" type="checkbox" id="<?php echo $htmlMinify; ?>" <?php checked( 1, get_option($htmlMinify)); ?> value="1" />
                                <span><?php _e( 'Activate the minification of the HTML', 'dezo-tools' ); //FR : Activer la minification du HTML ?></span>
                            </label>
                        </fieldset>

                    </div>

                    <input type="hidden" name="token" value="9A64E2178">
                    <?php submit_button(__('Save all changes', 'dezo-tools'), 'primary','submit', TRUE); ?>
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

					</div>

                    <div class="postbox">

						<h2><span><?php _e( 'Support', 'dezo-tools' ); ?></span></h2>

						<div class="inside">
							<p><?= __('If you have an issue, please announce us it via the support of github.', 'dezo-tools') //FR : Si vous rencontrez un bug, veuillez nous en faire part via le support de github. ?></p>

                            <a class="button-secondary" href="https://github.com/Dezodev/DezoTools/issues" target="_blank" title="<?= __('Go to the support', 'dezo-tools'); ?>"><?= __('Go to the support', 'dezo-tools'); //FR: Accéder au support?></a>
                        </div>

					</div>

				</div>
			</div>
		</div>
		<br class="clear">
	</div>
	<!-- #poststuff -->

</div>
