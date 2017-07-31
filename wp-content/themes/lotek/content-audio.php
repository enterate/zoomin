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
?>

<div <?php post_class('article-post' );?>>
	<?php if(get_post_meta(get_the_ID(), '_cmb_embed_video', true)!=""): ?>
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


		<?php the_excerpt();?>

		<?php
		wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'lotek' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
			) );
		?>

		<a href="<?php the_permalink();?>"><?php _e('Read more...','lotek');?></a>
	</article>
</div>
