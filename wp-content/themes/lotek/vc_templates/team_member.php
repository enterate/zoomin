<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $extra_class
 * @var $name
 * @var $job
 * @var $photo
 * @var $animation
 * @var $effect
 * @var $delay
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_Team_Member_V2
 */
$extra_class = $name = $job = $photo = $animation =  $effect = $delay = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = 'team-box';
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

?>
<div class="<?php echo esc_attr($classes );?>"<?php echo esc_attr($aniData );?>>
	<div class="team-profile">
	<?php if(!empty($name)):?>
		<h6><?php echo esc_html($name );?></h6>
	<?php endif;?>
	<?php if(!empty($job)):?>
		<p><?php echo esc_html($job );?></p>
	<?php endif;?>
		<?php echo wpb_js_remove_wpautop( $content );?>			
	</div>
	<?php if(!empty($photo)){
		echo wp_get_attachment_image( $photo, 'lotek-member-thumb', '', array('class'=>'img-responsive') );
	}?>
</div>