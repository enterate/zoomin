<?php

/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

global $wp_query;

get_header(); ?>

<!-- Start page heading -->
<section id="page-heading" class="contain colorbg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4><?php single_post_title( ); ?></h4>		
				<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_description', true)!=="" ) : ?>
					<p><?php echo esc_html(get_post_meta($wp_query->get_queried_object_id(), '_cmb_page_description', true) );?></p>
				<?php endif;?>
			</div>
		</div>
	</div>
</section>
<!-- End page heading -->
<div id="home"></div>

<!-- Start inner page -->
<div class="contain darkbg">
	<div class="container">
		<div class="row">
			<div class="inner wow fadeInUp" data-wow-delay="0.4s">
			<?php if(get_post_meta(get_the_ID(), '_cmb_page_icon', true)!=="" ) : ?>
				<i class="fa fa-list icon-<?php echo esc_attr(get_post_meta(get_the_ID(), '_cmb_page_icon', true) ); ?> wow rotateIn" data-wow-delay="0.4s"></i>
			<?php endif;?>
				<div class="row">
					<div class="col-md-9 page-rightsidebar">
						<?php while(have_posts()) : the_post(); ?>
							<?php the_content(); ?>
							<?php wp_link_pages(); ?>
						<?php endwhile; ?>

					</div>
					<div class="col-md-3 col-sm-12" >
						<?php get_sidebar('page'); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>