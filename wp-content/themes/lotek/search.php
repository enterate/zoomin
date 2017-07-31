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

global $theme_options;?>

<!-- Start page heading -->
<section id="page-heading" class="contain colorbg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4><?php printf(esc_html__('Search Results for "%s" Query','lotek'),get_search_query( ));?></h4>		
			</div>
		</div>
	</div>
</section>
<!-- End page heading -->
<div id="home"></div>

<!-- Start inner page -->
<div class="contain darkbg">
	<?php if($theme_options['blog_fullwidth']) :?>
	<div class="container-fluid no-padding">
	<?php else :?>
	<div class="container">
	<?php endif;?>
		<div class="row">
		<?php if(!empty($theme_options['blog_wrap_classes'])) :?>
			<div class="<?php echo esc_attr($theme_options['blog_wrap_classes'] );?>">
		<?php else :?>
			<div class="col-md-10 col-md-offset-1">
		<?php endif;?>
				<div class="divider clearfix"></div>
				<div class="blog">
				<?php 	$blog_icon = $theme_options['blog_icon'];
						$blog_icon = str_replace("fa ", "", str_replace("fa-", "", $blog_icon));
						if(!empty($blog_icon)) :
				?>
					<i class="fa fa-<?php echo esc_attr($blog_icon);?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
				<?php endif;?>

					<?php if($theme_options['blog_layout']==='left_sidebar'):?>
						<!-- sidebar start -->
						<aside  class="left-sidebar">
							<?php get_sidebar();?>
						</aside>
						<!-- sidebar end -->
					<?php endif;?>
					<?php if($theme_options['blog_layout']==='fullwidth'):?>
					<div class="article-wrapper no-sidebar">
					<?php else:?>
					<div class="article-wrapper">
					<?php endif;?>

					<?php if(have_posts()) : ?>
						<?php while(have_posts()) : the_post(); ?>
							
							<?php get_template_part( 'content', 'search' ); ?>

						<?php endwhile; ?>
					<?php else: ?>
						<?php get_template_part('content','none' ); ?>
					<?php endif; ?>
						
					<?php
						
							lotek_pagination('&laquo;','&raquo;');
					?>
						
					</div>
					
					<?php if($theme_options['blog_layout']==='right_sidebar'):?>
						<!-- sidebar start -->
						<aside  class="right-sidebar">
							<?php get_sidebar();?>
						</aside>
						<!-- sidebar end -->
					<?php endif;?>

				</div>
			</div>
		</div>
	</div>
</div>
<!-- end inner page -->
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