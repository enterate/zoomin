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

if(!empty($ids)){
	$ids = explode(",", $ids);
	$args = array(
		'post_type'		 => 'testimonial',
	    'post__in' => $ids,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}else{
	$args = array(
	    'post_type'		 => 'testimonial',
	    'posts_per_page' => $count,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}

$classes = 'testimonials_slider';
if($show_avatar == 'no'){
	$classes .= ' hide_avatar';
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

$testimonials = new WP_Query($args);
?>
<?php if($testimonials->have_posts()) {       ?>
<div class="<?php echo esc_attr($classes );?>"<?php echo esc_attr($aniData );?>>
	<div class="flexslider"  data-ss="<?php echo esc_attr($autoplay );?>">
		<ul class="slides">
		<?php        
        while($testimonials->have_posts()) : $testimonials->the_post();  
        ?>

			<li>
				<div class="testimoni-box">
					<div class="testimoni-avatar">
						<?php the_post_thumbnail('lotek-testi-thumb',array('class'=>'img-responsive') ); ?>
					</div>
					<div class="testimoni-text">
						<h3><?php echo get_post_meta( get_the_ID(), '_cmb_testimonial_name', true );?></h3>
						<?php the_content( ); ?>
						<span class="company-name"><?php echo get_post_meta( get_the_ID(), '_cmb_testimonial_company', true );?></span>
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