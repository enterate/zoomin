<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $extra_class
 * @var $id
 * @var $show_avatar
 * @var $animation
 * @var $effect
 * @var $delay
 * Shortcode class
 * @var $this WPBakeryShortCode_Single_Testimonial
 */
$extra_class = $id = $show_avatar = $animation =  $effect = $delay = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!empty($id)){
	$args = array(
		'post_type'		 => 'testimonial',
	    'p' => $id,
	);
}else{
	$args = array(
		'post_type'		 => 'testimonial',
	    'p' => 1,
	);
}

$classes = 'testimoni-wrapper';
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
		<?php        
        while($testimonials->have_posts()) : $testimonials->the_post();  
        ?>
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
		<?php 
            endwhile; ?> 									
	</div>

<?php
}

/* Restore original Post Data */
wp_reset_postdata();

?>