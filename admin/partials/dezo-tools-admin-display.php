<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       http://dezodev.tk/
 * @since      0.0.1
 *
 * @package    Dezo_Tools
 * @subpackage Dezo_Tools/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrap <?php echo $this->plugin_name; ?>-wrap">

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
                    <a href="#<?php echo $this->plugin_name; ?>-general" class="nav-tab nav-tab-active"><?php _e('General','dezo-tools') ?></a>
                    <a href="#<?php echo $this->plugin_name; ?>-code" class="nav-tab"><?php _e('Code','dezo-tools') ?></a>
                    <a href="#<?php echo $this->plugin_name; ?>-performance" class="nav-tab"><?php _e('Performance','dezo-tools') ?></a>
                </h2><!-- Nav tabs -->
                
                <form method="post" action="admin.php?page=dezotools-admin-page">
                    <div class="tab-content" id="<?php echo $this->plugin_name; ?>-general">
                        
                        <h3><?php _e('Site features', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="<?php echo $cookieDisplay; ?>">
                                <input name="<?php echo $cookieDisplay; ?>" type="checkbox" id="<?php echo $cookieDisplay; ?>" <?php checked( 1, get_option($cookieDisplay)); ?> value="1" />
                                <span><?php _e( 'Display the message for notifying the use of cookies', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>
                        <fieldset>
                            <label for="<?php echo $swipeboxDisplay; ?>">
                                <input name="<?php echo $swipeboxDisplay; ?>" type="checkbox" id="<?php echo $swipeboxDisplay; ?>" <?php checked( 1, get_option($swipeboxDisplay)); ?> value="1" />
                                <span><?php _e( 'Enable the display of images over the site.', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>
                        
                        <h3><?php _e('Wordpress Admin', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="<?php echo $logoInLogin; ?>">
                                <input name="<?php echo $logoInLogin; ?>" type="checkbox" id="<?php echo $logoInLogin; ?>" <?php checked( 1, get_option($logoInLogin)); ?> value="1" />
                                <span><?php _e( 'Display the site logo in the login page', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>
                        
                    </div>
                    <div class="tab-content ui-tabs-hide" id="<?php echo $this->plugin_name; ?>-code">
                        <h3><?php _e('Add code to header', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <textarea id="<?php echo $headerCode; ?>" name="<?php echo $headerCode; ?>" cols="80" rows="10"><?php echo (get_option($headerCode) != null) ? get_option($headerCode) : '' ; ?></textarea><br>
                        </fieldset>
                        <h3><?php _e('Add code to footer', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <textarea id="<?php echo $footerCode; ?>" name="<?php echo $footerCode; ?>" cols="80" rows="10"><?php echo (get_option($footerCode) != null) ? get_option($footerCode) : '' ; ?></textarea><br>
                        </fieldset>
                    </div>
                    <div class="tab-content ui-tabs-hide" id="<?php echo $this->plugin_name; ?>-performance">
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
