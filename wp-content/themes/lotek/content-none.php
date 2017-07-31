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

<div class="article-post">
	<article>
		<div class="article-head">
			<br>
			<h3><?php esc_html_e('Nothing Found Here!','lotek'); ?></h3>
		</div>	

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

		<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'lotek' ), admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'lotek' ); ?></p>
		<?php get_search_form(); ?>

		<?php else : ?>

		<p><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'lotek' ); ?></p>
		<?php get_search_form(); ?>

		<?php endif; ?>
		
	</article>
</div>


