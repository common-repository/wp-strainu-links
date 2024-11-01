<?php
/*
Plugin Name: WP-Links
Plugin URI: http://www.strainu.ro/wordpress/wp-links
Description: WP Links allows you to put your links on your blog. It can be implemented on a page or a post. It currently works with WordPress 1.5.x and 2.0.x
Author: Andrei Cipu
Author URI: http://www.strainu.ro
Version: 1.0.3
*/

load_plugin_textdomain('wpsl'); // NLS


/*
This shows the quicktag on the write pages
Based off Owen's Quicktag Template
http://asymptomatic.net/wp-hacks/
*/
function wpsl_add_quicktag() {
	if(strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php')) {
			?>
			<script language="JavaScript" type="text/javascript"><!--
			var toolbar = document.getElementById("ed_toolbar");
			<?php

			edit_insert_button("Your Links", "wpcf_handler", "Links");

			?>

			var state_my_button = true;

			function wpcf_handler() {
				if(state_my_button) {
						edInsertContent(edCanvas, '<!-'+'-slinks-'+'->');
				}
			}

			//--></script>
			<?php
	}
}

if(!function_exists('edit_insert_button')) {
		//edit_insert_button: Inserts a button into the editor
		function edit_insert_button($caption, $js_onclick, $title = '') {
			?>
			if(toolbar) {
					var theButton = document.createElement('input');
					theButton.type = 'button';
					theButton.value = '<?php echo $caption; ?>';
					theButton.onclick = <?php echo $js_onclick; ?>;
					theButton.className = 'ed_button';
					theButton.title = "<?php echo $title; ?>";
					theButton.id = "<?php echo "ed_{$caption}"; ?>";
					toolbar.appendChild(theButton);
			}
			<?php

		}
}

/*Wrapper function which calls the form.*/
function wpsl_callback( $content )
{
	//global $wpcf_strings;
	/* Run the input check. */
		if(! preg_match('<!--slinks-->', $content)) {
			return $content;
		}
		if(!get_option('wpsl_show_categories')) $legaturi=get_links('-1', '<li style="list-style: none;">', '</li>', ' ');
		else $legaturi=get_links_list('id');
		return str_replace('<!--slinks-->', $legaturi, $content);
}


/*CSS Styling*/
function wpsl_css()
	{
	?>
<style type="text/css" media="screen">

/* Begin Links CSS */
li.linkcat{
	list-style: none;
}
/* End Links CSS */

	</style>

<?php

	}

function wpsl_add_options_page()
	{
		add_options_page('Links Options', 'Your Links', 9, 'wp-strainu-links/options-links.php');
	}

/* Action calls for all functions */

if(get_option('wpsl_show_quicktag') == true) {add_action('admin_footer', 'wpsl_add_quicktag');}
//if(get_option('wpsl_show_categories') == true) {add_action('admin_footer', 'wpsl_add_categories');}

add_action('admin_head', 'wpsl_add_options_page');
add_filter('wp_head', 'wpsl_css');
add_filter('the_content', 'wpsl_callback', 7);
?>
