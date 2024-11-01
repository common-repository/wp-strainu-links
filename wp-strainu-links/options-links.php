<?php
/*
Author: Andrei Cipu
Author URI: http://www.strainu.ro/
Description: Administrative options for WP-Links
*/

load_plugin_textdomain('wpsl'); // NLS
$location = get_option('siteurl') . '/wp-admin/admin.php?page=wp-strainu-links/options-links.php'; // Form Action URI

/*Lets add some default options if they don't exist*/
add_option('wpsl_show_quicktag', TRUE);
add_option('wpsl_show_categories', TRUE);

/*check form submission and update options*/
if ('process' == $_POST['stage'])
{
	if(isset($_POST['wpsl_show_quicktag'])) // If wpsl_show_quicktag is checked
	{update_option('wpsl_show_quicktag', true);}
	else {update_option('wpsl_show_quicktag', false);}
	if(isset($_POST['wpsl_show_categories'])) // If wpsl_show_categories is checked
	{update_option('wpsl_show_categories', true);}
	else {update_option('wpsl_show_categories', false);}


}

/*Get options for form fields*/
$wpsl_show_quicktag = get_option('wpsl_show_quicktag');
$wpsl_show_categories = get_option('wpsl_show_categories');
?>

<div class="wrap">
  <h2><?php _e('Links Page Options', 'wpsl') ?></h2>
  <form name="form1" method="post" action="<?php echo $location ?>&amp;updated=true">
	<input type="hidden" name="stage" value="process" />
    	<fieldset class="options">
		<legend><?php _e('Advanced', 'wpsl') ?></legend>

	    <table width="100%" cellpadding="5" class="editform">
	      <tr valign="top">
	        <th width="30%" scope="row" style="text-align: left"><?php _e('Show \'Links\' Quicktag', 'wpcf') ?></th>
	        <td>
	        	<input name="wpsl_show_quicktag" type="checkbox" id="wpsl_show_quicktag" value="wpsl_show_quicktag"
	        	<?php if($wpsl_show_quicktag == TRUE) {?> checked="checked" <?php } ?> />
			</td>
	      </tr>
		<tr valign="top">
	        <th width="30%" scope="row" style="text-align: left"><?php _e('Show Link Categories', 'wpcf') ?></th>
	        <td>
	        	<input name="wpsl_show_categories" type="checkbox" id="wpsl_show_categories" value="wpsl_show_categories"
	        	<?php if($wpsl_show_categories == TRUE) {?> checked="checked" <?php } ?> />
			</td>
	      </tr>

	     </table>

	</fieldset>

    <p class="submit">
      <input type="submit" name="Submit" value="<?php _e('Update Options', 'wpsl') ?> &raquo;" />
    </p>
  </form>
</div>