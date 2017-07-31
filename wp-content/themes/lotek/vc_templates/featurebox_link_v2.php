<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $icon
 * @var $link
 * @var $content - shortcode content
 *
 * Shortcode class
 * @var $this WPBakeryShortCode_Featurebox_Link_V2
 */
$title = $icon = $link = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$icon = str_replace("fa ", "", $icon);
$icon = str_replace("fa-", "", $icon);
?>
<div class="features-box">
<?php if(!empty($icon)) :?>
<i class="fa fa-<?php echo esc_attr($icon );?> icon-feature"></i>
<?php endif;?>
<?php if(!empty($title)) :?>
<h5><?php echo esc_html($title);?></h5>
<?php endif;?>
<?php echo $content;?>
<?php if(!empty($link)) :?>
<div><a href="<?php echo esc_url($link );?>"><?php echo wp_kses(__('<i class="fa fa-link"></i> Learn more','lotek'), array('i'=>array('class'=>array())) );?></a></div>
<?php endif;?>
</div>