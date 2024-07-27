<?php



class blog_hapity_plugin {



    public function __construct() {

        add_action('wp_enqueue_scripts', array($this, 'ses_so_enqueue_scripts_blog_hapity'));

        add_action('wp_ajax_hspb_hp_new_post_broadcast', array($this, 'hspb_hp_new_post_broadcast'));

        add_action('wp_ajax_nopriv_hspb_hp_new_post_broadcast', array($this, 'hspb_hp_new_post_broadcast'));



        add_action('wp_ajax_hsak_hp_save_auth_key_blog_hapity', 'hsak_hp_save_auth_key_blog_hapity');

        add_action('wp_ajax_nopriv_hsak_hp_save_auth_key_blog_hapity', 'hsak_hp_save_auth_key_blog_hapity');



        add_action('wp_ajax_hed_hp_enable_disable_blog_hapity', 'hed_hp_enable_disable_blog_hapity');

        add_action('wp_ajax_nopriv_hed_hp_enable_disable_blog_hapity', 'hed_hp_enable_disable_blog_hapity');



        add_action('wp_ajax_hhr_hp_blog_hapity_reset', 'hhr_hp_blog_hapity_reset');

        add_action('wp_ajax_nopriv_hhr_hp_blog_hapity_reset', 'hhr_hp_blog_hapity_reset');



        add_action('wp_ajax_hpb_hp_new_broadcast', 'hpb_hp_new_broadcast');

        add_action('wp_ajax_nopriv_hpb_hp_new_broadcast', 'hpb_hp_new_broadcast');

        

        add_action('admin_menu', array($this, 'wh_blog_hapity'));

        add_filter('widget_text', 'do_shortcode');

        

        add_action('wp_ajax_hpb_hp_delete_broadcast', 'hpb_hp_delete_broadcast');

        add_action('wp_ajax_nopriv_hpb_hp_delete_broadcast', 'hpb_hp_delete_broadcast');

        

        add_action('wp_ajax_hpb_hp_edit_broadcast', 'hpb_hp_edit_broadcast');

        add_action('wp_ajax_nopriv_hpb_hp_edit_broadcast', 'hpb_hp_edit_broadcast');



        // Add Twitter Card and Open Graph Tags

        add_action('wp_head', 'hpb_hp_meta_tags_broadcast');

    }



    public function ses_so_enqueue_scripts_blog_hapity() {

        wp_register_script('ajaxHandle', get_template_directory() . 'js.js', array('jquery'), false, true);

        wp_enqueue_script('ajaxHandle');

        wp_localize_script('ajaxHandle', 'ajax_object', array('ajaxurl' => get_template_directory() . 'js.js'));

    }



