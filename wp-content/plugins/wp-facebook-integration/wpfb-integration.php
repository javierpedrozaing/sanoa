<?php
/*
 * Plugin Name: WP Facebook Integration
 * Plugin URI: http://webdeveloping.gr/en/projects/wordpress-facebook-integration
 * Description: Add a Picture Gallery from your Facebook Page
 * Version: 1.0
 * Author: tazbambu
 * Author URI: http://webdeveloping.gr
 * License: GPL2
 * Created On: 28-05-2016
 * Updated On: 24-02-2017
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
include( plugin_dir_path(__FILE__) .'/wpfb-options.php');


function wpfbint_scripts(){

    wp_enqueue_style( 'wpfbint_css', plugins_url( '/css/style.css', __FILE__ ) );	
	wp_enqueue_style( 'wpfbint_css');	
	
    wp_enqueue_style( 'wpfbint_colorbox_css', plugins_url( '/css/colorbox.css', __FILE__ ) );	
	wp_enqueue_style( 'wpfbint_colorbox_css');	

	wp_enqueue_script('jquery');
    wp_enqueue_script( 'wpfbint_colorbox_js', plugins_url( '/js/colorbox.js', __FILE__ ) , array('jquery') , null, true);	
	wp_enqueue_script( 'wpfbint_colorbox_js');
	
    wp_enqueue_script( 'wpfbint_custom_js', plugins_url( '/js/custom.js', __FILE__ ) , array('jquery') , null, true);	
	wp_enqueue_script( 'wpfbint_custom_js');	
}
add_action('wp_enqueue_scripts', 'wpfbint_scripts');

function wpfbint_admin_scripts(){
    wp_enqueue_script('jquery');
	
    wp_enqueue_script( 'wpfbint_admin_js', plugins_url( '/js/admin.js', __FILE__ ), array('jquery') , null, true);	
	wp_enqueue_script( 'wpfbint_admin_js');
	
    $wpfbUrl = array( 'plugin_url' => plugins_url( '', __FILE__ ) );
    wp_localize_script( 'wpfbint_admin_js', 'url', $wpfbUrl );
}
add_action('admin_enqueue_scripts', 'wpfbint_admin_scripts');


//ALLOW SHORTCODES ON WIDGETS
add_filter('widget_text', 'do_shortcode');

//ADD MENU LINK AND PAGE FOR WOO PRODUCT IMPORTER
add_action('admin_menu', 'wpfbint_menu');

function wpfbint_menu() {
	add_menu_page('WP Facebook Integration Settings', 'WP Facebook Integration', 'administrator', 'wpfbint_settings', 'wpfbint_settingsform', 'dashicons-admin-generic','100');
}


//ADD ACTION LINKS
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'add_wpfbint_links' );

function add_wpfbint_links ( $links ) {
 $links[] =  '<a href="' . admin_url( 'admin.php?page=wpfbint_settings' ) . '">Settings</a>';
 $links[] = '<a href="http://webdeveloping.gr" target="_blank">More plugins by Bambu</a>';
   return $links;
}

function wpfbint_page_id(){
	?>
    	<input type="text" name="wpfbint_page_id" id="wpfbint_page_id" required value="<?php echo esc_attr(get_option('wpfbint_page_id')); ?>" />
    <?php
}
function wpfbint_pic_nr(){
	?>
    	<input type="text" name="wpfbint_pic_nr" id="wpfbint_pic_nr"   value="<?php echo  esc_attr(get_option('wpfbint_pic_nr')); ?>" />
    <?php
}

function wpfbint_panel_fields(){

	add_settings_section("general", "", null, "general-options");
	add_settings_field("wpfbint_page_id", "Facebook Page ID", "wpfbint_page_id", "general-options", "general");
	
	add_settings_section("gallery", "", null, "gallery-options");
	add_settings_field("wpfbint_pic_nr", "Number of Pics in Gallery", "wpfbint_pic_nr", "gallery-options", "gallery");
	
	register_setting("general", "wpfbint_page_id");
	register_setting("gallery", "wpfbint_pic_nr");
}
add_action("admin_init", "wpfbint_panel_fields");	

//MAIN SETTINGS FORM FOR WP Facebook Integration Plugin

function wpfbint_settingsform() {
	?>
	<div class="wrap">
	
	<h2><img src='<?php echo plugins_url( 'images/wpfbint.png', __FILE__ ); ?>'style='width:100%'  /></h2>

	<form method="post" id='wpfbint_form'  action= "<?php echo admin_url( 'admin.php?page=wpfbint_settings' ); ?>">
		
        <?php
            if( isset( $_GET[ 'tab' ] ) ) {
                $active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : '';
            } // end if
        ?>
		 <h3>Get Picture Gallery from your FB Page with colorbox feature enabled.</h3><br/>
         <p><b>INSTRUCTIONS:</b> Insert your Facebook Page ID <a href='https://www.facebook.com/help/community/question/?id=378910098941520' target='_blank'>(How to Find Page ID)</a>. Then, use the shortcode [wpfbint_gallery] in any page or widget.</p>
        <h2 class="nav-tab-wrapper">
            <a href="?page=wpfbint_settings" class="nav-tab <?php echo $active_tab == '' ? 'nav-tab-active' : ''; ?>">General</a>
            <a href="?page=wpfbint_settings&tab=pic_options" class="nav-tab <?php echo $active_tab == 'pic_options' ? 'nav-tab-active' : ''; ?>">Gallery Options</a>
        </h2>
		
		<?php wpfbint_processData(); ?>
		
		<?php
        if( $active_tab == 'pic_options' ) {
			print "<p>You need to add <b>Photos in your Timeline</b> of your Fan Page for gallery to work.</p>";
            settings_fields( 'gallery-options' );
            do_settings_sections( 'gallery-options' );
			
        }else{
			print "<p>Facebook <b>Page ID</b> is required to make any feature work.</p>";
            settings_fields( 'general-options' );
            do_settings_sections( 'general-options' );
        } // end if/else 
		?>
		<?php wp_nonce_field('fb_page_id'); ?>	
		<?php submit_button(); ?>

	</form>
	
	<hr>
	<h2><i><?php _e("You want to add FB Slideshow, FB Events, FB Posts, FB Map from your Facebook Page?","wpfbint");?></i> <a target='_blank' style='background:#0085ba;color:#fff;padding:5px;text-decoration:none;border-radius:5px;' href='http://webdeveloping.gr/product/wp-facebook-integration-premium/'><?php _e("Get WP Facebook Integration PREMIUM","wpfbint");?></a></h2>
	
	<hr>
	<a target='_blank' style='float:right' href='http://webdeveloping.gr/type/plugins'><img style='width:150px;height:100px;' src='<?php echo plugins_url( 'images/webdeveloping.png', __FILE__ ); ?>' alt='Get more plugins by webdeveloping.gr' title='Get more plugins by webdeveloping.gr' /></a>	
	</div>
	<?php  
	
}

//ON DEACTIVATION , DELETE THE OPTIONS CREATED

function wpfbint_deactivation() {
  delete_option('wpfbint_page_id');
  delete_option('wpfbint_pic_nr');
}
register_deactivation_hook( __FILE__, 'wpfbint_deactivation' );

?>