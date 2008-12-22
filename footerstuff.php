<?php
/*
Plugin Name: Footer Stuff
Plugin URI: http://www.roytanck.com/2008/12/22/footer-stuff-is-ready-to-make-your-life-easier/
Description: Maintain things like stats code from within WordPress without having to alter your theme's footer file.
Version: 1.0
Author: Roy Tanck
Author URI: http://www.roytanck.com

Copyright Roy Tanck  (email : roy.tanck@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// insert code into footer
function footerstuff() {
	$options = get_option('footerstuff_options');
	echo $options['footertext'];
}

// insert code into header
function headerstuff() {
	$options = get_option('footerstuff_options');
	echo $options['headertext'];
}

// options page
function footerstuff_options() {
	$options = $newoptions = get_option('footerstuff_options');
	// if submitted, process results
	if ( $_POST["footerstuff_submit"] ) {
		$newoptions['footertext'] = stripslashes($_POST["footertext"]);
		$newoptions['headertext'] = stripslashes($_POST["headertext"]);
	}
	// any changes? save!
	if ( $options != $newoptions ) {
		$options = $newoptions;
		update_option('footerstuff_options', $options);
	}
	// options form
	echo '<form method="post">';
	echo "<div class=\"wrap\"><h2>Footer Stuff</h2>";
	echo '<table class="form-table">';
	// footer text
	echo '<tr valign="top"><th scope="row">HTML code to insert into the footer</th>';
	echo '<td><textarea style="width: 98%; font-size: 12px;" class="code" name="footertext" id="footertext" cols="60" rows="25">'.$options['footertext'].'</textarea></td></tr>';
	// headerer text
	echo '<tr valign="top"><th scope="row">HTML code to insert into the header</th>';
	echo '<td><textarea style="width: 98%; font-size: 12px;" class="code" name="headertext" id="headertext" cols="60" rows="10">'.$options['headertext'].'</textarea></td></tr>';
	// close stuff
	echo '<input type="hidden" name="footerstuff_submit" value="true"></input>';
	echo '</table>';
	echo '<p class="submit"><input type="submit" value="Update Options &raquo;"></input></p>';
	echo "</div>";
	echo '</form>';
}


function footerstuff_add_pages() {
	add_submenu_page('themes.php', 'Footer Stuff', 'Footer Stuff', 10, __FILE__, 'footerstuff_options');
}

add_action('wp_footer', 'footerstuff');
add_action('wp_head', 'headerstuff');
add_action('admin_menu', 'footerstuff_add_pages');

?>