    public function whp_blog_hapity_page() {

        ob_start();


        $term    = get_queried_object();
        $term_id = ( isset( $term->term_id ) ) ? (int) $term->term_id : 0;

        $categories = get_categories( array(
            'taxonomy'   => 'category', // Taxonomy to retrieve terms for. We want 'category'. Note that this parameter is default to 'category', so you can omit it
            'orderby'    => 'name',
            'hide_empty' => 0, // change to 1 to hide categores not having a single post
        ) );
        ?>



        <div class="wrap">

            <form method="post" action="javascript:void(0);" autocomplete="off">

                <?php

                settings_fields('bloghapitygroup');

                $data = get_option('blog_hapity_plugin_data', 'notFound');


                if ($data != 'notFound')

                    $data = unserialize($data);

                ?>

                <h1><?php echo __('Blog Hapity PlugIn'); ?></h1>

                <p><h3><?php echo __('Enter Your Auth ID'); ?></h3></p>

                <input name="bloghapitysettings[original]" type="text" id="blog-hapity-auth-id" style="width:270px" <?php if (is_array($data)){ echo 'disabled="" '; } if (is_array($data)) echo 'value=' . $data['key']; ?>>
                
              

                <?php if (!is_array($data)): ?>

                    <input value="Authenticate" id="blog-bring-broadcast" type="submit" class="button-primary" />





                    <div id="hapity-help-text">

                        <ol>

                            <li>To get started, create your free Hapity account. Go to the <a href="https://www.hapity.com/register" target="_blank"> registration page</a> and enter your desired login credentials. Or, you can also sign in with Facebook or Twitter:</li>

                            <li>In order to connect your Hapity account to your WordPress site, you'll use something called an "Auth ID" to link the two together.</li>

                            <li>To find your Auth ID, <a href="https://www.hapity.com/login" target="_blank">log in</a> to your Hapity account and click on <strong>Settings</strong> in the top-right corner:</li>

                            <li>Then, scroll down and find the box for Plugin ID, which contains a long string of numbers and letters. Copy the value in this box:</li>

                            <li>Come back to this page and paste in <strong>Auth ID</strong></li>

                            <li>Click on authenticate and submit</li>

                        </ol>

                        <video id="hapity-video" controls="" poster="https://www.hapity.com/assets/images/integrate-with-wordpress.jpg" src="https://www.hapity.com/assets/videos/How-To-WordPress_Edit03-Vimeo_720p.mov"></video>

                    </div>

                <?php endif; ?>

                <?php if (is_array($data)): ?>

                <input value="Reset" id="reset-blog-hapity" type="button" class="button-primary" />

                <?php endif; ?> 

            

                <br/>

                <br>

                <div style=" visibility: hidden" id="radios-blog-hapity">
                
                <h3><?php echo __('Select Category'); ?></h3>
                <select name="bloghapitysettings[category]" id="blog-hapity-category-id" style="width:270px">
                    <?php
                        foreach($categories as $x => $c) {
                            echo '<option '.  ($data['cat'] == $c->cat_ID ? 'selected' : '') .' value="'. $c->cat_ID .'">'.$c->name.'</option>';
                        }
                    ?>
                </select>
                <br/>
                    <p>

                        <h4 style=" display: inline-block"><?php echo __('Enable :'); ?></h4>

                        <input type="radio" id="status" name="status-blog-hapity" value="E" <?php if (is_array($data) && $data['status']) echo 'checked=checked'; ?>>

                        <h4 style=" display: inline-block"><?php echo __('Disable :'); ?></h4>

                        <input type="radio" id="status2" name="status-blog-hapity" value="D" <?php if (is_array($data) && !$data['status']) echo 'checked=checked'; ?>>

                    </p>



                    <p>

                        <h4 style=" display: inline-block">

                            <?php echo __('Twitter Open Graph Meta Tags:'); ?>

                        </h4>

                        <input 

                        type="checkbox" 

                        id="twitter-card" 

                        name="twitter-card" 

                        value="yes" 

                        <?php if (is_array($data) && $data['twitter_card'] == "yes") echo 'checked=checked'; ?>>

                    </p>

                    <p>

                        <h4 style=" display: inline-block">

                            <?php echo __('Facebook Open Graph Meta Tags'); ?>

                        </h4>

                        <input 

                        type="checkbox" 

                        id="facebook-card" 

                        name="facebook-card" 

                        value="yes" 

                        <?php if (is_array($data) && $data['facebook_card'] == "yes") echo 'checked=checked'; ?>>

                    </p>

                    <p>

                    <input value="Save" id="change-status-blog-hapity" type="button" class="button-primary">

                    </p>

                </div>

            </form>

            <style type="text/css">

                #hapity-video {

                    width: 500px;

                }

            </style>

        </div>



        <?php

