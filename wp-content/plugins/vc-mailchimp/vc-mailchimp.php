<?php
/*
Plugin Name: Visual Composer - Mailchimp
Plugin URI: https://webholics.org
Description: Add Mailchimp signup forms from Visual Composer Editor.
Version: 1.3
Author: Webholics
Author URI:  https://webholics.org
 */

// don't load directly
if ( !defined( 'ABSPATH' ) ) die( '-1' );

define( "VC_MAILCHIMP_DIR", WP_PLUGIN_DIR . "/" . basename( dirname( __FILE__ ) ) );
define( "VC_MAILCHIMP_URL", plugins_url() . "/" . basename( dirname( __FILE__ ) ) );

//Add Admin class
require_once (VC_MAILCHIMP_DIR.'/lib/class-vc-mailchimp-admin.php');
add_action( 'plugins_loaded', array( 'VC_Mailchimp_Admin', 'setup' ) );

//Add Shortcode class
require_once (VC_MAILCHIMP_DIR.'/lib/class-vc-mailchimp-shortcode.php');
add_action( 'plugins_loaded', array( 'VC_Mailchimp_Shortcode', 'setup' ) );

// Functions File
require_once (VC_MAILCHIMP_DIR.'/lib/functions.php');

