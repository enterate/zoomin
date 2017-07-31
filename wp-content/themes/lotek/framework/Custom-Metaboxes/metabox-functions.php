<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/webdevstudios/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';

	/**
	 * Sample metabox to demonstrate each field type included
	 */
	$meta_boxes[] = array(
		'id'         => 'post_options',
		'title'      => 'Post Options',
		'pages'      => array('post'), // Post type
		'context'    => 'normal',
		'priority'   => 'high',
		'show_names' => true, // Show field names on the left
		'fields'     => array(
           array(
                'name' => 'oEmbed for Post Format',
                'desc' => 'Enter a youtube, twitter, or instagram URL. Supports services listed at <a href="http://codex.wordpress.org/Embeds">http://codex.wordpress.org/Embeds</a>.',
                'id'   => $prefix . 'embed_video',
                'type' => 'oembed',
            ),
           array(
                'name' => 'Post Subtitle',
                'desc' => 'Post Subtitle show in header section',
                'id'   => $prefix . 'post_subtitle',
                'type' => 'textarea_small',
            ),

		),
	);
    
    $meta_boxes[] = array(
        'id'         => 'product_fields',
        'title'      => 'Product Fields',
        'pages'      => array('product'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Product details',
                'desc' => 'Product details',
                'id' => $prefix . 'product_details',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => true, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10),
                    ),
            ),

            array(
                'name' => 'Product Subtitle',
                'desc' => 'Product Subtitle show in header section',
                'id'   => $prefix . 'project_subtitle',
                'type' => 'textarea_small',
            ),

            array(
                'name' => 'Related Items',
                'desc' => 'Number of items show in related items section',
                'id'   => $prefix . 'project_related',
                'type' => 'text',
                'default'=> 10
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'portfolio_fields',
        'title'      => esc_html__('Portfolio Grid View', 'lotek' ),
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Popup Image or Video Link',
                'desc' => 'Select image for popup or Youtube, Video, Soundcloud link',
                'id'   => $prefix . 'popup_link',
                'type'    => 'file',
            ),
            array(
                'name' => esc_html__( 'Show Popup','lotek' ),
                // 'desc' => esc_html__('Show Related Portfolios','lotek' ),
                'id'   => $prefix . 'show_popup',
                'type'    => 'select',
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'cmb' ),
                    'no' => esc_html__( 'No', 'cmb' ),
                ),
                'default'=>'yes',
            ),

            array(
                'name' => esc_html__( 'Show Link','lotek' ),
                // 'desc' => esc_html__('Show Related Portfolios','lotek' ),
                'id'   => $prefix . 'show_link',
                'type'    => 'select',
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'cmb' ),
                    'no' => esc_html__( 'No', 'cmb' ),
                ),
                'default'=>'yes',
            ),
            
        )
    );

    $meta_boxes[] = array(
        'id'         => 'portfolio_single_fields',
        'title'      => esc_html__('Portfolio Single View', 'lotek' ),
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            
            array(
                'name' => esc_html__( 'Portfolio Details', 'lotek' ),
                'desc' => esc_html__( 'Portfolio Details', 'lotek' ),
                'id' => $prefix . 'product_details',
                'type' => 'wysiwyg',
                'options' => array(
                    'wpautop' => true, // use wpautop?
                    'media_buttons' => true, // show insert/upload button(s)
                    'textarea_rows' => get_option('default_post_edit_rows', 10),
                    ),
            ),

            array(
                'name' => esc_html__( 'Portfolio Subtitle', 'lotek' ),
                'desc' => esc_html__( 'Show in header', 'lotek' ),
                'id'   => $prefix . 'project_subtitle',
                'type' => 'textarea_small',
            ),

            array(
                'name' => esc_html__( 'Page Icon', 'lotek' ),
                'desc' => wp_kses(__("Search icon : <a href='http://fontawesome.io/icons/' target='_blank'>FONT AWESOME</a>", 'lotek'),array('a'=>array('href'=>array(),'target'=>array()))),
                'id'   => $prefix . 'page_icon',
                'type'    => 'text',
                'default' => 'fa fa-image'
            ),

             
        )
    );
    
    $meta_boxes[] = array(
        'id'         => 'portfolio_related_fields',
        'title'      => esc_html__( 'Related Portfolios','lotek' ),
        'pages'      => array('portfolio'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            
            array(
                'name' => esc_html__( 'Show Related Portfolios','lotek' ),
                'desc' => esc_html__('Show Related Portfolios','lotek' ),
                'id'   => $prefix . 'show_related_folio',
                'type'    => 'select',
                'options' => array(
                    'yes' => esc_html__( 'Yes', 'cmb' ),
                    'no' => esc_html__( 'No', 'cmb' ),
                ),
                'default'=>'yes',
            ),
            array(
                'name' => esc_html__( 'Related Portfolios Icon', 'lotek' ),
                'desc' => wp_kses(__("Search icon : <a href='http://fontawesome.io/icons/' target='_blank'>FONT AWESOME</a>", 'lotek'),array('a'=>array('href'=>array(),'target'=>array()))),
                'id'   => $prefix . 'related_icon',
                'type'    => 'text',
                'default' => 'fa fa-image'
            ),

            array(
                'name' => esc_html__( 'Columns Grid','lotek' ),
                'desc' => esc_html__('Columns Grid','lotek' ),
                'id'   => $prefix . 'columns_grid',
                'type'    => 'select',
                'options' => array(
                    'one' => esc_html__( '1 Column', 'cmb' ),
                    'two' => esc_html__( '2 Columns', 'cmb' ),
                    'three' => esc_html__( '3 Columns', 'cmb' ),
                    'four' => esc_html__( '4 Columns', 'cmb' ),
                    'five' => esc_html__( '5 Columns', 'cmb' ),
                    'six' => esc_html__( '6 Columns', 'cmb' ),
                ),
                'default'=>'five',
            ),

            array(
                'name' => esc_html__( 'Related Items','lotek' ),
                'desc' => esc_html__( 'Number of items show in related items section', 'lotek' ),
                'id'   => $prefix . 'related_items',
                'type' => 'text',
                'default'=> 5
            ),

            

            

             
        )
    );

    $meta_boxes[] = array(
        'id'         => 'testimonial_fields',
        'title'      => 'Testimonial Fields',
        'pages'      => array('testimonial'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            
            array(
                'name' => 'Name',
                'desc' => 'Name, wrap with span tag to make TEXT unique',
                'id'   => $prefix . 'testimonial_name',
                'type' => 'textarea_small',
                'default'=>'<span>John</span> doe'
            ),

            array(
                'name' => 'Company',
                'desc' => 'Company name',
                'id'   => $prefix . 'testimonial_company',
                'type' => 'textarea_small',
            ),
            
            
        )
    );
    $meta_boxes[] = array(
        'id'         => 'homepage_setting',
        'title'      => 'Home Page Header (For Version 1.x only) - Replaced with "Homepage-Version 2" template and "Home Slideshow with Navigation" layout for header row section in version 2.x.',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'core', //hight, core, default, low
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(

            array(
                'name' => 'Use Header Intro',
                'desc' => 'Use Header Intro',
                'id'   => $prefix . 'header_intro',
                'type'    => 'select',
                'options' => array(
                    'yes' => __( 'Yes', 'cmb' ),
                    'no' => __( 'No', 'cmb' ),
                ),
                'default'=>'no',
            ),

            array(
                'name' => 'Background Picture 1',
                'desc' => 'Background Picture 1',
                'id'   => $prefix . 'bg_picture_1',
                'type'    => 'file',
            ),

            array(
                'name' => 'Background Picture 2',
                'desc' => 'Background Picture 2',
                'id'   => $prefix . 'bg_picture_2',
                'type'    => 'file',
            ),

            array(
                'name' => 'Background Picture 3',
                'desc' => 'Background Picture 3',
                'id'   => $prefix . 'bg_picture_3',
                'type'    => 'file',
            ),

            array(
                'name' => 'Background Picture 4',
                'desc' => 'Background Picture 4',
                'id'   => $prefix . 'bg_picture_4',
                'type'    => 'file',
            ),

            array(
                'name' => 'Background Picture 5',
                'desc' => 'Background Picture 5',
                'id'   => $prefix . 'bg_picture_5',
                'type'    => 'file',
            ),

            array(
                'name' => 'Header Content',
                'desc' => 'Header Content',
                'id' => $prefix . 'header_content',
                'type' => 'textarea',//'wysiwyg',
                // 'options' => array(
                //                  'wpautop' => false,
                //              ),
            ),
            array(
                'name' => esc_html__('Slideshow Speed','lotel'),
                //'desc' => 'Set Page Icon',
                'id'   => $prefix . 'slideshow_speed',
                'type'    => 'text',
                'default' => '8000'
            ),
        )
    );

    $meta_boxes[] = array(
        'id'         => 'page_setting',
        'title'      => 'Normal Page Setting',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'core', //hight, core, default, low
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(

            array(
                'name' => 'Page Icon',
                'desc' => 'Set Page Icon',
                'id'   => $prefix . 'page_icon',
                'type'    => 'text',
                'default' => 'title'
            ),


            
            array(
                'name' => 'Page Subtitle',
                'desc' => 'Set Page Subtitle display in header section',
                'id'   => $prefix . 'page_description',
                'type'    => 'textarea_small',
            ),
            
           
    
        )
    );
    

	/**
	 * Metabox for the user profile screen
	 */
	$meta_boxes['user_edit'] = array(
		'id'         => 'user_edit',
		'title'      => __( 'User Profile Metabox', 'cmb' ),
		'pages'      => array( 'user' ), // Tells CMB to use user_meta vs post_meta
		'show_names' => true,
		'cmb_styles' => false, // Show cmb bundled styles.. not needed on user profile page
		'fields'     => array(
			array(
				'name'     => __( 'Extra Info', 'cmb' ),
				'desc'     => __( 'field description (optional)', 'cmb' ),
				'id'       => $prefix . 'exta_info',
				'type'     => 'title',
				'on_front' => false,
			),
			array(
				'name'    => __( 'Avatar', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'avatar',
				'type'    => 'file',
				'save_id' => true,
			),
			array(
				'name' => __( 'Facebook URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'facebookurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Twitter URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'twitterurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Google+ URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'googleplusurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'Linkedin URL', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'linkedinurl',
				'type' => 'text_url',
			),
			array(
				'name' => __( 'User Field', 'cmb' ),
				'desc' => __( 'field description (optional)', 'cmb' ),
				'id'   => $prefix . 'user_text_field',
				'type' => 'text',
			),
		)
	);

	/**
	 * Metabox for an options page. Will not be added automatically, but needs to be called with
	 * the `cmb_metabox_form` helper function. See wiki for more info.
	 */
	$meta_boxes['options_page'] = array(
		'id'      => 'options_page',
		'title'   => __( 'Theme Options Metabox', 'cmb' ),
		'show_on' => array( 'key' => 'options-page', 'value' => array( $prefix . 'theme_options', ), ),
		'fields'  => array(
			array(
				'name'    => __( 'Site Background Color', 'cmb' ),
				'desc'    => __( 'field description (optional)', 'cmb' ),
				'id'      => $prefix . 'bg_color',
				'type'    => 'colorpicker',
				'default' => '#ffffff'
			),
		)
	);
	// Add other metaboxes as needed

	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
