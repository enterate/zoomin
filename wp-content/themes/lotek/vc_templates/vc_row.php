<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 *
 * @var $layout
 * @var $ses_title
 * @var $ses_icon
 * @var $slideshow_imgs
 * @var $slideshow_speed
 *
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image = $css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = '';
$output = $after_output = '';
$layout = $slideshow_imgs = $slideshow_speed = '';
//For versopm 1.x
$style = $ses_id = $ses_class = $ses_title = $ses_icon = $wrap_class = '';
if(!empty($ses_id)){
    $ses_id = ' id="'.$ses_id.'"';
}
if(!empty($ses_class)){
    $ses_class = ' class="'.$ses_class.'"';
}


$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if($layout == 'lotek_home_intro_sec'){
global $theme_options;
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'lotek_sec',
    'bgslider-wrapper',
    //$el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>


    
    <?php 
    if (!empty($slideshow_imgs)) {
        $slideshow_imgs_arrs = explode(",", $slideshow_imgs);
        $photosArray = array();
        foreach ($slideshow_imgs_arrs as $key => $sli) {
            if( wp_get_attachment_url( $sli ) ){
                $photosArray[] = wp_get_attachment_url( $sli ) ;
            }
        }

        $slideshowDatas = array();
        $slideshowDatas['speed'] = $slideshow_speed;
        $slideshowDatas['images'] = $photosArray;

        wp_enqueue_script("bgslider", get_template_directory_uri()."/js/bgslider/bgSlider.js",array(),false,true);

        wp_localize_script('bgslider', 'slideshowdatas', $slideshowDatas );

    ?>
    <div id="animated-bg">
        <div id="animated-bg1" class="bg-slider"></div>
        <div id="animated-bg2" class="bg-slider"></div>
        <div id="animated-bg3" class="bg-slider"></div>
    </div>
    <?php 
    } ?>


    <div class="home-contain">



        <?php 
            if ( ! empty( $full_width ) ) { ?>
            <div class="container-fluid">
        <?php }else { ?>
            <div class="container">
        <?php
        }    ?>

            <?php if(!empty($ses_title)):?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="divider clearfix"></div>
                        <h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php echo esc_html($ses_title );?></span></h4>
                    </div>
                </div>
            <?php endif;?>

            <?php if(!empty($ses_icon)):
                $ses_icon = str_replace("fa ", "", $ses_icon);
                $ses_icon = str_replace("fa-", "", $ses_icon);
            ?>
                <div class="row">
                    <div class="col-md-12">
                        <i class="fa fa-<?php echo esc_attr($ses_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
                    </div>
                </div>
            <?php endif;?>

                <div class="row <?php echo esc_attr($el_class );?>">
                    <?php echo wpb_js_remove_wpautop($content); ?>
                </div>
        
        </div>

    </div>
</section>

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
                if(is_page_template('homepage-v2.php' )){
                    
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
                }
                ?>        
        </div>
    </div>
</header>
<!-- End navigation -->
<?php
}elseif($layout == 'lotek_colorbg_sec'){ ?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'lotek_sec',
    'contain colorbg',
    //$el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php 
        if ( ! empty( $full_width ) ) { ?>
        <div class="container-fluid">
    <?php }else { ?>
        <div class="container">
    <?php
    }    ?>

        <?php if(!empty($ses_title)):?>
            <div class="row">
                <div class="col-md-12">
                    <div class="divider clearfix"></div>
                    <h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php echo esc_html($ses_title );?></span></h4>
                </div>
            </div>
        <?php endif;?>

        <?php if(!empty($ses_icon)):
            $ses_icon = str_replace("fa ", "", $ses_icon);
            $ses_icon = str_replace("fa-", "", $ses_icon);
        ?>
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-<?php echo esc_attr($ses_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
                </div>
            </div>
        <?php endif;?>

            <div class="row <?php echo esc_attr($el_class );?>">
                <?php echo wpb_js_remove_wpautop($content); ?>
            </div>
    
    </div>
</section>
<?php 
}elseif($layout == 'lotek_darkbg_sec'){ ?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'lotek_sec',
    'contain darkbg',
    //$el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php 
        if ( ! empty( $full_width ) ) { ?>
        <div class="container-fluid">
    <?php }else { ?>
        <div class="container">
    <?php
    }    ?>
        <?php if(!empty($ses_title)):?>
            <div class="row">
                <div class="col-md-12">
                    <div class="divider clearfix"></div>
                    <h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php echo esc_html($ses_title );?></span></h4>
                </div>
            </div>
        <?php endif;?>
        <?php if(!empty($ses_icon)):
            $ses_icon = str_replace("fa ", "", $ses_icon);
            $ses_icon = str_replace("fa-", "", $ses_icon);
        ?>
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-<?php echo esc_attr($ses_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
                </div>
            </div>
        <?php endif;?>

            <div class="row <?php echo esc_attr($el_class );?>">
                <?php echo wpb_js_remove_wpautop($content); ?>
            </div>

    </div>
</section>

<?php 
}elseif($layout == 'features_sec'){ ?>
<?php
$el_class = $this->getExtraClass( $el_class );

$css_classes = array(
    'lotek_sec',
    'contain darkbg',
    //$el_class,
    vc_shortcode_custom_css_class( $css ),
);

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( $css_classes ) ), $this->settings['base'], $atts ) );
?>
<section <?php
    echo isset($el_id) && !empty($el_id) ? "id='" . esc_attr($el_id) . "'" : ""; ?> <?php
    echo !empty($css_class) ? "class='" . esc_attr( trim( $css_class ) ) . "'" : ""; ?>>
    <?php 
        if ( ! empty( $full_width ) ) { ?>
        <div class="container-fluid">
    <?php }else { ?>
        <div class="container">
    <?php
    }    ?>
        <?php if(!empty($ses_title)):?>
            <div class="row">
                <div class="col-md-12">
                    <div class="divider clearfix"></div>
                    <h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php echo esc_html($ses_title );?></span></h4>
                </div>
            </div>
        <?php endif;?>
        <?php if(!empty($ses_icon)):
            $ses_icon = str_replace("fa ", "", $ses_icon);
            $ses_icon = str_replace("fa-", "", $ses_icon);
        ?>
            <div class="row">
                <div class="col-md-12">
                    <i class="fa fa-<?php echo esc_attr($ses_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
                </div>
            </div>
        <?php endif;?>
            <div class="features-body">
                <div class="row contain-body <?php echo esc_attr($el_class );?>">
                    <?php echo wpb_js_remove_wpautop($content); ?>
                </div>
            </div>

    </div>
