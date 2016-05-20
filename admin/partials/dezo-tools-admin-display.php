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
                <h2 class="nav-tab-wrapper">
                    <a href="#<?php echo $this->plugin_name; ?>-general" class="nav-tab nav-tab-active"><?php _e('General','dezo-tools') ?></a>
                    <a href="#<?php echo $this->plugin_name; ?>-code" class="nav-tab"><?php _e('Code','dezo-tools') ?></a>
                    <a href="#<?php echo $this->plugin_name; ?>-performance" class="nav-tab"><?php _e('Performance','dezo-tools') ?></a>
                </h2><!-- Nav tabs -->
                
                <form method="post" action="options.php">
                    <div class="tab-content" id="<?php echo $this->plugin_name; ?>-general">
                        <h3><?php esc_attr_e('Cookie notice', 'dezo-tools'); ?></h3>
                        <fieldset>
                            <label for="users_can_register">
                                <input name="<?php echo $this->plugin_name; ?>_cookie_display" type="checkbox" id="<?php echo $this->plugin_name; ?>_cookie_display" value="1" />
                                <span><?php esc_attr_e( 'Display the Cookie notice message', 'dezo-tools' ); ?></span>
                            </label>
                        </fieldset>
                        
                    </div>
                    <div class="tab-content ui-tabs-hide" id="<?php echo $this->plugin_name; ?>-code">
                        <h3><?php esc_attr_e('Add code to header', 'dezo-tools'); ?></h3>
                    </div>
                    <div class="tab-content ui-tabs-hide" id="<?php echo $this->plugin_name; ?>-performance">
                        <h3><?php esc_attr_e('Performance setting', 'dezo-tools'); ?></h3>
                    </div>
                    <?php submit_button('Save all changes', 'primary','submit', TRUE); ?>
                </form>


			</div>
			<!-- post-body-content -->

			<!-- sidebar -->
			<div id="postbox-container-1" class="postbox-container">

				<div class="meta-box-sortables">

					<div class="postbox">

						<h2><span><?php esc_attr_e( 'Supporting the Plugin creator', 'dezo-tools' ); ?></span></h2>

						<div class="inside">
							<p><?php esc_attr_e('Ce plugin vous est proposé gratuitement. Pour qu\'on puisse vous proposer encore plus de fonctionalités, faite un don pour le créateur du plugin, DezoDev, ou faite parler du plugin.', 'dezo-tools' ); ?></p>
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
