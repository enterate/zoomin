<?php

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */
add_action( 'vc_before_init', 'lotek_vcSetAsTheme' );
if(!function_exists('lotek_vcSetAsTheme')){
    function lotek_vcSetAsTheme() {
        vc_set_as_theme($disable_updater = true);
    }
}
if(!function_exists('lotek_echo_vc_custom_styles')){
    function lotek_echo_vc_custom_styles(){
        global $post;
        $cus_style_metas = get_post_meta( $post->ID, '_wpb_shortcodes_custom_css', true );
        if(!empty($cus_style_metas)){
            echo '<style>'.esc_attr($cus_style_metas).'</style>';
        }
    }
}

if(!function_exists('lotek_custom_css_classes_for_vc_row_and_vc_column')){
    //if(class_exists('WPBakeryVisualComposerSetup')){
    function lotek_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {
        // if ($tag == 'vc_row' || $tag == 'vc_row_inner') {
        //     $class_string = str_replace('vc_row', 'row', $class_string);
        // }
        // if ($tag == 'vc_column' || $tag == 'vc_column_inner') {
        //     $class_string = preg_replace('/vc_col-(xs|sm|md|lg)-(\d{1,2})/', 'col-$1-$2', $class_string);
        //     $class_string = preg_replace('/vc_col-(xs|sm|md|lg)-offset-(\d{1,2})/', 'col-$1-offset-$2', $class_string);
        // }

        if($tag=='vc_row' || $tag=='vc_row_inner') {
            $class_string = str_replace('vc_row-fluid', '', $class_string);
        }
        if($tag=='vc_column' || $tag=='vc_column_inner') {
            $class_string = preg_replace('/vc_span(\d{1,2})/', 'col-md-$1', $class_string);
        }


        return $class_string;
    }
}
// Filter to Replace default css class for vc_row shortcode and vc_column
add_filter('vc_shortcodes_css_class', 'lotek_custom_css_classes_for_vc_row_and_vc_column', 10, 2); 

// Add new Param in Row

