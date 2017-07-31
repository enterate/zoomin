<?php
/*
Plugin Name: Lotek Theme Plugins
Plugin URI: https://demowp.cththemes.net/lotek/
Description: A custom plugin for Lotek — Modern App Landing Page Wordpress Theme
Version: 1.0
Author: CTHthemes
Author URI: http://themeforest.net/user/cththemes
License: GNU General Public License version 3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/
if ( ! defined('ABSPATH') ) {
    die('Please do not load this file directly!');
}
define ('CTH_LOTEK_DIR',plugin_dir_path(__FILE__ ));
define ('CTH_LOTEK_DIR_URL',plugin_dir_url(__FILE__ ));
// admin style
add_action('admin_head', 'cth_lotek_admin_style');
if(!function_exists('cth_lotek_admin_style')){
    function cth_lotek_admin_style() {
        echo '<link rel="stylesheet" href="'.CTH_LOTEK_DIR_URL.'assets/admin/style.css" type="text/css" media="all" />';
    } 
}

function cth_register_cpt_Portfolio() {
    
    $labels = array( 
        'name' => __( 'Portfolio', 'cth-lotek-plugins' ),
        'singular_name' => __( 'Portfolio', 'cth-lotek-plugins' ),
        'add_new' => __( 'Add New Portfolio', 'cth-lotek-plugins' ),
        'add_new_item' => __( 'Add New Portfolio', 'cth-lotek-plugins' ),
        'edit_item' => __( 'Edit Portfolio', 'cth-lotek-plugins' ),
        'new_item' => __( 'New Portfolio', 'cth-lotek-plugins' ),
        'view_item' => __( 'View Portfolio', 'cth-lotek-plugins' ),
        'search_items' => __( 'Search Portfolios', 'cth-lotek-plugins' ),
        'not_found' => __( 'No Portfolios found', 'cth-lotek-plugins' ),
        'not_found_in_trash' => __( 'No Portfolios found in Trash', 'cth-lotek-plugins' ),
        'parent_item_colon' => __( 'Parent Portfolio:', 'cth-lotek-plugins' ),
        'menu_name' => __( 'Portfolios', 'cth-lotek-plugins' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Portfolios',
        'supports' => array( 'title', 'editor', 'thumbnail','comments'/*, 'post-formats'*/),
        'taxonomies' => array('portfolio_cat'),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 20,
        'menu_icon' => plugin_dir_url( __FILE__ ) .'assets/admin_ico_portfolio.png', 
        'show_in_nav_menus' => true,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => array( 'slug' => __('portfolio','cth-lotek-plugins') ),
        'capability_type' => 'post'
    );

    register_post_type( 'portfolio', $args );
}

//Register Portfolio 
add_action( 'init', 'cth_register_cpt_Portfolio' );


//create a custom taxonomy name it Skills for your posts

function cth_create_Skills_hierarchical_taxonomy() {

// Add new taxonomy, make it hierarchical like categories
//first do the translations part for GUI

  $labels = array(
    'name' => __( 'Portfolio Categories', 'cth-lotek-plugins' ),
    'singular_name' => __( 'Category', 'cth-lotek-plugins' ),
    'search_items' =>  __( 'Search Categories','cth-lotek-plugins' ),
    'all_items' => __( 'All Categories','cth-lotek-plugins' ),
    'parent_item' => __( 'Parent Category','cth-lotek-plugins' ),
    'parent_item_colon' => __( 'Parent Category:','cth-lotek-plugins' ),
    'edit_item' => __( 'Edit Category','cth-lotek-plugins' ), 
    'update_item' => __( 'Update Category','cth-lotek-plugins' ),
    'add_new_item' => __( 'Add New Category','cth-lotek-plugins' ),
    'new_item_name' => __( 'New Category Name','cth-lotek-plugins' ),
    'menu_name' => __( 'Portfolio Categories','cth-lotek-plugins' ),
  );     

// Now register the taxonomy

  register_taxonomy('portfolio_cat',array('portfolio'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_nav_menus'=> true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array( 'slug' => __('portfolio_cat','cth-lotek-plugins') ),
  ));

}

//Add Portfolio Skills
    
add_action( 'init', 'cth_create_Skills_hierarchical_taxonomy', 0 );


