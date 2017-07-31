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
global $wp_query, $theme_options;
?>

<!-- Start page heading -->
<section id="page-heading" class="contain colorbg">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h4><?php single_post_title( );?></h4>
				<?php if(get_post_meta($wp_query->get_queried_object_id(), '_cmb_post_subtitle', true)!=="" ) : ?>
					<p><?php echo get_post_meta($wp_query->get_queried_object_id(), '_cmb_post_subtitle', true);?></p>
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
	<?php while(have_posts()) : the_post(); ?>
		<div class="row">
		<?php if(!empty($theme_options['blog_wrap_classes'])) :?>
			<div class="<?php echo esc_attr($theme_options['blog_wrap_classes'] );?>">
		<?php else :?>
			<div class="col-md-10 col-md-offset-1">
		<?php endif;?>
			
				<div class="divider clearfix"></div>
				<div class="singlepost wow fadeInUp" data-wow-delay="0.4s">
				<?php 	$blog_icon = $theme_options['blog_icon'];
						$blog_icon = str_replace("fa ", "", str_replace("fa-", "", $blog_icon));
						if(!empty($blog_icon)) :
				?>
					<i class="fa fa-<?php echo esc_attr($blog_icon);?> icon-title wow rotateIn" data-wow-delay="0.4s"></i>
				<?php endif;?>

				<?php if($theme_options['blog_single_layout']==='left_sidebar'):?>
					<!-- sidebar start -->
					<aside  class="left-sidebar">
						<?php get_sidebar();?>
					</aside>
					<!-- sidebar end -->
				<?php endif;?>
				<?php if($theme_options['blog_single_layout']==='fullwidth'):?>
				<div class="article-wrapper no-sidebar">
				<?php else:?>
				<div class="article-wrapper">
				<?php endif;?>

				
					
				<?php
					$gallery = get_post_gallery( get_the_ID(), false );
					if(isset($gallery['ids'])) : ?>
					<div class="img-wrapp">
						<div class="flexslider">
							<ul class="slides">
							<?php
								$gallery_ids = $gallery['ids'];
								$img_ids = explode(",",$gallery_ids);
								
								foreach( $img_ids AS $img_id ){
							?>
								<li><?php wp_get_attachment_image( $img_id, 'lotek-blog-content', '', array('class'=>'img-responsive') );?></li>
							<?php } ?>
							</ul>
						</div>  
					</div>
				<?php elseif(get_post_meta(get_the_ID(), '_cmb_embed_video', true)!=""): ?>
					<div class="img-wrapp">
						<div class="video-container">
							<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cmb_embed_video', true) )); ?>
						</div><!-- end video-container -->
					</div>
				<?php elseif(has_post_thumbnail()): ?>
					<div class="img-wrapp">
						<?php the_post_thumbnail('lotek-blog-content',array('class'=>'img-responsive')); ?>
					</div><!-- end img-wrapp -->
				<?php endif; ?>

					<article>
					<?php $postformat = get_post_format( );
					if($postformat === 'quote'){
						echo '<br />';
						the_content( );
					}else{ ?>
						<?php if($theme_options['blog_title'] || $theme_options['blog_author_single'] || $theme_options['blog_date'] || $theme_options['blog_cats'] || $theme_options['blog_tags_single'] || $theme_options['blog_comments']):?>
							<div class="article-head">
							<?php if($theme_options['blog_date']):?>
								<div class="date-post marginbot20">
									<span class="date"><?php the_time( esc_html__('d','lotek' ) ); ?></span>
									<span class="mo-year"><?php the_time( esc_html__('m-Y','lotek' ) );?></span>
								</div>
							<?php endif;?>
							<?php if($theme_options['blog_title']):?> 
								<h5><?php the_title( ); ?></h5>
							<?php endif;?>
								<ul class="meta-post">
								<?php if($theme_options['blog_author_single']):?> 
									<li><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></li>
								<?php endif;?>
								<?php if($theme_options['blog_cats']):?> 
									<?php if(get_the_category( )) { ?>
									<li><i class="fa fa-file"></i> <?php the_category( ', ');?></li>
									<?php } ?>
								<?php endif;?>
								<?php if($theme_options['blog_tags_single']):?> 
									<?php if(get_the_tags( )) { ?>
									<li><i class="fa fa-tags"></i> <?php the_tags( '',', ','' );?></li>
									<?php } ?>
								<?php endif;?>
								<?php if($theme_options['blog_comments']):?> 
									<li><i class="fa fa-comment"></i> <?php comments_popup_link(esc_html__('0', 'lotek'), esc_html__('1', 'lotek'), esc_html__('%', 'lotek')); ?></li>
								<?php endif;?>
								</ul>
							</div>
						<?php endif;?> 

						<?php the_content();?>	
					<?php } ?>				

						<?php
						wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'lotek' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</article>
					<?php lotek_post_nav();?>
				</div>

				<?php if($theme_options['blog_single_layout']==='right_sidebar'):?>
					<!-- sidebar start -->
					<aside  class="right-sidebar">
						<?php get_sidebar();?>
					</aside>
					<!-- sidebar end -->
				<?php endif;?>



				
			</div>
		</div>
	</div>

	<?php endwhile; ?>