if(function_exists('vc_add_param')){
        // vc_add_param('vc_row',array(
        //                           "type" => "textfield",
        //                           "heading" => __('Section id', 'lotek'),
        //                           "param_name" => "ses_id",
        //                           "value" => "",
        //                           "description" => __("Section id", 'lotek'),   
        // ));

        // vc_add_param('vc_row',array(
        //                           "type" => "textfield",
        //                           "heading" => __('Section Class', 'lotek'),
        //                           "param_name" => "ses_class",
        //                           "value" => "",
        //                           "description" => __("Section Class", 'lotek'),   
        // ));
        vc_add_param('vc_row',array(
                                  "type" => "textfield",
                                  "heading" => __('Section Title', 'lotek'),
                                  "param_name" => "ses_title",
                                  "value" => "",
                                  "description" => __("Title of Section ", 'lotek'),   
        ));

        vc_add_param('vc_row',array(
                                  "type" => "textfield",
                                  "heading" => __('Section icon', 'lotek'),
                                  "param_name" => "ses_icon",
                                  "value" => "",
                                  "description" => wp_kses(__("Search icon : <a href='http://fontawesome.io/icons/' target='_blank'>FONT AWESOME</a>", 'lotek'),array('a'=>array('href'=>array(),'target'=>array()))),
        ));

        // vc_add_param('vc_row',array(
        //                           "type" => "textfield",
        //                           "heading" => __('Wrap Class', 'lotek'),
        //                           "param_name" => "wrap_class",
        //                           "value" => "",
        //                           "description" => __("Wrap Class", 'lotek'),      
        //                         ) 
        // );
        vc_add_param('vc_row',array(
                                  "type" => "dropdown",
                                  "heading" => esc_html__('Section Layout', 'lotek'),
                                  "param_name" => "layout",
                                  "value" => array(   
                                                    esc_html__('Default', 'lotek') => 'default', 
                                                    esc_html__('Home Slideshow with Navigation', 'lotek') => 'lotek_home_intro_sec', 
                                                    esc_html__('Color Background Section', 'lotek') => 'lotek_colorbg_sec', 
                                                    esc_html__('Dark Background Section', 'lotek') => 'lotek_darkbg_sec', 
                                                    esc_html__('Features Section', 'lotek') => 'features_sec',


                                                     
                                                    esc_html__('Intro Section', 'lotek') => 'intro_sec',
                                                    
                                                    esc_html__('Testimonials Section','lotek') => 'testimonials_sec',
                                                    esc_html__('Products Section','lotek') => 'products_sec',
                                                    esc_html__('Team Section','lotek') => 'team_sec',
                                                    esc_html__('Blog Section','lotek') => 'blog_sec',
                                                    esc_html__('Pricing Section','lotek') => 'pricing_sec',
                                                    esc_html__('Contact Section','lotek') => 'contact_sec',
                                                    esc_html__('Component Section', 'lotek') => 'component_sec',
                                                    esc_html__('General Section', 'lotek') => 'gen_sec',
                                                    esc_html__('General Fullwidth Section', 'lotek') => 'gen_full_sec',
                                                  ),
                                  "description" => esc_html__("Select one of the pre made page sections or using default", 'lotek'),      
                                ) 
        );
        
        vc_add_param('vc_row',array(
                                "type" => "attach_images",
                                "class"=>"",
                                "heading" => esc_html__('Slideshow Background Image', 'lotek'),
                                "param_name" => "slideshow_imgs",
                                
                                //"description" => esc_html__("Set this to Yes if you want to display single item only", 'lotek'), 
                                'dependency' => array(
                                    'element' => 'layout',
                                    'value' => array( 'lotek_home_intro_sec' ),
                                    'not_empty' => false,
                                ),
                            )

        );

        vc_add_param('vc_row',array(
                                "type" => "textfield",
                                "heading" => esc_html__('Slideshow Speed', 'lotek'),
                                "param_name" => "slideshow_speed",
                                "value" => "8000",
                                "description" => esc_html__("Slideshow Speed", 'lotek'),
                                'dependency' => array(
                                    'element' => 'layout',
                                    'value' => array( 'lotek_home_intro_sec' ),
                                    'not_empty' => false,
                                ),
                            ) 

        );
        
        // Add new Param in Column

        // vc_add_param('vc_column',array(
        //                         "type" => "textfield",
        //                         "heading" => __('Wapper class', 'lotek'),
        //                         "param_name" => "wap_class",
        //                         "value" => "",
        //                         "description" => __("Wapper class", 'lotek'),
        //                         ) 

        // );

        vc_add_param('vc_column',array(
                                  "type" => "dropdown",
                                  "heading" => __('Use Animation', 'lotek'),
                                  "param_name" => "animation",
                                  "value" => array(   
                                                    __('No', 'lotek') => 'no',  
                                                    __('Yes', 'lotek') => 'yes',                                                                                
                                                  ),
                                  "description" => __("Use animation effect or not", 'lotek'),      
                                ) 
        );

        vc_add_param('vc_column',array(
                                  "type" => "dropdown",
                                  "heading" => __('Data effect', 'lotek'),
                                  "param_name" => "effect",
                                  "value" => array(
                                                    __('bounce','lotek')=>'bounce',
                                                    __('flash','lotek')=>'flash',
                                                    __('pulse','lotek')=>'pulse',
                                                    __('rubberBand','lotek')=>'rubberBand',
                                                    __('shake','lotek')=>'shake',
                                                    __('swing','lotek')=>'swing',
                                                    __('tada','lotek')=>'tada',
                                                    __('wobble','lotek')=>'wobble',

                                                    __('bounceIn','lotek')=>'bounceIn',
                                                    __('bounceInUp','lotek')=>'bounceInUp',
                                                    __('bounceInDown','lotek')=>'bounceInDown',
                                                    __('bounceInLeft','lotek')=>'bounceInLeft',
                                                    __('bounceInRight','lotek')=>'bounceInRight',
                                                    __('bounceOut','lotek')=>'bounceOut',
                                                    __('bounceOutUp','lotek')=>'bounceOutUp',
                                                    __('bounceOutDown','lotek')=>'bounceOutDown',
                                                    __('bounceOutLeft','lotek')=>'bounceOutLeft',
                                                    __('bounceOutRight','lotek')=>'bounceOutRight',

                                                    __('fadeIn','lotek')=>'fadeIn',
                                                    __('fadeInUp','lotek')=>'fadeInUp',
                                                    __('fadeInDown','lotek')=>'fadeInDown',
                                                    __('fadeInLeft','lotek')=>'fadeInLeft',
                                                    __('fadeInRight','lotek')=>'fadeInRight',
                                                    __('fadeInUpBig','lotek')=>'fadeInUpBig',
                                                    __('fadeInDownBig','lotek')=>'fadeInDownBig',
                                                    __('fadeInLeftBig','lotek')=>'fadeInLeftBig',
                                                    __('fadeInRightBig','lotek')=>'fadeInRightBig',

                                                    __('fadeOut','lotek')=>'fadeOut',
                                                    __('fadeOutUp','lotek')=>'fadeOutUp',
                                                    __('fadeOutDown','lotek')=>'fadeOutDown',
                                                    __('fadeOutLeft','lotek')=>'fadeOutLeft',
                                                    __('fadeOutRight','lotek')=>'fadeOutRight',
                                                    __('fadeOutUpBig','lotek')=>'fadeOutUpBig',
                                                    __('fadeOutDownBig','lotek')=>'fadeOutDownBig',
                                                    __('fadeOutLeftBig','lotek')=>'fadeOutLeftBig',
                                                    __('fadeOutRightBig','lotek')=>'fadeOutRightBig',

                                                    __('flipInX','lotek')=>'flipInX',
                                                    __('flipInY','lotek')=>'flipInY',
                                                    __('flipOutX','lotek')=>'flipOutX',
                                                    __('flipOutY','lotek')=>'flipOutY',
                                                    __('rotateIn','lotek')=>'rotateIn',
                                                    __('rotateInDownLeft','lotek')=>'rotateInDownLeft',
                                                    __('rotateInDownRight','lotek')=>'rotateInDownRight',
                                                    __('rotateInUpLeft','lotek')=>'rotateInUpLeft',
                                                    __('rotateInUpRight','lotek')=>'rotateInUpRight',

                                                    __('rotateOut','lotek')=>'rotateOut',
                                                    __('rotateOutDownLeft','lotek')=>'rotateOutDownLeft',
                                                    __('rotateOutDownRight','lotek')=>'rotateOutDownRight',
                                                    __('rotateOutUpLeft','lotek')=>'rotateOutUpLeft',
                                                    __('rotateOutUpRight','lotek')=>'rotateOutUpRight',

                                                    __('rotateOut','lotek')=>'rotateOut',
                                                    __('rotateOutDownLeft','lotek')=>'rotateOutDownLeft',
                                                    __('rotateOutDownRight','lotek')=>'rotateOutDownRight',
                                                    __('rotateOutUpLeft','lotek')=>'rotateOutUpLeft',
                                                    __('rotateOutUpRight','lotek')=>'rotateOutUpRight',

                                                    __('slideInDown','lotek')=>'slideInDown',
                                                    __('slideInLeft','lotek')=>'slideInLeft',
                                                    __('slideInRight','lotek')=>'slideInRight',
                                                    __('slideOutLeft','lotek')=>'slideOutLeft',
                                                    __('slideOutRight','lotek')=>'slideOutRight',
                                                    __('slideOutUp','lotek')=>'slideOutUp',
                                                    __('slideInUp','lotek')=>'slideInUp',
                                                    __('slideOutDown','lotek')=>'slideOutDown',

                                                    __('hinge','lotek')=>'hinge',

                                                    __('rollIn','lotek')=>'rollIn',
                                                    __('rollOut','lotek')=>'rollOut',
                                                    

                                                    __('zoomIn','lotek')=>'zoomIn',
                                                    __('zoomInUp','lotek')=>'zoomInUp',
                                                    __('zoomInDown','lotek')=>'zoomInDown',
                                                    __('zoomInLeft','lotek')=>'zoomInLeft',
                                                    __('zoomInRight','lotek')=>'zoomInRight',

                                                    __('zoomOut','lotek')=>'zoomOut',
                                                    __('zoomOutUp','lotek')=>'zoomOutUp',
                                                    __('zoomOutDown','lotek')=>'zoomOutDown',
                                                    __('zoomOutLeft','lotek')=>'zoomOutLeft',
                                                    __('zoomOutRight','lotek')=>'zoomOutRight',
                                                ),                              
                                    "description" => __("Add data effect", 'lotek'),
                                    'dependency' => array(
                                        'element' => 'animation',
                                        'value' => array( 'yes' ),
                                        'not_empty' => false,
                                    ),      
                                ) 

        );

        vc_add_param('vc_column',array(
                              "type" => "textfield",
                                  "heading" => __('Animation Delay', 'lotek'),
                                  "param_name" => "delay",
                                  "value" => "",
                                  "description" => __("Animation delay in second like 0.2s", 'lotek'),
                                    'dependency' => array(
                                        'element' => 'animation',
                                        'value' => array( 'yes' ),
                                        'not_empty' => false,
                                    ), 
                                ) 

        );

        // Add new Param in Accordion

    vc_add_param('vc_accordion',array(

                                  "type" => "textfield",
                                  "heading" => __('ID', 'lotek'),
                                  "param_name" => "id",
                                  "value" => "parentID",
                                  "description" => __("Id be matched with section parent id", 'lotek'),
                                ) 

        );

    vc_add_param('vc_accordion',array(

                                  "type" => "dropdown",
                                  "heading" => __('Style', 'lotek'),
                                  "param_name" => "style",
                                  "value" => array(
                                            __('Style 1','lotek')=>'style1',
                                            __('Style 2','lotek')=>'style2',
                                    ),
                                  "description" => __("Style: 1 - no border, 2: bordered", 'lotek'),
                                ) 

        );

    vc_add_param('vc_accordion_tab',array(

                                  "type" => "textfield",
                                  "heading" => __('Parent ID', 'lotek'),
                                  "param_name" => "parentid",
                                  "value" => "parentID",
                                  "description" => __("Enter parent id to take effect", 'lotek'),
                                ) 

        );

    vc_add_param('vc_accordion_tab',array(

                                  "type" => "textfield",
                                  "heading" => __('Icon', 'lotek'),
                                  "param_name" => "icon",
                                  "value" => "chevron-down",
                                  "description" => __("icon", 'lotek'),
                                ) 

        );

    // Add new Param in Tab

    vc_add_param('vc_tabs',array(

                                  "type" => "dropdown",
                                  "heading" => __('Style', 'lotek'),
                                  "param_name" => "style",
                                  "value" => array(
                                            __('Style 1','lotek')=>'style1',
                                            __('Style 2','lotek')=>'style2',
                                    ),
                                  "description" => __("Style: 1 - no border, 2: bordered", 'lotek'),
                                ) 

        );

     // vc_add_param('vc_message',array(

     //                              "type" => "dropdown",
     //                              "heading" => __('Close', 'lotek'),
     //                              "param_name" => "close",
     //                              "value" => array(
     //                                        __('Yes','lotek')=>'yes',
     //                                        __('No','lotek')=>'no',
     //                                ),
     //                              "description" => __("Show close button", 'lotek'),
     //                            ) 

     //    );


}
