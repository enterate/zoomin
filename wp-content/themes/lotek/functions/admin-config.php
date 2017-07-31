<?php
    /**
     * ReduxFramework Sample Config File
     * For full documentation, please visit: http://docs.reduxframework.com/
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }


    // This is your option name where all the Redux data is stored.
    $opt_name = "theme_options";

    // This line is only for altering the demo. Can be easily removed.
    //$opt_name = apply_filters( 'redux_demo/opt_name', $opt_name );

    /*
     *
     * --> Used within different fields. Simply examples. Search for ACTUAL DECLARATION for field examples
     *
     */

    $sampleHTML = '';
    if ( file_exists( dirname( __FILE__ ) . '/info-html.html' ) ) {
        Redux_Functions::initWpFilesystem();

        global $wp_filesystem;

        $sampleHTML = $wp_filesystem->get_contents( dirname( __FILE__ ) . '/info-html.html' );
    }

    // Background Patterns Reader
    $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
    $sample_patterns_url  = ReduxFramework::$_url . '../sample/patterns/';
    $sample_patterns      = array();

    if ( is_dir( $sample_patterns_path ) ) {

        if ( $sample_patterns_dir = opendir( $sample_patterns_path ) ) {
            $sample_patterns = array();

            while ( ( $sample_patterns_file = readdir( $sample_patterns_dir ) ) !== false ) {

                if ( stristr( $sample_patterns_file, '.png' ) !== false || stristr( $sample_patterns_file, '.jpg' ) !== false ) {
                    $name              = explode( '.', $sample_patterns_file );
                    $name              = str_replace( '.' . end( $name ), '', $sample_patterns_file );
                    $sample_patterns[] = array(
                        'alt' => $name,
                        'img' => $sample_patterns_url . $sample_patterns_file
                    );
                }
            }
        }
    }

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $args = array(
        // TYPICAL -> Change these values as you need/desire
        'opt_name'             => $opt_name,
        // This is where your data is stored in the database and also becomes your global variable name.
        'display_name'         => $theme->get( 'Name' ),
        // Name that appears at the top of your panel
        'display_version'      => $theme->get( 'Version' ),
        // Version that appears at the top of your panel
        'menu_type'            => 'menu',
        //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
        'allow_sub_menu'       => true,
        // Show the sections below the admin menu item or not
        'menu_title'           => esc_html__( 'Lotek Options', 'lotek' ),
        'page_title'           => esc_html__( 'Lotek Options', 'lotek' ),
        // You will need to generate a Google API key to use this feature.
        // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
        'google_api_key'       => 'AIzaSyBAycicE1b8x_pLv31OaST3vhIiCxW61kY',
        // Set it you want google fonts to update weekly. A google_api_key value is required.
        'google_update_weekly' => false,
        // Must be defined to add google fonts to the typography module
        'async_typography'     => true,
        // Use a asynchronous font on the front end or font string
        //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
        'admin_bar'            => true,
        // Show the panel pages on the admin bar
        'admin_bar_icon'       => 'dashicons-portfolio',
        // Choose an icon for the admin bar menu
        'admin_bar_priority'   => 50,
        // Choose an priority for the admin bar menu
        'global_variable'      => '',
        // Set a different name for your global variable other than the opt_name
        'dev_mode'             => false,
        // Show the time the page took to load, etc
        'update_notice'        => false,
        // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
        'customizer'           => true,
        // Enable basic customizer support
        //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
        //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

        // OPTIONAL -> Give you extra features
        'page_priority'        => null,
        // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
        'page_parent'          => 'themes.php',
        // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
        'page_permissions'     => 'manage_options',
        // Permissions needed to access the options panel.
        'menu_icon'            => '',
        // Specify a custom URL to an icon
        'last_tab'             => '',
        // Force your panel to always open to a specific tab (by id)
        'page_icon'            => 'icon-themes',
        // Icon displayed in the admin panel next to your menu_title
        'page_slug'            => '',
        // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
        'save_defaults'        => true,
        // On load save the defaults to DB before user clicks save or not
        'default_show'         => false,
        // If true, shows the default value next to each field that is not the default value.
        'default_mark'         => '',
        // What to print by the field's title if the value shown is default. Suggested: *
        'show_import_export'   => true,
        // Shows the Import/Export panel when not used as a field.

        // CAREFUL -> These options are for advanced use only
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
        'output_tag'           => true,
        // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
        // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

        // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
        'database'             => '',
        // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
        'use_cdn'              => true,
        // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.

        // HINTS
        'hints'                => array(
            'icon'          => 'el el-question-sign',
            'icon_position' => 'right',
            'icon_color'    => 'lightgray',
            'icon_size'     => 'normal',
            'tip_style'     => array(
                'color'   => 'red',
                'shadow'  => true,
                'rounded' => false,
                'style'   => '',
            ),
            'tip_position'  => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect'    => array(
                'show' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'mouseover',
                ),
                'hide' => array(
                    'effect'   => 'slide',
                    'duration' => '500',
                    'event'    => 'click mouseleave',
                ),
            ),
        )
    );

    // ADMIN BAR LINKS -> Setup custom links in the admin bar menu as external items.
    $args['admin_bar_links'][] = array(
        'id'    => 'redux-docs',
        'href'  => 'http://docs.reduxframework.com/',
        'title' => esc_html__( 'Documentation', 'lotek' ),
    );

    $args['admin_bar_links'][] = array(
        //'id'    => 'redux-support',
        'href'  => 'https://github.com/ReduxFramework/redux-framework/issues',
        'title' => esc_html__( 'Support', 'lotek' ),
    );

    $args['admin_bar_links'][] = array(
        'id'    => 'redux-extensions',
        'href'  => 'reduxframework.com/extensions',
        'title' => esc_html__( 'Extensions', 'lotek' ),
    );

    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => esc_html__('Visit us on GitHub', 'lotek' ),
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => esc_html__('Like us on Facebook', 'lotek' ),
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => esc_html__('Follow us on Twitter', 'lotek' ),
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => esc_html__('Find us on LinkedIn', 'lotek' ),
        'icon'  => 'el el-linkedin'
    );

    // Panel Intro text -> before the form
    if ( ! isset( $args['global_variable'] ) || $args['global_variable'] !== false ) {
        if ( ! empty( $args['global_variable'] ) ) {
            $v = $args['global_variable'];
        } else {
            $v = str_replace( '-', '_', $args['opt_name'] );
        }
        $args['intro_text'] = sprintf( wp_kses(__( '<p></p>', 'lotek' ),array('p'=>array(),'strong'=>array()) ) , $v );
    } else {
        $args['intro_text'] =  wp_kses(__( '<p></p>', 'lotek' ),array('p'=>array(),'strong'=>array()) );
    }

    // Add content after the form.
    $args['footer_text'] = wp_kses(__( '<p>Thanks all of you who stay with us, your co-operation is our inspiration. <a href="'.esc_url('http://themeforest.net/user/cththemes/portfolio/' ).'" target="_blank">CTHthemes</a></p>', 'lotek' ),array('p'=>array(),'strong'=>array(),'a'=>array('href'=>array(),'title'=>array())));

    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */


    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => esc_html__( 'Theme Information 1', 'lotek' ),
            'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'lotek' ),array('p'=>array('class'=>array())) )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => esc_html__( 'Theme Information 2', 'lotek' ),
            'content' => wp_kses(__( '<p>This is the tab content, HTML is allowed.</p>', 'lotek' ),array('p'=>array('class'=>array())) )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = wp_kses(__( '<p>This is the sidebar content, HTML is allowed.</p>', 'lotek' ),array('p'=>array('class'=>array())) );
    Redux::setHelpSidebar( $opt_name, $content );


    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */

    /*

        As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


     */
        //////////////// CUSTOM ///////////////

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Import Demo Data', 'lotek'),
        'id'         => 'import-demo-data',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-download',
        'fields' => array(
                array(
                    'id'       => 'im-demo-data',
                    'type'     => 'demo_data',
                    'title'    => esc_html__('Click button to import demo data', 'lotek'),
                    // 'subtitle' => esc_html__('', 'lotek'),
                    // 'desc'     => esc_html__('', 'lotek'),
                ),
            ),
    ));
    // -> START General Settings

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('General', 'lotek'),
        'id'         => 'general-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-cogs',
        'fields' => array(
            array(
                'id' => 'favicon',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Custom Favicon', 'lotek'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('Upload your Favicon.', 'lotek'),
                //'subtitle' => esc_html__('', 'lotek'),
                'default' => array('url' => get_template_directory_uri().'/images/favicon.png'),
            ),
            array(
                'id' => 'logo',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Logo', 'lotek'),
                //'compiler' => 'true',
                //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc' => esc_html__('Upload your logo.', 'lotek'),
                //'subtitle' => esc_html__('', 'lotek'),
                'default' => array('url' => get_template_directory_uri().'/images/logo-small.png'),
            ),

            array(
                'id' => 'logo_size_width',
                'type' => 'text',
                'title' => esc_html__('Logo Size Width', 'lotek'),
                // 'subtitle' => esc_html__('', 'lotek'),
                // 'desc' => esc_html__('', 'lotek'),
                'default' => '92'
            ),
            array(
                'id' => 'logo_size_height',
                'type' => 'text',
                'title' => esc_html__('Logo Size Height', 'lotek'),
                // 'subtitle' => esc_html__('', 'lotek'),
                // 'desc' => esc_html__('', 'lotek'),
                'default' => '28'
            ),
            array(
                'id' => 'logo_text',
                'type' => 'text',
                'title' => esc_html__('Logo Text', 'lotek'),
                // 'subtitle' => esc_html__('', 'lotek'),
                // 'desc' => esc_html__('', 'lotek'),
                'default' => ''
            ),
            array(
                'id' => 'slogan',
                'type' => 'text',
                'title' => esc_html__('Slogan (Sub Logo Text)', 'lotek'),
                // 'subtitle' => esc_html__('', 'lotek'),
                // 'desc' => esc_html__('', 'lotek'),
                'default' => ''
            ),
            array(
                'id' => 'disable_animation',
                'type' => 'switch',
                'title' => esc_html__('Disable Animation', 'lotek'),
                // 'subtitle' => esc_html__('Disable Animation', 'lotek'),
                // 'desc' => esc_html__('','lotek'),
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => false
            ),
            array(
                'id' => 'disable_mobile_animation',
                'type' => 'switch',
                'title' => esc_html__('Disable Animation on Mobile', 'lotek'),
                // 'subtitle' => esc_html__('Disable Animation', 'lotek'),
                // 'desc' => esc_html__('','lotek'),
                //'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
                'default' => false
            ),
        ),
    ) );


    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Footer', 'lotek'),
        'id'         => 'footer-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-pencil',
        'fields' => array(
            array(
                'id' => 'to_top_id',
                'type' => 'text',
                // 'url' => true,
                'title' => esc_html__('To Top ID', 'lotek'),
                // 'subtitle' => esc_html__('', 'lotek'),
                'desc' => esc_html__('Section ID will scroll to when click to To Top icon', 'lotek'),
                'default' => '#home',
            ),
            array(
                'id' => 'footer-socials',
                'type' => 'ace_editor',
                'mode'=>'html',
                // 'full_width'=>true,
                'title' => esc_html__('Footer Social Links', 'lotek'),
                //'subtitle' => esc_html__('', 'lotek'),
                //'desc' => esc_html__('Social Link', 'lotek'),
                'default' => '<p>Thanks for watching</p>
<a href="#" target="_blank" class="social-network wow bounceInDown" data-wow-delay="0.2s"><i class="fa fa-facebook"></i></a>
<a href="#" target="_blank" class="social-network wow bounceInDown" data-wow-delay="0.4s"><i class="fa fa-twitter"></i></a>
<a href="#" target="_blank" class="social-network wow bounceInDown" data-wow-delay="0.6s"><i class="fa fa-google-plus"></i></a>
<a href="#" target="_blank" class="social-network wow bounceInDown" data-wow-delay="0.8s"><i class="fa fa-linkedin"></i></a>
<a href="#" target="_blank" class="social-network wow bounceInDown" data-wow-delay="1s"><i class="fa fa-pinterest"></i></a>
<a href="#" target="_blank" class="social-network wow bounceInDown" data-wow-delay="1.2s"><i class="fa fa-dribbble"></i></a>'
            ),
            array(
                'id' => 'footer-text',
                'type' => 'editor',
                'mode'=>'html',
                //'full_width'=>true,
                'title' => esc_html__('Footer Copyright Text', 'lotek'),
                //'subtitle' => __('Copyright Text', 'lotek'),
                'default' => '<p class="copyrigh">2015 &copy; Copyright <a href="http://themeforest.net/user/cththemes">Cththemes</a>. All rights Reserved.</p>',
            ),

            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Color', 'lotek'),
        'id'         => 'styling-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-magic',
        'fields' => array(
            array(
                'id'       => 'color-preset',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Theme Color', 'lotek' ),
                'subtitle' => esc_html__( 'Select your theme color', 'lotek' ),
                'desc'     => esc_html__( 'Select your theme color', 'lotek' ),
                //Must provide key => value(array:title|img) pairs for radio options
                'options'  => array(
                    'default' => array(
                        'alt' => 'Default',
                        'img' => get_template_directory_uri(). '/functions/assets/default.png'
                    ),
                    'skin2' => array(
                        'alt' => 'Skin 2',
                        'img' => get_template_directory_uri(). '/functions/assets/skin2.png'
                    ),
                    'skin3' => array(
                        'alt' => 'Skin 3',
                        'img' => get_template_directory_uri(). '/functions/assets/skin3.png'
                    ),
                    'skin4' => array(
                        'alt' => 'Skin 4',
                        'img' => get_template_directory_uri(). '/functions/assets/skin4.png'
                    ),
                    'skin5' => array(
                        'alt' => 'Skin 5',
                        'img' => get_template_directory_uri(). '/functions/assets/skin5.png'
                    ),
                    'skin6' => array(
                        'alt' => 'Skin 6',
                        'img' => get_template_directory_uri(). '/functions/assets/skin6.png'
                    ),
                    'skin7' => array(
                        'alt' => 'Skin 7',
                        'img' => get_template_directory_uri(). '/functions/assets/skin7.png'
                    ),
                    'skin8' => array(
                        'alt' => 'Skin 8',
                        'img' => get_template_directory_uri(). '/functions/assets/skin8.png'
                    ),
                    'skin9' => array(
                        'alt' => 'Skin 9',
                        'img' => get_template_directory_uri(). '/functions/assets/skin9.png'
                    ),
                    'skin10' => array(
                        'alt' => 'Skin 10',
                        'img' => get_template_directory_uri(). '/functions/assets/skin10.png'
                    ),
                    'skin11' => array(
                        'alt' => 'Skin 11',
                        'img' => get_template_directory_uri(). '/functions/assets/skin11.png'
                    ),
                    'skin12' => array(
                        'alt' => 'Skin 12',
                        'img' => get_template_directory_uri(). '/functions/assets/skin12.png'
                    ),
                    'skin13' => array(
                        'alt' => 'Skin 13',
                        'img' => get_template_directory_uri(). '/functions/assets/skin13.png'
                    ),
                    'skin14' => array(
                        'alt' => 'Skin 14',
                        'img' => get_template_directory_uri(). '/functions/assets/skin14.png'
                    ),
                    'skin15' => array(
                        'alt' => 'Skin 15',
                        'img' => get_template_directory_uri(). '/functions/assets/skin15.png'
                    ),
                    'skin16' => array(
                        'alt' => 'Skin 16',
                        'img' => get_template_directory_uri(). '/functions/assets/skin16.png'
                    ),
                    'skin17' => array(
                        'alt' => 'Skin 17',
                        'img' => get_template_directory_uri(). '/functions/assets/skin17.png'
                    ),
                    'skin18' => array(
                        'alt' => 'Skin 18',
                        'img' => get_template_directory_uri(). '/functions/assets/skin18.png'
                    ),
                    'skin19' => array(
                        'alt' => 'Skin 19',
                        'img' => get_template_directory_uri(). '/functions/assets/skin19.png'
                    ),
                    'skin20' => array(
                        'alt' => 'Skin 20',
                        'img' => get_template_directory_uri(). '/functions/assets/skin20.png'
                    ),
                    
                ),
                'default'  => 'default'
            ),
            array(
                'id' => 'override-preset',
                'type' => 'select',
                'title' => esc_html__('Use Your Own', 'lotek'),
                'subtitle' => esc_html__('Set this to <b>Yes</b> if you want to use colors and divider image background bellow.', 'lotek'),
                'desc' => '',
                'options' => array(
                                    'yes' => 'Yes', 
                                    'no' => 'No'
                                ), //Must provide key => value pairs for select options
                'default' => 'no'
            ),
            
            array(
                'id' => 'background-color',
                'type' => 'color',
                'title' => esc_html__('Theme Background Color', 'lotek'),
                'subtitle' => esc_html__('Pick the background color for the theme (default: #fe5d55).', 'lotek'),
                'default' => '#fe5d55',
                'validate' => 'color',
            ),
            array(
                'id' => 'dark-background-color',
                'type' => 'color',
                'title' => esc_html__('Theme Dark Background Color', 'lotek'),
                'subtitle' => esc_html__('Pick the dark background color for the theme (default: #363F48).', 'lotek'),
                'default' => '#363F48',
                'validate' => 'color',
            ),
            array(
                'id' => 'border-color',
                'type' => 'color',
                'title' => esc_html__('Theme Border Color', 'lotek'),
                'subtitle' => esc_html__('Pick the border color for the theme (default: #fe5d55).', 'lotek'),
                'default' => '#fe5d55',
                'validate' => 'color',
                // 'mode'=>'border-color',
            ),
            array(
                'id' => 'navigation-bg-color',
                'type' => 'color',
                'title' => esc_html__('Navigation Background Color', 'lotek'),
                'subtitle' => esc_html__('Pick the navigation background color for the theme (default: #ffffff).', 'lotek'),
                'default' => '#ffffff',
                'validate' => 'color',
            ),
            array(
                'id' => 'footer-bg-color',
                'type' => 'color',
                'title' => esc_html__('Footer Background Color', 'lotek'),
                'subtitle' => esc_html__('Footer background color (default: #363F48).', 'lotek'),
                'default' => '#363F48',
                'validate' => 'color',
            ),
            array(
                'id' => 'footer-copyright-bg-color',
                'type' => 'color',
                'title' => esc_html__('Footer Copyright Background Color', 'lotek'),
                'subtitle' => esc_html__('Footer copyright background color (default: #252C33).', 'lotek'),
                'default' => '#252C33',
                'validate' => 'color',
            ),
            
            array(
                'id' => 'text-color',
                'type' => 'color',
                'title' => esc_html__('Theme Text Color', 'lotek'),
                'subtitle' => esc_html__('Pick the text color for the theme (default: #fe5d55).', 'lotek'),
                'default' => '#fe5d55',
                'validate' => 'color',
            ),
            array(
                'id' => 'main-text-color',
                'type' => 'color',
                'title' => esc_html__('Main Text Color', 'lotek'),
                'subtitle' => esc_html__('Pick the main text color for the theme (default: #2C323A).', 'lotek'),
                'default' => '#2C323A',
                'validate' => 'color',
            ),
            array(
                'id' => 'section-title-color',
                'type' => 'color',
                'title' => esc_html__('Section Title Color', 'lotek'),
                'subtitle' => esc_html__('Pick section title color for the theme (default: #2d3c3f).', 'lotek'),
                'default' => '#2d3c3f',
                'validate' => 'color',
            ),
            array(
                'id' => 'navigation-text-color',
                'type' => 'color',
                'title' => esc_html__('Menu Color', 'lotek'),
                'subtitle' => esc_html__('Pick the menu text color for the theme (default: #263740).', 'lotek'),
                'default' => '#263740',
                'validate' => 'color',
            ),
            array(
                'id' => 'navigation-active-text-color',
                'type' => 'color',
                'title' => esc_html__('Active Menu Color', 'lotek'),
                'subtitle' => esc_html__('Pick active menu text color for the theme (default: #fe5d55).', 'lotek'),
                'default' => '#fe5d55',
                'validate' => 'color',
               
            ),

            array(
                'id' => 'divider-image',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Upload your divider background', 'lotek'),
                'desc' => '',
                'subtitle' => '',
                'default' => array('url' => get_template_directory_uri().'/skins/default/divider-color-bg.png'),
            ),
            array(
                'id' => 'dark-divider-image',
                'type' => 'media',
                'url' => true,
                'title' => esc_html__('Upload your dark divider background', 'lotek'),
                'desc' => '',
                'subtitle' => '',
                'default' => array('url' => get_template_directory_uri().'/images/divider-dark-bg.png'),
            ),
            
        ),
    ) );
    
    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Typography', 'lotek'),
        'id'         => 'typography-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-font',
        'fields' => array(

            array(
                'id' => 'body-font',
                'type' => 'typography',
                'output' => array('body'),
                'title' => esc_html__('Body Font', 'lotek'),
                'subtitle' => wp_kses(__('Specify the body font properties.
                    Default - <br>font-family: Open Sans <br>font-size: 14px <br>line-height: 24px <br>font-weight: 400 <br>color: #2C323A', 'lotek'), array('br','p','strong') ),
                'google' => true,
            ),
            array(
                'id' => 'hyperlink-font',
                'type' => 'typography',
                'output' => array('a'),
                'title' => esc_html__('Hyperlink Font', 'lotek'),
                'subtitle' => wp_kses(__('Hyperlink font properties. Default - <br>font-family: Open Sans <br>font-size: 14px <br>line-height: 24px <br>font-weight: 400 </br>color: #FE5D55', 'lotek'), array('br','p') ),
                'google' => true,
            ),
            array(
                'id' => 'hyperlink-hover-font',
                'type' => 'typography',
                'output' => array('a:hover'),
                'title' => esc_html__('Hyperlink Hover Font', 'lotek'),
                'subtitle' => wp_kses(__('Hyperlink hover font properties. Default - <br>font-family: Open Sans <br>font-size: 14px <br>line-height: 24px <br>font-weight: 400  </br>color: #FE5D55', 'lotek'), array('br','p') ),
                'google' => true,
            ),
            array(
                'id' => 'paragraph-font',
                'type' => 'typography',
                'output' => array('p'),
                'title' => esc_html__('Paragraph Font', 'lotek'),
                'subtitle' => wp_kses(__('Specify paragraph font properties. Default - <br>font-family: Open Sans <br>font-size: 14px <br>line-height: 24px <br>font-weight: 400 <br>color: #2C323A', 'lotek'), array('br','p') ),
                'google' => true,
            ),

            array(
                'id' => 'header-font',
                'type' => 'typography',
                'output' => array('h1, h2, h3, h4, h5, h6'),
                'title' => esc_html__('Title-Header Font', 'lotek'),
                'subtitle' => wp_kses(__('Specify the title and heading font properties. Default - <br>font-family: Open Sans <br>font-weight: 500', 'lotek'), array('br','p') ),
                'google' => true,
            ),
            
            array(
                'id' => 'outdoor-navigation-font',
                'type' => 'typography',
                'output' => array('.navbar-default .navbar-nav li a'),
                'title' => esc_html__('Navigation Font', 'lotek'),
                'subtitle' => wp_kses(__('Theme navigation font. Default - <br>font-family: Open Sans <br>font-size: 14px <br>line-height: 14px <br>font-weight: 700 <br>color: #263740', 'lotek'), array('br','p') ),
                'google' => true,
            ),
            
            
        ),
    ) );
    
    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Portfolio', 'lotek'),
        'id'         => 'portfolio-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-briefcase',
        'fields' => array(
            array(
                'id'       => 'folio_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Title meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Author meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Date meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Categories meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'folio_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Comments meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),



            array(
                'id' => 'product_intro',
                'type' => 'editor',
                'title' => esc_html__('Portfolio Introduction Text ', 'lotek'),
                'subtitle' => '',
                'desc' => '',
                
                'default' => 'Possim virtute omnesque ea ius, nibh maiestatis assueverit ea pri. Erant argumentum vel ne. Id tale atqui everti nec, nam habeo ullum consetetur ne, ferri expetendis ius te. Ut vel aeque vivendum menandri, amet facer aperiam sit eu. Nam ludus inimicus. Eos ne dicta errem alterum.'
            ),

            array(
                'id' => 'product_icon',
                'type' => 'text',
                'title' => esc_html__('Archive Pages icon', 'lotek'),
                'subtitle' => wp_kses(__("Search icon : <a href='http://fontawesome.io/icons/' target='_blank'>FONT AWESOME</a>", 'lotek'),array('a'=>array('href'=>array(),'target'=>array()))),
                'desc' => esc_html__('Archive Pages icon', 'lotek'),
                
                'default' => 'fa fa-image'
            ),

            array(
                'id'       => 'folio_fullwidth',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Fullwidth', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),


            
            array(
                'id' => 'folio_column',
                'type' => 'select',
                'title' => esc_html__('Portfolio Columns', 'lotek'),
                // 'subtitle' => esc_html__('', 'lotek'),
                'desc' => '',
                'options' => array('six' => 'Six Columns','five' => 'Five Columns','four' => 'Four Columns', 'three' => 'Three Columns','two' => 'Two Columns', 'one' => 'One Column'), //Must provide key => value pairs for select options
                'default' => 'five'
            ),
            
            array(
                'id'       => 'folio_posts_per_page',
                'type'     => 'text',
                'title'    => esc_html__( 'Posts per page', 'lotek' ),
                'subtitle' => esc_html__( 'Number of post to show per page, -1 to show all posts.', 'lotek' ),
                'default'  => '-1',
            ),
        ),
    ) );


    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Blog', 'lotek'),
        'id'         => 'blog-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-website',
        'fields' => array(
            
            
            array(
                    'id' => 'blog_home_text',
                    'type' => 'text',
                    'title' => esc_html__('Blog Heading Text', 'lotek'),
                    // 'subtitle' => esc_html__('', 'lotek'),
                    // 'desc' => esc_html__('', 'lotek'),
                    'default' => 'Blog'
                ),
            array(
                'id' => 'blog_intro',
                'type' => 'editor',
                'title' => esc_html__('Blog Introduction Text ', 'lotek'),
                // 'subtitle' => '',
                // 'desc' => '',
                
                'default' => 'Possim virtute omnesque ea ius, nibh maiestatis assueverit ea pri. Erant argumentum vel ne. Id tale atqui everti nec, nam habeo ullum consetetur ne, ferri expetendis ius te. Ut vel aeque vivendum menandri, amet facer aperiam sit eu. Nam ludus inimicus. Eos ne dicta errem alterum.'
            ),
            array(
                'id' => 'blog_icon',
                'type' => 'text',
                'title' => __('Blog page icon ', 'lotek'),
                'subtitle' => __('Awesome icon name that show in blog page top position, leave it blank to remove.','lotek'),
                'desc' => wp_kses(__("Search icon : <a href='http://fontawesome.io/icons/' target='_blank'>FONT AWESOME</a>", 'lotek'),array('a'=>array('href'=>array(),'target'=>array()))),
                
                'default' => 'fa fa-book'
            ),
            array(
                    'id' => 'blog_wrap_classes',
                    'type' => 'text',
                    'title' => esc_html__('Blog Wrapper Classes', 'lotek'),
                    'subtitle' => esc_html__('Blog Wrapper Classes', 'lotek'),
                    // 'desc' => esc_html__('', 'lotek'),
                    'default' => 'col-md-10 col-md-offset-1'
            ),
            array(
                'id'       => 'blog_fullwidth',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Fullwidth', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => false,
            ),

            array(
                    'id'       => 'blog_layout',
                    'type'     => 'image_select',
                    //'compiler' => true,
                    'title'    => esc_html__( 'Blog Sidebar Layout', 'lotek' ),
                    'subtitle' => esc_html__( 'Select main content and sidebar layout.', 'lotek' ),
                    'options'  => array(
                        'fullwidth' => array(
                            'alt' => 'Fullwidth',
                            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                        ),
                        'left_sidebar' => array(
                            'alt' => 'Left Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                        ),
                        'right_sidebar' => array(
                            'alt' => 'Right Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        
                    ),
                    'default'  => 'right_sidebar'
                ),
            
            array(
                'id'       => 'blog_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Title meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Author meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            
            array(
                'id'       => 'blog_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Date meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Categories meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_tags',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Tags meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => false,
            ),
            
            array(
                'id'       => 'blog_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Comments meta', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),

            array(
                        'id' => 'blog_excerpt',
                        'type' => 'text',
                        'title' => esc_html__('Blog custom excerpt length', 'lotek'),
                        'subtitle' => esc_html__('The number of words you wish to display in the excerpt', 'lotek'),
                        // 'desc' => esc_html__('', 'lotek'),
                        'default' => '35'
                    ),
            array(
                    'id'       => 'blog_single_layout',
                    'type'     => 'image_select',
                    //'compiler' => true,
                    'title'    => esc_html__( 'Blog Single Sidebar', 'lotek' ),
                    'subtitle' => esc_html__( 'Select main content and sidebar layout.', 'lotek' ),
                    'options'  => array(
                        'fullwidth' => array(
                            'alt' => 'Fullwidth',
                            'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                        ),
                        'left_sidebar' => array(
                            'alt' => 'Left Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                        ),
                        'right_sidebar' => array(
                            'alt' => 'Right Sidebar',
                            'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                        ),
                        
                    ),
                    'default'  => 'fullwidth'
                ),
            array(
                'id'       => 'blog_author_single',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Author Block on single post page', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_tags_single',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Tags meta on single post page', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            array(
                'id'       => 'blog_related',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Related posts in single post page.', 'lotek' ),
                // 'subtitle' => esc_html__( '', 'lotek' ),
                'default'  => true,
            ),
            

        ),
    ) );


    Redux::setSection( $opt_name, array(
        'title' => esc_html__('404 Page', 'lotek'),
        'id'         => '404-intro-text-settings',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-file-edit',
        'fields' => array(
            array(
                'id' => '404_intro',
                'type' => 'editor',
                'title' => esc_html__('404 Page Message', 'lotek'),
                'subtitle' => '',
                'desc' => '',
                
                'default' => 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s homepage and see if you can find what you are looking for.'
            ),

            array(
                'id' => 'back_home_link',
                'type' => 'text',
                'title' => esc_html__('Back Home Link', 'lotek'),
                // 'desc' => esc_html__('', 'lotek'),
                'default' => esc_url( home_url('/' ) )
            ),
            
        ),
    ) );

    Redux::setSection( $opt_name, array(
        'title' => esc_html__('Custom Code', 'lotek'),
        'id'         => 'custom-code',
        'subsection' => false,
        //'desc'       => esc_html__( 'For full documentation on this field, visit: ', 'lotek' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
        'icon'       => 'el-icon-file-new',
        'fields' => array(
            array(
                'id' => 'custom-css',
                'type' => 'ace_editor',
                'title' => esc_html__('CSS Code', 'lotek'),
                'subtitle' => esc_html__('Paste your CSS code here.', 'lotek'),
                'mode' => 'css',
                //'compiler'=>array('body'),
                'full_width'=>true,
                'theme' => 'monokai',
                //'desc' => wp_kses(__('Possible modes can be found at <a href="'.esc_url('http://ace.c9.io' ).'" target="_blank">http://ace.c9.io/</a>.','lotek'),array('a'=>array('href','target')) ),
                'default' => ""
            ),
            
        ),
    ) );

    if ( file_exists( dirname( __FILE__ ) . '/../README.md' ) ) {
        $section = array(
            'icon'   => 'el el-list-alt',
            'title'  => esc_html__( 'Documentation', 'lotek' ),
            'fields' => array(
                array(
                    'id'       => '17',
                    'type'     => 'raw',
                    'markdown' => true,
                    'content_path' => dirname( __FILE__ ) . '/../README.md', // FULL PATH, not relative please
                    //'content' => 'Raw content here',
                ),
            ),
        );
        Redux::setSection( $opt_name, $section );
    }
    /*
     * <--- END SECTIONS
     */

    /*
     *
     * YOU MUST PREFIX THE FUNCTIONS BELOW AND ACTION FUNCTION CALLS OR ANY OTHER CONFIG MAY OVERRIDE YOUR CODE.
     *
     */

    /*
    *
    * --> Action hook examples
    *
    */

    // If Redux is running as a plugin, this will remove the demo notice and links
    //add_action( 'redux/loaded', 'remove_demo' );

    // Function to test the compiler hook and demo CSS output.
    // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
    add_filter('redux/options/' . $opt_name . '/compiler', 'compiler_action', 10, 3);

    // Change the arguments after they've been declared, but before the panel is created
    //add_filter('redux/options/' . $opt_name . '/args', 'change_arguments' );

    // Change the default value of a field after it's been set, but before it's been useds
    //add_filter('redux/options/' . $opt_name . '/defaults', 'change_defaults' );

    // Dynamically add a section. Can be also used to modify sections/fields
    //add_filter('redux/options/' . $opt_name . '/sections', 'dynamic_section');

    add_filter( "redux/" . $opt_name . "/field/class/demo_data", "overload_demo_data_field_path" ); // Adds the local field

    function overload_demo_data_field_path($field) {

        return get_template_directory().'/includes/demo_data_field/field_demo_data.php';
    }

    /**
     * This is a test function that will let you see when the compiler hook occurs.
     * It only runs if a field    set with compiler=>true is changed.
     * */
    if ( ! function_exists( 'compiler_action' ) ) {
        function compiler_action( $options, $css, $changed_values ) {
            /*echo '<h1>The compiler hook has run!</h1>';
            echo "<pre>";
            print_r( $changed_values ); // Values that have changed since the last save
            echo "</pre>";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )
            */
            $filename = get_template_directory() . '/skins/overridestyle' . '.css';
            global $wp_filesystem;
            if( empty( $wp_filesystem ) ) {
                require_once( ABSPATH .'/wp-admin/includes/file.php' );
                WP_Filesystem();
            }

            if( $wp_filesystem ) {
                $wp_filesystem->put_contents(
                    $filename,
                    $css,
                    FS_CHMOD_FILE // predefined mode settings for WP files
                );
            }

        }
    }

    /**
     * Custom function for the callback validation referenced above
     * */
    if ( ! function_exists( 'redux_validate_callback_function' ) ) {
        function redux_validate_callback_function( $field, $value, $existing_value ) {
            $error   = false;
            $warning = false;

            //do your validation
            if ( $value == 1 ) {
                $error = true;
                $value = $existing_value;
            } elseif ( $value == 2 ) {
                $warning = true;
                $value   = $existing_value;
            }

            $return['value'] = $value;

            if ( $error == true ) {
                $return['error'] = $field;
                $field['msg']    = 'your custom error message';
            }

            if ( $warning == true ) {
                $return['warning'] = $field;
                $field['msg']      = 'your custom warning message';
            }

            return $return;
        }
    }

    /**
     * Custom function for the callback referenced above
     */
    if ( ! function_exists( 'redux_my_custom_field' ) ) {
        function redux_my_custom_field( $field, $value ) {
            print_r( $field );
            echo '<br/>';
            print_r( $value );
        }
    }

    /**
     * Custom function for filtering the sections array. Good for child themes to override or add to the sections.
     * Simply include this function in the child themes functions.php file.
     * NOTE: the defined constants for URLs, and directories will NOT be available at this point in a child theme,
     * so you must use get_template_directory_uri() if you want to use any of the built in icons
     * */
    if ( ! function_exists( 'dynamic_section' ) ) {
        function dynamic_section( $sections ) {
            //$sections = array();
            $sections[] = array(
                'title'  => esc_html__( 'Section via hook', 'lotek' ),
                'desc'   => wp_kses(__( '<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'lotek' ),array('p'=>array('class'=>array())) ),
                'icon'   => 'el el-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }
    }

    /**
     * Filter hook for filtering the args. Good for child themes to override or add to the args array. Can also be used in other functions.
     * */
    if ( ! function_exists( 'change_arguments' ) ) {
        function change_arguments( $args ) {
            //$args['dev_mode'] = true;

            return $args;
        }
    }

    /**
     * Filter hook for filtering the default value of any given field. Very useful in development mode.
     * */
    if ( ! function_exists( 'change_defaults' ) ) {
        function change_defaults( $defaults ) {
            $defaults['str_replace'] = 'Testing filter hook!';

            return $defaults;
        }
    }

    /**
     * Removes the demo link and the notice of integrated demo from the redux-framework plugin
     */
    if ( ! function_exists( 'remove_demo' ) ) {
        function remove_demo() {
            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
                remove_filter( 'plugin_row_meta', array(
                    ReduxFrameworkPlugin::instance(),
                    'plugin_metalinks'
                ), null, 2 );

                // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
                remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
            }
        }
    }
