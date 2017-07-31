<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $extra_class
 * @var $animation
 * @var $effect
 * @var $delay
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_Pricing_Plan
 */
$extra_class = $animation =  $effect = $delay = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$classes = 'pricing-box';
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
	<?php echo wpb_js_remove_wpautop( $content );?>			
</div>