<?php
if ( 'post' == get_post_type() && $theme_options['blog_related']) {
    $taxs = wp_get_post_terms( $post->ID ,'category');
    if ( $taxs ) {
        $tax_ids = array();
        foreach( $taxs as $individual_tax ) 
        	$tax_ids[] = $individual_tax->term_id;
        
        $args = array(
		    'tax_query' => array(
		        array(
		            'taxonomy'  => 'category',
		            'terms'     => $tax_ids,
		            'operator'  => 'IN'
		        )
		    ),
		    'post__not_in'          => array( $post->ID ),
		    'posts_per_page'        => 3,
		    'ignore_sticky_posts'   => 1
		);
         
        $related_posts = new wp_query( $args );
         
        if( $related_posts->have_posts() ) { ?>

		<div class="row">
			<div class="col-md-12">
				<div class="divider clearfix"></div>
				<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php esc_html_e('Related article','lotek');?></span></h4>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="blog-wrapper">
					<i class="fa fa-pencil icon-title wow rotateIn" data-wow-delay="0.4s"></i>
					<div class="flexslider wow rotateInDownLeft" data-wow-delay="0.4s">
						<ul class="slides">
					<?php
					while ( $related_posts->have_posts() ) :
		                $related_posts->the_post(); ?>

						<li>
							<div class="blog-box">
								<?php if( has_post_thumbnail( ) ){ ?>	
								<div class="blog-thumbls">
							        <?php the_post_thumbnail('lotek-blog-thumb',array('class'=>'img-responsive') ); ?>
								</div>
								
								<?php }elseif( get_post_meta(get_the_ID(), '_cmb_embed_video', true)!="" ){ ?>
								<div class="blog-thumbls">
									<div class="video-container">
										<?php echo wp_oembed_get(esc_url(get_post_meta(get_the_ID(), '_cmb_embed_video', true) )); ?>
									</div>
								</div>
								<?php } ?>

								<div class="artcle">
									<?php if($theme_options['blog_title'] || $theme_options['blog_author'] || $theme_options['blog_date'] || $theme_options['blog_cats'] || $theme_options['blog_tags'] || $theme_options['blog_comments']):?>
										<div class="article-head">
										<?php if($theme_options['blog_date']):?>
											<div class="date-post marginbot20">
												<span class="date"><?php the_time( esc_html__('d','lotek' ) ); ?></span>
												<span class="mo-year"><?php the_time( esc_html__('m-Y','lotek' ) );?></span>
											</div>
										<?php endif;?>
										<?php if($theme_options['blog_title']):?> 
											<h5><?php the_title( ); ?></h5>
										<?php endif;?>
											<ul class="meta-post">
											<?php if($theme_options['blog_author']):?> 
												<li><i class="fa fa-user"></i> <?php the_author_posts_link(); ?></li>
											<?php endif;?>
											<?php if($theme_options['blog_cats']):?> 
												<?php if(get_the_category( )) { ?>
												<li><i class="fa fa-file"></i> <?php the_category( ', ');?></li>
												<?php } ?>
											<?php endif;?>
											<?php if($theme_options['blog_tags']):?> 
												<?php if(get_the_tags( )) { ?>
												<li><i class="fa fa-tags"></i> <?php the_tags( '',', ','' );?></li>
												<?php } ?>
											<?php endif;?>
											<?php if($theme_options['blog_comments']):?> 
												<li><i class="fa fa-comment"></i> <?php comments_popup_link(esc_html__('0', 'lotek'), esc_html__('1', 'lotek'), esc_html__('%', 'lotek')); ?></li>
											<?php endif;?>
											</ul>
										</div>
									<?php endif;?> 

									<div class="article-post">
										<?php the_excerpt();?>
										<a href="<?php the_permalink();?>"><?php esc_html_e('Read more...','lotek');?></a>
									</div>
								</div>	
							</div>
						</li>

		            <?php
		            	endwhile; ?>

															
						</ul>
					</div>
				</div>
			</div>
		</div>	
<?php
        }
         
/* Restore original Post Data */
wp_reset_postdata();
         
    }
} ?>	



	</div><!-- end container -->
</div><!-- end contain -->

<?php comments_template(); ?>

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