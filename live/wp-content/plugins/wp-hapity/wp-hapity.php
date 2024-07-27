<?php
/**
 * @package Hapity
 */
/*
Plugin Name: Free Livestream – Live Video Streaming with Hapity
Plugin URI: https://www.hapity.com/
Description: Livestream for free, directly to your WordPress site with Hapity. Own your content and immediately share on social media.
Version: 3.3
Author: EgenieNext
Tags: free livestream, video streaming, live video stream, live video, livestream
Author URI: http://www.egenienext.com/
License: GPLv2 or later
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright 2017 Hapity, Inc.
*/ 


function hapity_register_script(){
	wp_register_script( 'ajaxHandler',  plugins_url('js.js',__FILE__),array('jquery') );
	wp_enqueue_script( 'ajaxHandler' );
}
add_action('admin_enqueue_scripts', 'hapity_register_script');


add_action('admin_footer', 'ha_blog_hapity_ajaxurl');

function ha_blog_hapity_ajaxurl() {
    ?>
    <script type="text/javascript">
        var BLOG_HAPITY_ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
    </script>
    <?php
}
include_once('functions.php');
new blog_hapity_plugin();