        echo ob_get_clean();

    }



    //Admin Tab

    public function wh_blog_hapity() {

        add_menu_page( 'Hapity', 'Hapity', 'manage_options', 'hapity', array($this, 'whp_blog_hapity_page'), 'dashicons-format-video', 90 );

        add_action('admin_menu', 'wh_blog_hapity');

        add_action('admin_init', array($this, 'whr_blog_hapity_register'));

    }



    //Register Settings

    public function whr_blog_hapity_register() {

        register_setting('bloghapitygroup', 'bloghapitysettings');

    }

    

    public function hspb_hp_new_post_broadcast($bid, $title, $sUrl, $status, $key, $image, $description,$user_id) {


        
        settings_fields('bloghapitygroup');

        $data = get_option('blog_hapity_plugin_data', 'notFound');

        $cat = '1';
        if ($data != 'notFound'){
            $cat = unserialize($data)['cat'];
        }




        $result_array = array();



        // $title = strtolower(preg_replace('/[^a-zA-Z0-9-_\.\s]/','', $title));

       

        $data_content = '';

        if (!empty($sUrl)) {

            $iframe = '<iframe allowfullscreen height="600" width="100%" scrolling="no" frameborder="0" src="https://www.hapity.com/widget?stream=' . $sUrl . '&title=' . $title . '&status=' . $status . '&bid=' . $bid . '&broadcast_image=' . $image . '&user_id='.$user_id. '"></iframe>';

            $data_content = $iframe;

        } else if (!empty($image)) {

            $data_content = '<div style="width:100%;"><img src="' . $image . '"></div>';

        }

        if (!empty($description)) {

            $data_content .= '<p style="margin-top:20px">' . $description . '</p>';

        }



        $postarr = array(

            'post_title' => $title,

            'post_status' => 'publish',

            'post_type' => 'post',

            'post_content' => $data_content,

            'post_category' => array($cat)

        );

        

        global $wpdb;

        $option_table = $wpdb->prefix."options";

        $sql = "SELECT * FROM $option_table WHERE option_name='blog_hapity_plugin_data'";

        $data = $wpdb->get_results($sql);

        

        $data = unserialize(unserialize($data[0]->option_value));

        if (sizeof($data) > 0 && $data['status'] && $data['key'] == $key) {

            remove_filter('content_save_pre', 'wp_filter_post_kses');

            remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

            $this_insert = wp_insert_post($postarr);

            add_filter('content_save_pre', 'wp_filter_post_kses');

            add_filter('content_filtered_save_pre', 'wp_filter_post_kses');

            

            if ($this_insert) {

                $result_array['post_id_wp'] = $this_insert;

                $result_array['bid'] = $bid;

                $result_array['post_url'] =  get_permalink($this_insert);

                $result_array['status'] = 'success';



                update_post_meta( $this_insert, 'broadcast_image', $image );

                update_post_meta( $this_insert, 'broadcast_description', $description );

            } else {

                $result_array['post_id_wp'] = '';

                $result_array['bid'] = $bid;

                $result_array['post_url'] =  '';

                $result_array['status'] = 'failure';

            }

        }



        print_r(json_encode($result_array));

        die();

    }

    

    // update post

    public function hspb_hp_edit_post_broadcast($bid, $title, $sUrl, $status, $key, $image, $description, $post_id,$user_id) {

        $result_array = array();



        // $title = strtolower(preg_replace('/[^a-zA-Z0-9-_\.\s]/','', $title));



        $data_content = '';

        if (!empty($sUrl)) {

            $iframe = '<iframe allowfullscreen height="600" width="100%" scrolling="no" frameborder="0" src="https://www.hapity.com/widget?stream=' . $sUrl . '&title=' . $title . '&status=' . $status . '&bid=' . $bid . '&broadcast_image=' . $image .'&user_id='.$user_id. '"></iframe>';

            $data_content = $iframe;

        } else if (!empty($image)) {

            $data_content = '<div style="width:100%;"><img src="' . $image . '"></div>';

        }

        if (!empty($description)) {

            $data_content .= '<p style="margin-top:20px">' . $description . '</p>';

        }



        $postarr = array(

            'ID' => $post_id,

            'post_title' => $title,

            'post_content' => $data_content

        );



        global $wpdb;

        $option_table = $wpdb->prefix."options";

        $sql = "SELECT * FROM $option_table WHERE option_name='blog_hapity_plugin_data'";



        $data = $wpdb->get_results($sql);

        $data = unserialize(unserialize($data[0]->option_value));

        if (sizeof($data) > 0 && $data['status'] && $data['key'] == $key) {

            

            remove_filter('content_save_pre', 'wp_filter_post_kses');

            remove_filter('content_filtered_save_pre', 'wp_filter_post_kses');

            $this_update =  wp_update_post( $postarr );

            add_filter('content_save_pre', 'wp_filter_post_kses');

            add_filter('content_filtered_save_pre', 'wp_filter_post_kses');



            if ($this_update) {

                $result_array['post_id_wp'] = $post_id;

                $result_array['bid'] = $bid;

                $result_array['status'] = 'success';



                update_post_meta( $this_update, 'broadcast_image', $image );

                update_post_meta( $this_update, 'broadcast_description', $description );

            } else {

                $result_array['post_id_wp'] = '';

                $result_array['bid'] = $bid;

                $result_array['status'] = 'failure';

            }

        }

        print_r(json_encode($result_array));

        die();

    }



    function hspb_hp_delete_post_broadcast($bid, $key, $post_id) {

        global $wpdb;



        $option_table = $wpdb->prefix."options";

        $sql = "SELECT * FROM $option_table WHERE option_name='blog_hapity_plugin_data'";



        $data = $wpdb->get_results($sql);

        $data = unserialize(unserialize($data[0]->option_value));

        

        $result_array = array();

        if(sizeof($data) > 0 && $data['status'] && $data['key'] == $key && $post_id){

            $delete_action = wp_delete_post($post_id, true);

            if($delete_action){

                $result_array['status'] = 'success';

            } else {

                $result_array['status'] = 'failure';

            }

        }

        print_r(json_encode($result_array));

        die();

    }



}



function hsak_hp_save_auth_key_blog_hapity() {

    $key = sanitize_text_field($_GET['key']);

    $status = intval($_GET['status']);
    $cat = intval($_GET['cat']);

    $data = array(

        'key' => $key,

        'status' => $status,
        'cat' => $cat,

        'facebook_card' => "yes",

        'twitter_card' => "yes"

    );

    global $wpdb;

    add_option('blog_hapity_plugin_data', serialize($data));

    print_r($data);

    die();

}



