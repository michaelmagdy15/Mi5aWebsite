<?php
/**
 * Plugin Name:       WpStream
 * Plugin URI:        http://wpstream.net
 * Description:       WpStream is a platform that allows you to live stream, create Video-on-Demand, and offer Pay-Per-View videos. We provide an affordable and user-friendly way for businesses, non-profits, and public institutions to broadcast their content and monetize their work. 
 * Version:           4.1
 * Author:            wpstream
 * Author URI:        http://wpstream.net
 * Text Domain:       wpstream
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
define('WPSTREAM_PLUGIN_VERSION', '4.1');
define('WPSTREAM_CLUBLINK', 'wpstream.net');
define('WPSTREAM_CLUBLINKSSL', 'https');
define('WPSTREAM_PLUGIN_URL',  plugins_url() );
define('WPSTREAM_PLUGIN_DIR_URL',  plugin_dir_url(__FILE__) );
define('WPSTREAM_PLUGIN_PATH',  plugin_dir_path(__FILE__) );
define('WPSTREAM_PLUGIN_BASE',  plugin_basename(__FILE__) );


define('WPSTREAM_API', 'https://baker.wpstream.net');



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpstream-activator.php
 */
function activate_wpstream() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpstream-activator.php';
	Wpstream_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpstream-deactivator.php
 */
function deactivate_wpstream() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpstream-deactivator.php';
	Wpstream_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpstream' );
register_deactivation_hook( __FILE__, 'deactivate_wpstream' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpstream.php';
require plugin_dir_path( __FILE__ ) . 'wpstream-elementor.php';

  

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    3.0.1
 */

global $wpstream_plugin;
$wpstream_plugin = new Wpstream();
$wpstream_plugin->run();

add_action( 'upgrader_process_complete', 'wpstream_my_upgrate_function',10, 2);

function wpstream_my_upgrate_function( $upgrader_object, $options ) {

     
    $current_plugin_path_name = plugin_basename( __FILE__ );
 
    if ($options['action'] == 'update' && $options['type'] == 'plugin' ) {
       foreach($options['plugins'] as $each_plugin) {
          if ($each_plugin==$current_plugin_path_name) {
              delete_transient('wpstream_token_api');
                update_option('wp_estate_token_expire',0);
                update_option('wp_estate_curent_token',' ');

          }
       }
    }
    
    
}



add_action('wp_head', 'wpestate_add_custom_meta_to_header');

function wpestate_add_custom_meta_to_header(){
    global $post;


    if ( is_singular('product') || is_singular('wpstream_product') ){
        $image_id       =   get_post_thumbnail_id();
        $share_img      =   wp_get_attachment_image_src( $image_id, 'full');
        $the_post       =   get_post($post->ID); ?>

        <meta property='og:title' content="<?php print esc_html(get_the_title($post->ID)); ?>"/>
        <?php if(isset($share_img[0])){ ?>
            <meta property="og:image" content="<?php print esc_url($share_img[0]); ?>"/>
            <meta property="og:image:secure_url" content="<?php print esc_url($share_img[0]); ?>" />
        <?php }?>
       
        <meta property="og:description"  content=" <?php print wp_strip_all_tags( $the_post->post_content);?>" />
    <?php }


}

