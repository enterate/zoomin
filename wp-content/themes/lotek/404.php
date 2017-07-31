<?php
/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

 get_header(); 

 global $theme_option; ?>
<!-- Start page heading -->
<section id="page-heading" class="contain colorbg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               
                <h4><?php esc_html_e('Error 404','lotek');?></h4>
            </div>
        </div>
    </div>
</section>
<!-- End page heading -->

<!-- Start inner page -->
<div class="contain darkbg">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
            
                <div class="divider clearfix"></div>
                <div class="error404 wow fadeInUp" data-wow-delay="0.4s">
                    <i class="fa fa-exclamation icon-title wow rotateIn" data-wow-delay="0.4s"></i>


                    <div class="error-404 text-center">
                        <!-- <br><br><br><br><br> -->
                        <h2><span><?php esc_html_e('404','lotek');?></span></h2>
                        <p><?php echo esc_attr($theme_options['404_intro'] ); ?></p>
                        <?php if(!empty($theme_options['back_home_link'])) :?>
                        <a class="btn btn-flat btn-default" href="<?php echo esc_url($theme_options['back_home_link']); ?>"><?php esc_html_e('BACK TO HOME','lotek'); ?></a>
                        <?php endif;?>
                    </div>
                    <!-- <br><br><br> -->

                </div>
            </div>
        </div>
    </div>
</div>
<div class="contain colorbg">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="divider pull-left"></div>
            </div>
        </div>
    </div>
</div>
 <?php get_footer(); ?>