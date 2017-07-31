<?php
/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

 global $theme_options ;?>
	<!-- Start footer -->
	<footer class="lotek-footer">
		<div class="container">
			<div class="row">
				<?php 
				if(is_active_sidebar('footer-1')):?>
				<div class="col-md-3 col-sm-6">
					<?php dynamic_sidebar('footer-1');?>
				</div>
			        
			    <?php endif;?>
			    <?php 
				if(is_active_sidebar('footer-2')):?>
				<div class="col-md-3 col-sm-6">
					<?php dynamic_sidebar('footer-2');?>
				</div>
			        
			    <?php endif;?>
				<?php 
				if(is_active_sidebar('footer-3')):?>
				<div class="col-md-3 col-sm-6">
					<?php dynamic_sidebar('footer-3');?>
				</div>
			        
			    <?php endif;?>
			    <?php 
				if(is_active_sidebar('footer-4')):?>
				<div class="col-md-3 col-sm-6">
					<?php dynamic_sidebar('footer-4');?>
				</div>
			        
			    <?php endif;?>
			    <?php 
				if(is_active_sidebar('footer_columns_widget')){
			        dynamic_sidebar('footer_columns_widget');
			    }
			    ?>
			</div>
			<div class="row">
			
				<div class="col-md-12">
				<?php if(isset($theme_options['to_top_id'])) :?>
					<a href="<?php echo esc_url($theme_options['to_top_id'] );?>" class="totop wow rotateIn btn-scroll" data-wow-delay="0.4s"><?php echo wp_kses(__('<i class="fa fa-chevron-up"></i>','lotek'),array('i'=>array('class'=>array())) );?></a>
				<?php endif;?>
					<?php echo wp_kses( do_shortcode($theme_options['footer-socials']),array('p'=>array('class'=>array()),'a'=>array('class'=>array(),'href'=>array(),'target'=>array(),'data-wow-delay'=>array()),'i'=>array('class'=>array()),'img'=>array('class'=>array(),'src'=>array(),'alt'=>array(),'title'=>array(),) ) );?>
					<?php 
					if(is_active_sidebar('footer-widget')){
				        dynamic_sidebar('footer-widget');
				    }
				    ?>
				</div>
			</div>
		</div>
		<div class="subfooter">
			<?php echo wp_kses_post($theme_options['footer-text']);?>
		</div>
	</footer>
   

	<?php wp_footer(); ?>
	<?php if(isset($theme_options['custom-footer-script'])) {
    	echo htmlspecialchars_decode($theme_options['custom-footer-script']);
    } ?>
	
  </body>
</html>