function hed_hp_enable_disable_blog_hapity() {

    $status = intval($_GET['status']);
    $cat = intval($_GET['cat']);


    $facebook_card = $_GET['facebook_card'];
    $twitter_card = $_GET['twitter_card'];


    $data = unserialize(get_option('blog_hapity_plugin_data'));

    $data['status'] = $status;
    $data['facebook_card'] = $facebook_card;
    $data['twitter_card'] = $twitter_card;
    $data['cat'] = $cat;
    

    update_option('blog_hapity_plugin_data', serialize($data));

    print_r($data);

    die();

}



function hhr_hp_blog_hapity_reset() {

    delete_option('blog_hapity_plugin_data');

    die();

}



function hpb_hp_new_broadcast() {

    $bid = intval($_POST['bid']);

    $user_id = intval($_POST['user_id']); 

    $title = sanitize_text_field($_POST['title']);

    $sUrl = sanitize_text_field($_POST['stream_url']);

    $status = sanitize_text_field($_POST['status']);

    $key = sanitize_text_field($_POST['key']);

    $image = sanitize_text_field($_POST['broadcast_image']);

    $description = sanitize_text_field($_POST['description']);

    $happy = new blog_hapity_plugin;

    $happy->hspb_hp_new_post_broadcast($bid, $title, $sUrl, $status, $key, $image, $description,$user_id);

}



function hpb_hp_delete_broadcast() {

    $post_id = intval($_GET['post_id_wp']);

    $key = sanitize_text_field($_GET['key']);

    $bid = intval($_GET['bid']);

    $happy = new blog_hapity_plugin;

    $happy->hspb_hp_delete_post_broadcast($bid, $key, $post_id);

}



function hpb_hp_edit_broadcast() {

    $bid = intval($_POST['bid']);

    $user_id = intval($_POST['user_id']); 

    $post_id = intval($_POST['post_id_wp']);

    $title = sanitize_text_field($_POST['title']);

    $sUrl = sanitize_text_field($_POST['stream_url']);

    $status = sanitize_text_field($_POST['status']);

    $key = sanitize_text_field($_POST['key']);

    $image = sanitize_text_field($_POST['broadcast_image']);

    $description = sanitize_text_field($_POST['description']);

    $happy = new blog_hapity_plugin;

    $happy->hspb_hp_edit_post_broadcast($bid, $title, $sUrl, $status, $key, $image, $description, $post_id, $user_id);

}



function hpb_hp_meta_tags_broadcast(){



    global $wpdb;



    $option_table = $wpdb->prefix."options";

    $sql = "SELECT * FROM $option_table WHERE option_name='blog_hapity_plugin_data'";

    

    $data = $wpdb->get_results($sql);

    $data = unserialize(unserialize($data[0]->option_value));



    //if(sizeof($data) > 0 && $data['status'] && $data['key'] == $key && $post_id){



    if(is_single() && sizeof($data) > 0 && $data['status'] ): 

        $get_the_ID = get_the_ID();

        $post_content = get_post($get_the_ID);

        $get_the_title = $post_content->post_title;

        $get_the_content = strip_tags($post_content->post_content);

        $get_the_url =  get_the_permalink( $get_the_ID );

        $get_image = get_post_meta( $get_the_ID, 'broadcast_image', true );





        $facebook_card = $data['facebook_card'];

        $twitter_card = $data['twitter_card'];



        if($facebook_card == "yes"): ?>

            <!-- Hapity Open Graph Data -->

            <meta name="og:title" content="<?php echo $get_the_title; ?>" />

            <meta name="og:url" content="<?php echo esc_url($get_the_url); ?>" />

            <meta name="og:type" content="website" />

            <meta name="og:description" content="<?php echo $get_the_content; ?>" />

            <meta name="og:image" content="<?php echo $get_image; ?>" />

            <meta name="og:image:alt" content="<?php echo $get_the_title; ?>" />

        <?php endif;

        if($twitter_card == "yes"): ?>

            <!-- Hapity Twitter Card Data -->

            <meta name="twitter:card" content="summary" />

            <meta name="twitter:title" content="<?php echo $get_the_title; ?>" />

            <meta name="twitter:description" content="<?php echo $get_the_content; ?>" />

            <meta name="twitter:url" content="<?php echo esc_url($get_the_url); ?>" />

            <meta name="twitter:image" content="<?php echo $get_image; ?>" />

        <?php endif;

    endif;

}