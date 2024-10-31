<?php
/*
	Plugin Name: Page Template Thumbnails
	Description: Creates a thumbnail list of each page template. 
	Version: 1.2
	Author: Cameron Tullos
	Author URI: http://illumifi.net/
	License: GPL2
*/

/*  Copyright 2010  Illumifi LLC  (email : c.tullos@illumifi.net)
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

/* Runs when plugin is activated */
register_activation_hook(__FILE__, 'pthm_install'); 

/* Creates new database field */
function pthm_install() {
	add_option('pthm_dir', 'wp-content/gallery/page_templates/', '', 'yes');
	add_option('pthm_width', '100', '', 'yes');
	add_option('pthm_height', '75', '', 'yes');
	add_option('pthm_sidebar_height', '300', '', 'yes');
}

/* Runs on plugin deactivation*/
register_deactivation_hook( __FILE__, 'pthm_uninstall');

/* Deletes the database field */
function pthm_uninstall() {
	delete_option('pthm_dir');
	delete_option('pthm_width'); 
	delete_option('pthm_height'); 
	delete_option('pthm_sidebar_height');
}

/* Admin setup */
if (is_admin()) {

	/* init */
	add_action('init', 'pthm_scripts');
	
	function pthm_scripts() { 

		$path = get_bloginfo('url') . '/' . PLUGINDIR . '/page-template-thumbnails'; 

		wp_enqueue_script('jquery');
		wp_enqueue_script('pthm_js', $path . '/js/pthm.js', array('jquery'));
		wp_register_script('pthm_js', $path . '/js/pthm.js');
	}

	/* menu init */
	add_action('admin_menu', 'pthm_admin_menu');

	function pthm_admin_menu() {
		add_options_page('Page Template Thumbnails', 'Page Template Thumbnails', 'administrator', __FILE__, 'pthm_admin_page');
		add_meta_box('pthm_meta', __('Page Templates'), 'pthm_meta_box', 'page', 'side');
	}

	/* draw meta box */
	function pthm_meta_box() { 

		$url = get_bloginfo('url') . '/' . get_option('pthm_dir');
		$dir = ABSPATH . get_option('pthm_dir'); 
		$w = get_option('pthm_width'); 
		$h = get_option('pthm_height');
		$sbh = get_option('pthm_sidebar_height');
		
		if ($handle = opendir($dir)) {
			echo '<div style="height: '.$sbh.'px; overflow: auto" id="pthm_div"><ul>';
			echo '<input type="hidden" id="pthm_inc" value="'.$h.'" />';

			/* loop through files in dir */
			while (false !== ($file = readdir($handle))) {
				if ($file != '..' && $file != '.' && $file != 'thumbs') { 
					$name = $file;
					$name = str_replace('.png', '', $name);
					$name = str_replace('.jpg', '', $name);
					$name = str_replace('_', ' ', $name); 

					echo "<li><a class='pthm_img'><img  width='".$w."' height='".$h."' style='border: 5px solid #FFF' src='".$url.$file."'  alt='".$name."'/></a></li>";
				}
			}

			echo '</ul></div>';
			closedir($handle);
		}

		else { _e('No thumbs in: ' . $url); }
	}
}

function pthm_admin_page() {
?>

<div class="wrap">
    <div id="icon-themes" class="icon32"><br></div>
    <h2><?php _e('Page Template Thumbs Options'); ?></h2>
    <form method="post" action="options.php">
        <?php wp_nonce_field('update-options'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row" style="width: 105px"><?php _e('Thumbnail Path'); ?></th>
                <td>
                    <input name="pthm_dir" type="text" size="55" id="pthm_dir" value="<?php echo get_option('pthm_dir'); ?>" /><br />
                    (ex. wp-content/gallery/page_templates/)
                </td>
            </tr>
            <tr valign="top">
            	<th scope="row"><?php _e('Thumbnail Size'); ?></th>
                <td>
                	<input name="pthm_width" type="text" size="5" id="pthm_width" value="<?php echo get_option('pthm_width'); ?>" /> x <input name="pthm_height" type="text" size="5" id="pthm_height" value="<?php echo get_option('pthm_height'); ?>" /><br />
                    <?php _e('in pixels'); ?>
                </td>
            </tr>
            <tr valign="top">
            	<th scope="row"><?php _e('Sidebar Height'); ?></th>
                <td>
                	<input name="pthm_sidebar_height" type="text" size="5" id="pthm_sidebar_height" value="<?php echo get_option('pthm_sidebar_height'); ?>" /><br />
					<?php _e('in pixels'); ?>
                </td>
            </tr>
        </table>
        <input type="hidden" name="action" value="update" />
        <input type="hidden" name="page_options" value="pthm_dir,pthm_width,pthm_height,pthm_sidebar_height" />
        <p><input type="submit" class="button-primary" value="<?php _e('Save Changes'); ?>" /></p>
    </form>
</div>
<?php } ?>