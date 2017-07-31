<?php
/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<!-- <label><span class="screen-reader-text"><?php echo _x( '', 'label','lotek') ?></span></label> -->
	<div class="input-group">
      <input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder','lotek' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( '', 'label','lotek' ) ?>"/>
      <span class="input-group-btn">
        <button class="btn btn-default" type="submit"><i class="fa fa-search"></i><?php //echo esc_attr_x( '', 'submit button','lotek' ) ?></button>
      </span>
    </div><!-- /input-group -->
</form>