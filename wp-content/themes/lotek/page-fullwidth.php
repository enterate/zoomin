<?php

/**
 * Template Name: Fullwidth
 *
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

<?php while(have_posts()) : the_post(); ?>
	<?php the_content(); ?>
	<?php wp_link_pages(); ?>
<?php endwhile; ?>


<?php get_footer(); ?>