if(!function_exists('cth_portfolio_columns_head')){
    function cth_portfolio_columns_head($defaults) {
        $defaults['cth_portfolio_thumbnail'] = 'Thumbnail';
        $defaults['cth_portfolio_id'] = 'ID';
        
        //unset($defaults['date']);
        return $defaults;
    }
}
if(!function_exists('cth_portfolio_columns_content')){
    // CUSTOM POSTS
    function cth_portfolio_columns_content($column_name, $post_ID) {
        if ($column_name == 'cth_portfolio_id') {
            echo $post_ID;
        }
        if ($column_name == 'cth_portfolio_thumbnail') {
            echo get_the_post_thumbnail( $post_ID, 'full', array('style'=>'width:100px;height:auto;') );
        }
    }
}

add_filter('manage_portfolio_posts_columns', 'cth_portfolio_columns_head', 10);
add_action('manage_portfolio_posts_custom_column', 'cth_portfolio_columns_content', 10, 2);

//Register Testimonials 
add_action( 'init', 'lotek_register_cpt_Testimonials' );

if(!function_exists('lotek_register_cpt_Testimonials')){
    function lotek_register_cpt_Testimonials() {
        
        $labels = array( 
            'name' => __( 'Testimonials', 'cth-lotek-plugins' ),
            'singular_name' => __( 'Testimonial', 'cth-lotek-plugins' ),
            'add_new' => __( 'Add New Testimonial', 'cth-lotek-plugins' ),
            'add_new_item' => __( 'Add New Testimonial', 'cth-lotek-plugins' ),
            'edit_item' => __( 'Edit Testimonial', 'cth-lotek-plugins' ),
            'new_item' => __( 'New Testimonial', 'cth-lotek-plugins' ),
            'view_item' => __( 'View Testimonial', 'cth-lotek-plugins' ),
            'search_items' => __( 'Search Testimonials', 'cth-lotek-plugins' ),
            'not_found' => __( 'No Testimonials found', 'cth-lotek-plugins' ),
            'not_found_in_trash' => __( 'No Testimonials found in Trash', 'cth-lotek-plugins' ),
            'parent_item_colon' => __( 'Parent Testimonial:', 'cth-lotek-plugins' ),
            'menu_name' => __( 'Testimonials', 'cth-lotek-plugins' ),
        );

        $args = array( 
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'List Testimonial',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            // 'taxonomies' => array('skill'),
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 20,
            'menu_icon' => get_template_directory_uri(). '/images/admin_ico_testimonial.png', 
            'show_in_nav_menus' => true,
            'publicly_queryable' => false,
            'exclude_from_search' => true,
            'has_archive' => false,
            'query_var' => true,
            'can_export' => true,
            'rewrite' => true
        );

        register_post_type( 'Testimonial', $args );
    }
}
if(!function_exists('cth_testimonial_columns_head')){
    function cth_testimonial_columns_head($defaults) {
        $defaults['cth_testimonial_id'] = 'ID';
        
        //unset($defaults['date']);
        return $defaults;
    }
}
if(!function_exists('cth_testimonial_columns_content')){
    // CUSTOM POSTS
    function cth_testimonial_columns_content($column_name, $post_ID) {
        if ($column_name == 'cth_testimonial_id') {
            echo $post_ID;
        }
    }
}

add_filter('manage_testimonial_posts_columns', 'cth_testimonial_columns_head', 10);
add_action('manage_testimonial_posts_custom_column', 'cth_testimonial_columns_content', 10, 2);

if(!function_exists('cth_post_columns_head')){
    function cth_post_columns_head($defaults) {
        $defaults['cth_post_id'] = 'ID';
        
        //unset($defaults['date']);
        return $defaults;
    }
}
if(!function_exists('cth_post_columns_content')){
    // CUSTOM POSTS
    function cth_post_columns_content($column_name, $post_ID) {
        if ($column_name == 'cth_post_id') {
            echo $post_ID;
        }
    }
}

add_filter('manage_post_posts_columns', 'cth_post_columns_head', 10);
add_action('manage_post_posts_custom_column', 'cth_post_columns_content', 10, 2);

function cth_lotek_plugins_init() {
    $plugin_dir = basename(dirname(__FILE__));
    load_plugin_textdomain( 'cth-lotek-plugins', false, $plugin_dir . '/languages' );
}
add_action('plugins_loaded', 'cth_lotek_plugins_init');

add_shortcode('gallery', '__return_false');

?>