</section>

<?php 
// for version 1.x
}elseif($layout === 'intro_sec'){
    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .= "\n\t\t".'<div class="container">';
            $output .= "\n\t\t\t".'<div class="row">';

                $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

            $output .="\n\t\t\t".'</div>';
        $output .="\n\t\t".'</div>';
    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
// }elseif($layout === 'features_sec'){
//     $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
//         $output .= "\n\t\t".'<div class="container">';
//             $output .= "\n\t\t\t".'<div class="row">';
//                 $output .= "\n\t\t\t\t".'<div class="col-md-12">';

//                 if($ses_title!=""){
//                     $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                
//                     $output .="\n\t\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
//                 }

//                 $output .="\n\t\t\t\t\t\t".'<div class="'.$wrap_class.'">';
//                 if($ses_icon !== ''){
//                     $output .="\n\t\t\t\t\t\t\t".'<i class="fa fa-'.$ses_icon.' icon-title wow rotateIn" data-wow-delay="0.4s"></i>';
//                 }
                    
//                     $output .="\n\t\t\t\t\t\t\t\t".'<div class="row contain-body">';

//                     $output .= "\n\t\t\t\t\t\t\t\t\t".wpb_js_remove_wpautop($content);

//                     $output .="\n\t\t\t\t\t\t\t\t".'</div>';
//                 $output .="\n\t\t\t\t\t\t\t\t".'</div>';

//                 $output .="\n\t\t\t\t\t\t".'</div>';
//             $output .="\n\t\t\t\t\t".'</div>';
//         $output .="\n\t\t\t".'</div>';
//     $output .="\n\t".'</section>'.$this->endBlockComment('row');
//     echo $output;
}elseif($layout === 'testimonials_sec'){
    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .= "\n\t\t".'<div class="container">';
        if($ses_title!=""){
            $output .= "\n\t\t\t".'<div class="row">';
                $output .= "\n\t\t\t\t".'<div class="col-md-12">';
                    $output .= "\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .= "\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .= "\n\t\t\t\t".'</div>';
            $output .= "\n\t\t\t".'</div>';
        }
            $output .= "\n\t\t\t".'<div class="row">';
                $output .= "\n\t\t\t\t".'<div class="col-md-8 col-md-offset-2">';
                    $output .= "\n\t\t\t\t\t".'<div class="row">';
                        $output .= "\n\t\t\t\t\t".wpb_js_remove_wpautop($content);
                    $output .= "\n\t\t\t\t\t".'</div>';
                $output .= "\n\t\t\t\t".'</div>';
            $output .= "\n\t\t\t".'</div>';  

        $output .= "\n\t\t".'</div>';
    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
}elseif($layout === 'products_sec'){
    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
    if($ses_title!=""){
        $output .="\n\t\t".'<div class="container">';
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-12">';
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
        $output .="\n\t\t".'</div>';
    }
        $output .="\n\t\t".'<div class="container-fluid">';
            $output .="\n\t\t".'<div class="row">';
                $output .= "\n\t\t\t".wpb_js_remove_wpautop($content);
            $output .="\n\t\t".'</div>';

        $output .="\n\t\t".'</div>';
             
    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
}elseif($layout === 'team_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .="\n\t\t".'<div class="container">';
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-10 col-md-offset-1">';
                if($ses_title !== ''){
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                }
                    
                    $output .="\n\t\t\t\t\t".'<div class="team-wrapper">';
                        $output .="\n\t\t\t\t\t\t".'<div class="team">';
                        if($ses_icon !== ''){
                            $output .="\n\t\t\t\t\t\t".'<i class="fa fa-'.$ses_icon.' icon-title centered wow rotateIn" data-wow-delay="0.4s"></i>';
                        }   
                            
                            $output .="\n\t\t\t\t\t\t".'<div class="row">';
                                $output .= "\n\t\t\t\t\t\t\t".wpb_js_remove_wpautop($content);
                            $output .="\n\t\t\t\t\t\t".'</div>';

                        $output .="\n\t\t\t\t\t\t".'</div>';
                    $output .="\n\t\t\t\t\t".'</div>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';          
        $output .="\n\t\t".'</div>';

    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
}elseif($layout === 'blog_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .="\n\t\t".'<div class="container">';
        if($ses_title!=""){
            
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-12">';
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
            
        }
            $output .="\n\t\t".'<div class="row">';
                $output .= "\n\t\t\t".'<div class="col-md-8 col-md-offset-2">';
                    $output .="\n\t\t\t\t".'<div class="row">';
                        $output .= "\n\t\t\t\t\t".wpb_js_remove_wpautop($content);
                    $output .= "\n\t\t\t\t".'</div>';
                $output .= "\n\t\t\t".'</div>';
            $output .="\n\t\t".'</div>';

        $output .="\n\t\t".'</div>';
             
    $output .="\n\t".'</section>'.$this->endBlockComment('row');
echo $output;
}elseif($layout === 'pricing_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .="\n\t\t".'<div class="container">';
        //if($ses_title!=""){
            
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-12">';
                if($ses_title !== ''){
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                }
                    
                    if($wrap_class === ''){
                        $wrap_class = 'pricing-wrapper';
                    }
                    $output .="\n\t\t\t\t\t".'<div class="'.$wrap_class.'">';
                    if($ses_icon !== ''){
                        $output .="\n\t\t\t\t\t\t".'<i class="fa fa-'.$ses_icon.' icon-title wow rotateIn" data-wow-delay="0.4s"></i>';
                    }
                        
                        $output .="\n\t\t\t\t\t\t".'<div class="row">';
                            $output .= "\n\t\t\t\t\t\t\t".wpb_js_remove_wpautop($content);
                        $output .="\n\t\t\t\t\t\t".'</div>';

                    $output .="\n\t\t\t\t\t".'</div>';

                $output .= "\n\t\t\t".'</div>';
            $output .="\n\t\t".'</div>';

        $output .="\n\t\t".'</div>';
             
    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
}elseif($layout === 'contact_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .="\n\t\t".'<div class="container">';
        if($ses_title!=""){
            
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-12">';
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
            
        }
            $output .="\n\t\t".'<div class="row">';
                $output .= "\n\t\t\t".'<div class="col-md-8 col-md-offset-2">';
                    $output .="\n\t\t\t\t".'<div class="row">';
                        $output .= "\n\t\t\t\t\t".wpb_js_remove_wpautop($content);
                        
                    $output .= "\n\t\t\t\t".'</div>';
                    $output .= "\n\t\t\t\t".'<div class="divider pull-left"></div>';
                $output .= "\n\t\t\t".'</div>';
            $output .="\n\t\t".'</div>';

        $output .="\n\t\t".'</div>';
             
    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
}elseif($layout === 'gen_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .="\n\t\t".'<div class="container">';
        if($ses_title!=""){
            
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-12">';
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
            
        }

        if($wrap_class !== ''){
            $output .= "\n\t\t".'<div class="'.$wrap_class.'">';

        }

            if($ses_icon !== ''){
                $output .="\n\t\t\t\t\t\t".'<i class="fa fa-'.$ses_icon.' icon-title wow rotateIn" data-wow-delay="0.4s"></i>';
            }

            $output .= "\n\t\t\t".'<div class="row">';

                $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

            $output .="\n\t\t\t".'</div>';

        if($wrap_class !== ''){
            $output .= "\n\t\t".'</div>';
        }

        $output .= "\n\t\t".'</div>';

    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;
}elseif($layout === 'gen_full_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        //$output .="\n\t\t".'<div class="container">';
        if($ses_title!=""){
            
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-12">';
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
            
        }

        if($wrap_class !== ''){
            $output .= "\n\t\t".'<div class="'.$wrap_class.'">';

        }

            if($ses_icon !== ''){
                $output .="\n\t\t\t\t\t\t".'<i class="fa fa-'.$ses_icon.' icon-title wow rotateIn" data-wow-delay="0.4s"></i>';
            }

            $output .= "\n\t\t\t".'<div class="row">';

                $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

            $output .="\n\t\t\t".'</div>';

        if($wrap_class !== ''){
            $output .= "\n\t\t".'</div>';
        }

        //$output .= "\n\t\t".'</div>';

    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output;

}elseif($layout === 'component_sec'){

    $output .="\n\t".'<section'.$ses_id.$ses_class.' '.$style.'>';
        $output .="\n\t\t".'<div class="container">';
        if($ses_title!=""){
            
            $output .="\n\t\t\t".'<div class="row">';
                $output .="\n\t\t\t\t".'<div class="col-md-10 col-md-offset-1">';
                    $output .="\n\t\t\t\t\t".'<div class="divider clearfix"></div>';
                    $output .="\n\t\t\t\t\t".'<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span>'.$ses_title.'</span></h4>';
                $output .="\n\t\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
            
        }

        $output .="\n\t\t\t".'<div class="row">';
            $output .="\n\t\t\t".'<div class="col-md-10 col-md-offset-1">';
                $output .="\n\t\t\t".'<div class="inner wow fadeInUp" data-wow-delay="0.4s">';
                if($ses_icon !== ''){
                    $output .="\n\t\t\t".'<i class="fa fa-'.$ses_icon.' icon-title wow rotateIn" data-wow-delay="0.4s"></i>';
                }
                    $output .="\n\t\t\t".'<div class="row '.$el_class.'">';

                        $output .= "\n\t\t\t\t".wpb_js_remove_wpautop($content);

                    $output .="\n\t\t\t".'</div>';
                $output .="\n\t\t\t".'</div>';
            $output .="\n\t\t\t".'</div>';
        $output .="\n\t\t\t".'</div>';

        $output .= "\n\t\t".'</div>';

    $output .="\n\t".'</section>'.$this->endBlockComment('row');
    echo $output; 
?>
<?php }else{

    wp_enqueue_script( 'wpb_composer_front_js' );

    $el_class = $this->getExtraClass( $el_class );

    $css_classes = array(
        'vc_row',
        'wpb_row', //deprecated
        'vc_row-fluid',
        $el_class,
        vc_shortcode_custom_css_class( $css ),
    );

    if (vc_shortcode_custom_css_has_property( $css, array('border', 'background') ) || $video_bg || $parallax) {
        $css_classes[]='vc_row-has-fill';
    }

    if (!empty($atts['gap'])) {
        $css_classes[] = 'vc_column-gap-'.$atts['gap'];
    }

    $wrapper_attributes = array();
    // build attributes for wrapper
    if ( ! empty( $el_id ) ) {
        $wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
    }
    if ( ! empty( $full_width ) ) {
        $wrapper_attributes[] = 'data-vc-full-width="true"';
        $wrapper_attributes[] = 'data-vc-full-width-init="false"';
        if ( 'stretch_row_content' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
        } elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
            $wrapper_attributes[] = 'data-vc-stretch-content="true"';
            $css_classes[] = 'vc_row-no-padding';
        }
        $after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
    }

    if ( ! empty( $full_height ) ) {
        $css_classes[] = 'vc_row-o-full-height';
        if ( ! empty( $columns_placement ) ) {
            $flex_row = true;
            $css_classes[] = 'vc_row-o-columns-' . $columns_placement;
            if ( 'stretch' === $columns_placement ) {
                $css_classes[] = 'vc_row-o-equal-height';
            }
        }
    }

    if ( ! empty( $equal_height ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-equal-height';
    }

    if ( ! empty( $content_placement ) ) {
        $flex_row = true;
        $css_classes[] = 'vc_row-o-content-' . $content_placement;
    }

    if ( ! empty( $flex_row ) ) {
        $css_classes[] = 'vc_row-flex';
    }

    $has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );

    $parallax_speed = $parallax_speed_bg;
    if ( $has_video_bg ) {
        $parallax = $video_bg_parallax;
        $parallax_speed = $parallax_speed_video;
        $parallax_image = $video_bg_url;
        $css_classes[] = 'vc_video-bg-container';
        wp_enqueue_script( 'vc_youtube_iframe_api_js' );
    }

    if ( ! empty( $parallax ) ) {
        wp_enqueue_script( 'vc_jquery_skrollr_js' );
        $wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
        $css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
        if ( false !== strpos( $parallax, 'fade' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fade';
            $wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
        } elseif ( false !== strpos( $parallax, 'fixed' ) ) {
            $css_classes[] = 'js-vc_parallax-o-fixed';
        }
    }

    if ( ! empty( $parallax_image ) ) {
        if ( $has_video_bg ) {
            $parallax_image_src = $parallax_image;
        } else {
            $parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
            $parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
            if ( ! empty( $parallax_image_src[0] ) ) {
                $parallax_image_src = $parallax_image_src[0];
            }
        }
        $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
    }
    if ( ! $parallax && $has_video_bg ) {
        $wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
    }
    $css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
    $wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

    $output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
    $output .= wpb_js_remove_wpautop( $content );
    $output .= '</div>';
    $output .= $after_output;

    echo $output;

}//end if($layout)
