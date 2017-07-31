<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $extra_class
 * @var $count
 * @var $order_by
 * @var $order
 * @var $ids
 * @var $show_avatar
 * @var $autoplay
 * @var $animation
 * @var $effect
 * @var $delay
 * Shortcode class
 * @var $this WPBakeryShortCode_Testimonials_Slider
 */
$extra_class = $count = $order_by = $order = $ids = $show_avatar = $autoplay = $animation =  $effect = $delay = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

global $theme_options;

if(!empty($ids)){
	$ids = explode(",", $ids);
	$args = array(
		'post_type'		 => 'post',
	    'post__in' => $ids,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}else{
	$args = array(
	    'post_type'		 => 'post',
	    'posts_per_page' => $count,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}

$classes = 'posts_slider';
if($show_avatar == 'no'){
	$classes .= ' hide_feature_img';
}
$aniData ='';
if(!empty($extra_class)){
	$classes .= ' '.$extra_class;
}

if($animation == 'yes'){
	$classes .= ' wow '.$effect;
	if(!empty($delay)){
		$aniData=' data-wow-delay="'.$delay.'"';
	}
}

$posts = new WP_Query($args);
?>
<?php if($posts->have_posts()) {       ?>
<div class="<?php echo esc_attr($classes );?>"<?php echo esc_attr($aniData );?>>
	<div class="flexslider"  data-ss="<?php echo esc_attr($autoplay );?>">
		<ul class="slides">
		<?php        
        while($posts->have_posts()) : $posts->the_post();  
        ?>

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
						<div class="article-head">
						<?php if($theme_options['blog_date']) :?>
							<div class="date-post">
								<span class="date"><?php the_time(esc_attr__('d','lotek' ));?></span>
								<span class="mo-year"><?php the_time(esc_attr__('m-Y','lotek' ));?></span>
							</div>
						<?php endif;?>
							<h5><?php the_title( );?></h5>
							<?php if($theme_options['blog_author'] || $theme_options['blog_cats'] || $theme_options['blog_comments']):?>
							<ul class="meta-post">
								<?php if($theme_options['blog_author']) :?>
								<li><i class="fa fa-user"></i> <?php the_author_posts_link( );?></li>
								<?php endif;?>
								<?php if($theme_options['blog_cats']) :?>
									<?php if(get_the_category( )) { ?>
										<li><i class="fa fa-file"></i> 
										<?php the_category(', ' );?></li>				
									<?php } ?>	
								<?php endif;?> 
								<?php if($theme_options['blog_comments']) :?>
								<li><i class="fa fa-comment"></i> <?php comments_popup_link(__('0', 'lotek'), __('1', 'lotek'), __('%', 'lotek')); ?>
								<?php endif;?>
							</ul>
							<?php endif;?>
						</div>
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
<?php
}

/* Restore original Post Data */
wp_reset_postdata();

?>