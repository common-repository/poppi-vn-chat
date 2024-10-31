<?php
/**
* Plugin Name: Poppi Live Chat
* Description: Poppi Live Chat plugin for your website. Chat with your website visitors, monitor website traffic and provide better customer support.
* Version: 1.0.0
* Author: Designveloper
* Author URI: http://designveloper.com
* License: Free
*/

class UrlPoppiChat {
	public function __construct() {
	  $this->plugin               = new stdClass;
	  $this->plugin->name         = 'poppi-chat';
		$this->plugin->id        		= 'site-poppi-id';
	  $this->plugin->displayName  = 'Poppi Chat';
		$this->plugin->url          = plugin_dir_url( __FILE__ );
		add_action('admin_init', array(&$this, 'poppiSettings'));
		add_action('admin_menu', array(&$this, 'poppiAdminSettings'));
		add_action('wp_footer', array(&$this, 'poppiFrontend'));
		add_action( 'admin_enqueue_scripts',array(&$this,'load_poppi_settings_style'));
	}

	function poppiSettings() {
		register_setting($this->plugin->name, 'url_footer', 'trim');
		register_setting($this->plugin->id, 'site_poppi_id', 'trim');
	}
	function poppiAdminSettings() {
		add_submenu_page('options-general.php', $this->plugin->displayName, $this->plugin->displayName, 'manage_options', $this->plugin->name, array(&$this, 'adminPanel'));
	}
  function adminPanel() {
      if (isset($_POST['submit'])) {
      	if (!isset($_POST[$this->plugin->name.'_nonce'])) {
        	$this->errorMessage = __('Settings Poppi NOT saved.', $this->plugin->name);
      	} elseif (!wp_verify_nonce($_POST[$this->plugin->name.'_nonce'], $this->plugin->name)) {
        	$this->errorMessage = __('Settings Poppi NOT saved.', $this->plugin->name);
      	} else {
					update_option('url_footer', $_POST['url_footer']);
					update_option('site_poppi_id', $_POST['site_poppi_id']);
					$this->message = __('Settings Saved.', $this->plugin->name);
				}
      }else{
				update_option('url_footer', 'http://poppi.vn/content/poppi.min.js');
			}
      $this->settings = array(
      	'url_footer' => stripslashes(get_option('url_footer')),
				'site_poppi_id' => stripslashes(get_option('site_poppi_id')),
      );
			include_once "view.php";
      // include_once(WP_PLUGIN_DIR.'/'.$this->plugin->name.'/view.php');
  }
	function load_poppi_settings_style() {
	  wp_register_style( 'poppi-admin_css', $this->plugin->url.'/poppistyle.css', false, '1.0.0' );
	  wp_enqueue_style( 'poppi-admin_css' );
	}
	function poppiFrontend() {
		$this->showScript('url_footer');
	}
	function showScript($setting) {

		if (is_admin() OR is_feed() OR is_robots() OR is_trackback()) {
			return;
		}
		$meta = get_option($setting);
		$site_poppi_id = get_option('site_poppi_id');
		if (empty($meta) && empty($site_poppi_id) ) {
			return;
		}
		if ((trim($meta) == '') && (trim($site_poppi_id) == '') ) {
			return;
		}
		//view on Site
		echo stripslashes("<script id='poppi-script' data-poppi-id='".$site_poppi_id."' type='text/javascript' src='".$meta."'></script>");
	}
}
$ihaf = new UrlPoppiChat();
?>
