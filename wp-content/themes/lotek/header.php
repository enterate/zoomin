<?php
/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
global $theme_options; 
global $wp_query;
 ?> 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?php echo esc_url($theme_options['favicon']['url']);?>">
    <?php    
    
    wp_head(); ?>
  </head>

  <body <?php body_class(); ?>>
    <?php 
        if(is_page()){
            $header_intro = get_post_meta($wp_query->get_queried_object_id(), '_cmb_header_intro', true );
        }else{
            $header_intro = 'no';
        }

        if(!empty($header_intro) && $header_intro === 'yes') :?>

        <?php
            //global $post;
            $bg1 = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_bg_picture_1', true );
            $bg2 = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_bg_picture_2', true );
            $bg3 = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_bg_picture_3', true );
            $bg4 = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_bg_picture_4', true );
            $bg5 = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_bg_picture_5', true );

           
            $photosArray = array();
            if($bg1){
                $photosArray[] = esc_url($bg1);
            }
            if($bg2){
                $photosArray[] = esc_url($bg2);
            }
            if($bg3){
                $photosArray[] = esc_url($bg3);
            }
            if($bg4){
                $photosArray[] = esc_url($bg4);
            }
            if($bg5){
                $photosArray[] = esc_url($bg5);
            }

            $slideshowDatas = array();
            $slideshowDatas['speed'] = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_slideshow_speed', true );
            $slideshowDatas['images'] = $photosArray;

            wp_enqueue_script("bgslider", get_template_directory_uri()."/js/bgslider/bgSlider.js",array(),false,true);

            wp_localize_script('bgslider', 'slideshowdatas', $slideshowDatas );



        ?>
       
        <!-- Start home -->
        <section id="home" class="bgslider-wrapper">
            <div id="animated-bg">
                <div id="animated-bg1" class="bg-slider"></div>
                <div id="animated-bg2" class="bg-slider"></div>
                <div id="animated-bg3" class="bg-slider"></div>
            </div>
            <div class="home-contain">
                <div class="container">
                    <?php
                        $header_content = get_post_meta( $wp_query->get_queried_object_id(), '_cmb_header_content', true );
                        echo htmlspecialchars_decode(esc_html(do_shortcode($header_content)));
                    ?>
                </div>
            </div>
        </section>
        <!-- End home -->

    <?php endif;?>

    <!-- Start navigation -->
    <header>
        <div class="navbar navbar-default" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    


                    <a class="navbar-brand" href="<?php echo esc_url(home_url('/'));?>">
                    <?php if($theme_options['logo']['url']):?>
                        <img src="<?php echo esc_url($theme_options['logo']['url']);?>" width="<?php echo esc_attr($theme_options['logo_size_width'] );?>" height="<?php echo esc_attr($theme_options['logo_size_height'] );?>" class="logo-img" alt="<?php bloginfo('name');?>" />
                    <?php endif;?>
                    <?php if($theme_options['logo_text']):?>
                        <h1 class="logo_text"><?php echo esc_html($theme_options['logo_text']);?></h1>
                    <?php endif;?>
                    <?php if($theme_options['slogan']):?>
                        <h3 class="slogan"><em><?php echo esc_html($theme_options['slogan']);?></em></h3>
                    <?php endif;?>
                    </a>
                </div>
                <?php
                    if(is_page_template('homepage.php' )){
                        
                        $defaults1= array(
                            'theme_location'  => 'landing-menu',
                            'menu'            => '',
                            'container'       => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => '',
                            'menu_class'      => 'nav navbar-nav navbar-scroll',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                            'walker'          => new wp_bootstrap_navwalker(),
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                        );
                        
                        if ( has_nav_menu( 'landing-menu' ) ) {
                            wp_nav_menu( $defaults1 );
                        }
                    }else{
                        
                        $defaults1= array(
                            'theme_location'  => 'primary',
                            'menu'            => '',
                            'container'       => 'div',
                            'container_class' => 'collapse navbar-collapse',
                            'container_id'    => '',
                            'menu_class'      => 'nav navbar-nav',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                            'walker'          => new wp_bootstrap_navwalker(),
                            'before'          => '',
                            'after'           => '',
                            'link_before'     => '',
                            'link_after'      => '',
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'depth'           => 0,
                        );
                        if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu( $defaults1 );
                        }
                    }
                    ?>        
            </div>
        </div>
    </header>
    <!-- End navigation -->

