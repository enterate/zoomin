<?php
/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if ( post_password_required() )
    return;
?>

<?php if( comments_open( ) ) : ?>
<div class="contain darkbg" >
	<div class="container">
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="divider clearfix"></div>
				<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php esc_html_e('Leave a comment','lotek');?></span></h4>
				<div class="comment-wrapper wow fadeInUp" data-wow-delay="0.4s">
					<i class="fa fa-pencil icon-title wow rotateIn" data-wow-delay="0.4s"></i>

 					<?php
		        		$commenter = wp_get_current_commenter();
		        		$req = get_option( 'require_name_email' );
						$aria_req = ( $req ? " aria-required='true'" : '' );

						$comment_args = array(
						'title_reply'=> esc_html__('','lotek'),
						'fields' => apply_filters( 'comment_form_default_fields', 
						array(
								'author' => '<div class="col-md-6 marginbot30">
												<input class="form-control input-lg" type="text" name="author" id="author" placeholder="'.esc_html__('Enter your full name...','lotek').'" ' . $aria_req . '   value="' . esc_attr( $commenter['comment_author'] ) . '"/>
											</div>',
								'email' =>'<div class="col-md-6 marginbot30">
												<input class="form-control input-lg" type="text" id="email" name="email" placeholder="'.esc_html__('Enter your email...','lotek').'" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" ' . $aria_req . '/>
											</div>',
								// 'url' => '
								// 			<input id="url" name="url" class="form-control" placeholder="Website" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '"  />
								// 			',
								) 
							),
						'comment_field' => '<div class="col-md-12 marginbot30">
												<textarea class="form-control input-lg" rows="9" id="comment" name="comment" placeholder="'.esc_html__('Your comment here...','lotek').'" '.$aria_req.'></textarea>	
											</div>',
						'id_form'=>'commentform',
						'id_submit' => 'submit',
						'class_submit'=>'btn btn-default btn-lg',
						'label_submit' => esc_html__('leave comment','lotek'),
						'must_log_in'=> '<p class="not-empty" style="margin-left:15px;">' .  sprintf( wp_kses(__( 'You must be <a href="%s">logged in</a> to post a comment.' ,'lotek'),array('a'=>array('href'=>array(),'title'=>array(),'target'=>array())) ), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
						'logged_in_as' => '<p class="not-empty" style="margin-left:15px;">' . sprintf( wp_kses(__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','lotek' ),array('a'=>array('href'=>array(),'title'=>array(),'target'=>array())) ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
						//'comment_notes_before' => '<h5 class="text-center">'.esc_html__('Your email is safe with us.','lotek').'</h5>',
						'comment_notes_after' => '',
						);
					?>
					<?php comment_form($comment_args); ?>

				</div>
			</div>
		</div>	
	</div>
</div>
<?php endif;?>

<?php if ( have_comments() ) : ?>
<div class="contain colorbg">
	<div class="container">		
		<div class="row">
			<div class="col-md-10 col-md-offset-1">
				<div class="divider clearfix"></div>
				<h4 class="heading wow flipInX" data-wow-delay="0.2s"><span><?php
		printf( _nx( 'Comment ( %1$s )', 'Comments ( %1$s )', get_comments_number(), 'comments_title', 'lotek' ),
			number_format_i18n( get_comments_number() ), get_the_title() );
	?></span></h4>
				<div class="comment-wrapper wow fadeInUp" data-wow-delay="0.4s">
					<i class="fa fa-comments icon-title wow rotateIn" data-wow-delay="0.4s"></i>
					<?php 
					$args = array(
						'walker'            => null,
						'max_depth'         => '',
						'style'             => 'div',
						'callback'          => 'lotek_theme_comment',
						'end-callback'      => null,
						'type'              => 'all',
						'reply_text'        => esc_html__('Reply','lotek'),
						'page'              => '',
						'per_page'          => '',
						'avatar_size'       => 50,
						'reverse_top_level' => null,
						'reverse_children'  => '',
						'format'            => 'html5', //or xhtml if no HTML5 theme support
						'short_ping'        => false, // @since 3.6,
					    'echo'     			=> true, // boolean, default is true
					);

					?>
					
				    <?php wp_list_comments($args);?>
				    
				    <?php
					// Are there comments to navigate through?
					if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					?>

					<ul class="pager">
						<li class="previous"><?php previous_comments_link( wp_kses(__( '<i class="fa fa-arrow-left"></i>  Previous', 'lotek' ), array('i'=>array('class'=>array())) ) ); ?></li>
						<li class="next"><?php next_comments_link( wp_kses(__( 'Next <i class="fa fa-arrow-right"></i>', 'lotek' ), array('i'=>array('class'=>array())) ) ); ?></li>
					</ul>	
					<?php endif;?>
				</div>
				<!-- <div class="divider pull-left"></div> -->
			</div>
		</div>			
	</div>
</div>
<?php endif;?>
