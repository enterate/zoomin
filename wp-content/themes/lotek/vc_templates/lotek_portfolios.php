<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $extra_class
 * @var $count
 * @var $order_by
 * @var $order
 * @var $ids
 * @var $popup_link
 * @var $single_link
 * @var $grid_columns
 * @var $spacing
 * @var $animation
 * @var $effect
 * @var $delay
 * Shortcode class
 * @var $this WPBakeryShortCode_Lotek_Portfolio
 */
$extra_class = $count = $order_by = $order = $ids = $animation =  $effect = $delay = $popup_link = $single_link = $spacing = $grid_columns = '';

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if(!empty($ids)){
	$ids = explode(",", $ids);
	$args = array(
		'post_type'		 => 'portfolio',
	    'post__in' => $ids,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}else{
	$args = array(
	    'post_type'		 => 'portfolio',
	    'posts_per_page' => $count,
	    'order_by'=> $order_by,
	    'order'=> $order,
	);
}

$classes = 'Products-wrapper';
$aniData ='';
if(!empty($extra_class)){
	$classes .= ' '.$extra_class;
}
$classes .= ' grid_col_'.$grid_columns;
if($animation == 'yes'){
	$classes .= ' wow '.$effect;
	if(!empty($delay)){
		$aniData=' data-wow-delay="'.$delay.'"';
	}
}

$portfolios = new WP_Query($args);
?>
<?php if($portfolios->have_posts()) {       ?>

<div class="<?php echo esc_attr($classes );?>"<?php echo esc_attr($aniData );?>>
	<ul>
	<?php        
        while($portfolios->have_posts()) : $portfolios->the_post();  
    ?>
		<li <?php if(!empty($spacing)) echo ' style="padding:'.esc_attr($spacing ).';"';?>>
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
	<?php 
        endwhile; ?> 						
	</ul>
</div>

<?php
}

/* Restore original Post Data */
wp_reset_postdata();

?>