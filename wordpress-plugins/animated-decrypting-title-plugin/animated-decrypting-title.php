<?php
	/*
	Plugin Name: Animated Decrypting Title 
	Plugin URI: http://www.websdeveloper.com/cod/wordpress-plugin-animated-decrypting-title/
	Description: Plugin for animating the decrypting/decoding/deciphering of the DOM title; looks awesome with DNA/binary sequences!
	Author: Lee Reilly
	Version: 0.1
	Author URI: http://www.leereilly.net
	License: GPL2
	
	Copyright 2010 Lee Reilly (email: lee@leereilly.net)

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
	
?>

	<?php
	wp_enqueue_script('animated-decrpyting-title', '/wp-content/plugins/wordpress-animated-title-plugin/js/animated-decrypting-title.js');
	add_action('admin_menu', 'animated_decrpyting_title_menu');

	function animated_decrpyting_title_menu() {
	  add_options_page('My Plugin Options', 'My Plugin', 'manage_options', 'my-unique-identifier', 'my_plugin_options');
	}
	
	function my_plugin_options() {
		$warnings = array();
		$errors = array();
				
	  if (!current_user_can('manage_options'))  {
	    wp_die( __('You do not have sufficient permissions to access this page.') );
	  }
	
		if ($_POST) {
			$sequence = $_POST['sequence'];
			$repeats = (int)$_POST['repeats'];
			$delay = (int)$_POST['delay'];
			
			update_option('sequence', $sequence);
			update_option('repeats', $repeats);
			update_option('delay', $delay);

		}
		?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"><br></div>
			<h2>Animated Decrypting Title Settings</h2>
			<form method="POST" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
				<ul>
					<li>
						<label for="sequence"><strong>Sequence</strong><span></span>: </label><br/>
						<!--<input type="radio" name="sequence" value="ACTG">DNA Sequence <em>e.g. ACTGCACTGTATACA</em><br/>
						<input type="radio" name="sequence" value="01">Binary <em>e.g. 110111001010110</em><br/>
						<input type="radio" name="sequence" value="OTHER">Other <em>define in the textfield below...</em><br/>-->
						<input id="sequence" maxlength="255" size="37" name="sequence" value="<?php echo get_option('sequence'); ?>" />
					</li>		
					<li>
						<label for="repeats"><strong>Repeats</strong><span></span>: </label><br/>
						<input id="repeats" maxlength="3" size="3" name="repeats" value="<?php echo get_option('repeats'); ?>" /> times
					</li>	
					<li>
						<label for="delay"><strong>Delay</strong><span></span>: </label><br/>
						<input id="delay" maxlength="3" size="3" name="delay" value="<?php echo get_option('delay'); ?>" /> milliseconds
					</li>
				</ul>
				<input class="button-primary" type="submit" name="save" value="<?php _e("Save Options"); ?>" id="submitbutton" />							
				</form>
			</div>
			<img src="/wp-content/plugins/wordpress-animated-title-plugin/img/diaper.png" style="float:left;"/>
			<p>If you like this plugin please <strike>buy me a beer</strike> send me money via PayPal; diapers are frickin' expensive!</p>
			<p>Alternatively, give yourself a big high five. You go, you!</p>
		<?php
	}
?>

<?php 
	function load_javascript() {
		$sequence = get_option('sequence');
		$delay = get_option('delay');
		$repeats = get_option('repeats');
		
		# Ugly formatting here for nice formatting in users' HTML
		$javascript = "\n<!-- BEGIN ANIMATED DECRYPTING TITLE -->\n";
		$javascript .= "<script type='text/javascript'>\n";
		$javascript .= "\tdecrypt_title('$sequence', $repeats, $delay);\n";
		$javascript .= "</script>\t";
		$javascript .= "\n<!--- END ANIMATED DECRYPTING TITLE --->\n";
		
		echo $javascript;
	}
	
	add_action( is_admin() ? 'admin_head' : 'wp_head', 'load_javascript' ); 
?>
