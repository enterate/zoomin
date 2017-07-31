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

global $theme_options;
?>
<!-- Start page heading -->
<section id="page-heading" class="contain colorbg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<h4><?php single_post_title( );?></h4>
				<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_project_subtitle', true)!=="" ) : ?>
					<p><?php echo esc_html(get_post_meta($wp_query->get_queried_object_id(), '_cmb_project_subtitle', true));?></p>
				<?php endif;?>
						
			</div>
		</div>
	</div>
</section>
<!-- End page heading -->

<?php while(have_posts()) : the_post(); ?>
<?php 
	
?>
<!-- Start inner page -->
<div class="contain darkbg">
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="divider clearfix"></div>
				<div class="singlepost wow fadeInUp" data-wow-delay="0.4s">
				<?php 	$page_icon = get_post_meta(get_the_ID(), '_cmb_page_icon', true);
						$page_icon = str_replace("fa ", "", str_replace("fa-", "", $page_icon));
						if(!empty($page_icon)) :
				?>
					<i class="fa fa-<?php echo esc_attr($page_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
				<?php endif;?>
					<?php
					$gallery = get_post_gallery( get_the_ID(), false );
					if(isset($gallery['ids'])){ ?>
					<div class="flexslider wow fadeInUp" data-wow-delay="0.4s">
						<ul class="slides">
							<?php
								$gallery_ids = $gallery['ids'];
								$img_ids = explode(",",$gallery_ids);
								$i=1;
								foreach( $img_ids AS $img_id ){
								$image_src = wp_get_attachment_image_src($img_id,'');
							?>
                            <li><img src="<?php echo esc_attr($image_src[0] ); ?>" alt="<?php the_title();?>" class="img-responsive"></li>
                            <?php } ?>
						</ul>
					</div>
					
						<?php } ?>

					<article>
					<?php if($theme_options['folio_title'] || $theme_options['folio_author'] || $theme_options['folio_date'] || $theme_options['folio_cats'] || $theme_options['folio_comments']):?>
						<div class="article-head">
						<?php if($theme_options['folio_date']):?>
							<div class="date-post marginbot20">
								<span class="date"><?php the_time( esc_html__('d','lotek' ) ); ?></span>
								<span class="mo-year"><?php the_time( esc_html__('m-Y','lotek' ) );?></span>
							</div>
						<?php endif;?>
						<?php if($theme_options['folio_title']):?> 
							<h5><?php the_title( ); ?></h5>
						<?php endif;?>
							<ul class="meta-post">
							<?php if($theme_options['folio_author']):?> 
								<li><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></li>
							<?php endif;?>
							<?php if($theme_options['folio_cats']):?> 
								<li><i class="fa fa-file"></i> <?php the_terms( get_the_ID(), 'portfolio_cat' );?></li>
							<?php endif;?>
							<?php if($theme_options['folio_comments']):?> 
								<li><i class="fa fa-comment"></i> <?php comments_popup_link(esc_html__('0', 'lotek'), esc_html__('1', 'lotek'), esc_html__('%', 'lotek')); ?></li>
							<?php endif;?>
							</ul>
						</div>
					<?php endif;?> 


						
						<div class="row">
						<?php if( get_post_meta(get_the_ID(), '_cmb_product_details', true) ):?>
							<div class="col-md-8">
								<?php the_content( ); ?>
							</div>
							<div class="col-md-4">
								<div class="item-detail">
									<?php echo wp_kses_post( get_post_meta(get_the_ID(), '_cmb_product_details', true) );?>
								</div>
							</div>	
						<?php else :?>
							<div class="col-md-8">
								<?php the_content( ); ?>
							</div>
						<?php endif;?>
							<div class="clearfix"></div>
							<?php
							wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'lotek' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );
							?>							
						</div>
					</article>
					<?php lotek_post_nav();?>
				</div>

			</div>
		</div>							
	</div>
</div>
<!-- End inner page -->

<?php endwhile;?>


<?php
if( get_post_meta(get_the_ID(), '_cmb_show_related_folio', true) ):

	$item_cats = get_the_terms( get_the_ID(), 'portfolio_cat');
	$product_cats = array();
	foreach((array)$item_cats as $item_cat){
		$product_cats[] = $item_cat->slug;
	}
	//print_r($product_cats);
	$id = get_the_ID();
	$args = array(
			'post__not_in' => array( $id ),
			'post_type'=>'portfolio',
			'order_by'=>'date',
			'order'=>'DESC',
			'posts_per_page'=> get_post_meta(get_the_ID(), '_cmb_related_items', true),
			'tax_query' => array(
								array('taxonomy' => 'portfolio_cat',
								'field' => 'slug',
								'terms' => $product_cats
								)
							)
	);

	

	$related_folios = new WP_Query($args);
	
?>
<?php if($related_folios->have_posts()) : ?>
 
<!-- Start Products -->
	<section id="Products" class="contain darkbg">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="divider clearfix"></div>
					<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php esc_html_e('Other Products','lotek');?></span></h4>
				</div>
			</div>
		</div>
		<div class="Products-wrapper grid_col_<?php echo get_post_meta(get_the_ID(), '_cmb_columns_grid', true);?>">
		<?php 	$related_icon = get_post_meta(get_the_ID(), '_cmb_related_icon', true);
				$related_icon = str_replace("fa ", "", str_replace("fa-", "", $related_icon));
				if(!empty($related_icon)) :
		?>
			<i class="fa fa-<?php echo esc_attr($related_icon );?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
		<?php endif;?>
			<ul class="wow fadeInUp" data-wow-delay="0.4s">
			<?php while($related_folios->have_posts()) : $related_folios->the_post();?>
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

			<?php endwhile ;?>
			</ul>
		</div>		
	</section>
	<!-- End Products -->

<?php endif;

/* Restore original Post Data */
wp_reset_postdata();

?>

<?php endif;//end if show_related_folio?>

<?php comments_template( '/comments-portfolio.php'); ?>

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