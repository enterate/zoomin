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
				<h4><?php the_archive_title();?></h4>		
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
			</div>
		</div>
	</div>
	<?php if($theme_options['folio_fullwidth']) :?>
	<div class="container-fluid no-padding">

	<?php else :?>
	<div class="container">
	<?php endif;?>

		<div class="Products-wrapper grid_col_<?php echo esc_attr($theme_options['folio_column'] );?>">
		<?php 	$related_icon = $theme_options['product_icon'];
				$related_icon = str_replace("fa ", "", str_replace("fa-", "", $related_icon));
				if(!empty($related_icon)) :
		?>
			<i class="fa fa-<?php echo esc_attr($related_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
		<?php endif;?>
			<?php if(have_posts()) : ?>
				<ul class="wow fadeInUp" data-wow-delay="0.4s">
				<?php while(have_posts()) : the_post(); ?>
					
					<li>
						<div class="image-wrapper">
							<?php if( get_post_meta(get_the_ID(), '_cmb_show_popup', true) == 'yes' || get_post_meta(get_the_ID(), '_cmb_show_link', true) == 'yes') :?>
								<div class="image-caption">
								<?php if( get_post_meta(get_the_ID(), '_cmb_show_popup', true) == 'yes') :?>
									<a href="<?php echo get_post_meta( get_the_ID(), '_cmb_popup_link', true );?>" class="zoom" data-pretty="prettyPhoto"><i class="fa fa-search-plus"></i></a>
								<?php endif;?>
								<?php if( get_post_meta(get_the_ID(), '_cmb_show_link', true) == 'yes') :?>
									<div class="image-title"><a href="<?php the_permalink();?>"><?php the_title( );?></a></div>
								<?php endif;?>
								</div>	
							<?php endif;?>				
							<?php the_post_thumbnail('lotek-folio-thumb',array('class'=>'img-responsive') ); ?>
						</div>
					</li>
					
				<?php endwhile; ?>
				</ul>
			<?php else: ?>
					<?php get_template_part('content','none' ); ?>
			<?php endif; ?>


		</div>	
			<?php 

				lotek_pagination('&laquo;','&raquo;','',true);

			?>
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
 