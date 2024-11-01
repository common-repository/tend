<?php
/*
Plugin Name: Tend 
Plugin URI: http://tend.io
Description: Easily install Tend's tracking script in Wordpress, and start seeing what drives customers. The Plugin Requires a <a href='https://tend.io'>Tend Account</a>.
Version: 1.0.0
Author: Martin Thomas
License: A "Slug" license name e.g. GPL2

Copyright 2018  Martin Thomas  (email : marty@tend.io)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

add_action('wp_head', 'tendwp_display_tracking_script');
register_deactivation_hook( __FILE__, 'tendwp_deactivation' );

function tendwp_display_tracking_script() {
	echo get_option('tend_script');
}

// add the admin options page
add_action('admin_menu', 'tendwp_plugin_admin_add_page');
	function tendwp_plugin_admin_add_page() {
	add_options_page('Tend Tracking Script', 'Tend Tracking Script', 'manage_options', 'plugin', 'tendwp_plugin_options_page');
}

function tendwp_deactivation() {
    delete_site_option('tend_script');
}

// display the admin options page
function tendwp_plugin_options_page() {
?>	
  <div class="wrap">
  <div id="icon-options-general" class="icon32"><br /></div>
	<h2>Tend Tracking Script</h2>

    <form action="options.php" method="post">
  	<?php wp_nonce_field('update-options'); ?>
  
  	<label><b>Paste your Tend Tracking Script here:</b></label><br />
    <textarea name="tend_script" rows="10" style="width:100%"><?php echo get_option('tend_script'); ?></textarea>
  
	<input type="hidden" name="apiType" value="update" />
	<input type="hidden" name="action" value="update" />
	<input type="hidden" name="page_options" value="tend_script" />

	<a href="https://tend.io/signup">Sign Up</a> for a Tend.io account. <br />
  Need Help?  Visit the <a href="https://tend.io/docs/Setting-up-Tend/install-tend-on-wordpress" target="_blank">Support Page</a>.</p>
  
  <p class="submit">
  <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
  </p>
  
  </form>
  </div>
<?php
}
?>