<?php

/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if (!function_exists('row_sc')) {
	$columnArray = array();

	function row_sc( $atts, $content="" ){
		global $columnArray;
		$id='';
		
		$params = shortcode_atts(array(
			  'id' => '',
			  'class' => '',
			  'animation'=>'0',
			  'effect'=>'fadeInDown',
			  'delay'=>''
		 ), $atts);
		
		if ($params['id']) 
			$id = 'id="' . $params['id'] . '"'; 
		$class = 'row';
		if(!empty($params['class'])){
			$class .= ' '.$params['class'];
		}

		if($params['animation'] == '1'){
			$class .= ' wow '.$params['effect'];
		}

		$class = 'class="'.$class.'"';
		if(!empty($params['delay'])){
			$class .=' data-wow-delay="'.$params['delay'].'"';
		}
		
		do_shortcode( $content );
		
		//Row
		$html = '<div '. $class . ' ' . $id . '>';
		//Columns
		foreach ($columnArray as $key=>$col){
			// Column effect
			//echo'<pre>';var_dump($col);die;
			if(!empty($col['class'])){
				$class = $col['class'];
			}else{
				$class = 'col-md-12';
			}

			if($col['animation'] == '1'){
				$class .= ' wow '.$col['effect'];
			}

			$class = 'class="'.$class.'"';
			if(!empty($col['delay'])){
				$class .=' data-wow-delay="'.$col['delay'].'"';
			}

			$html .='<div ' . $class . '>' . do_shortcode($col['content']) . '</div>';
		}

		$html .='</div>';
	
		$columnArray = array();	
		return $html;
	}
	
	add_shortcode( 'row', 'row_sc' );
		
	//Column Items
	function column_sc( $atts, $content="" ){
		global $columnArray;

		if(is_array($atts)){
			$class = isset($atts['class']) ? $atts['class'] : '';
			$animation = isset($atts['animation']) ? $atts['animation'] : '0';
			$effect = isset($atts['effect']) ? $atts['effect'] : 'fadeInLeft';
			$delay = isset($atts['delay']) ? $atts['class'] : '';
		}else{
			$class = '';
			$animation = '0';
			$effect = 'fadeInLeft';
			$delay = '';
		}


		$columnArray[] = array(
			'class'=>$class,
			'animation'=>$animation,
			'effect'=>$effect,
			'delay'=>$delay,
			'content'=> $content
		);
	}

	add_shortcode( 'column', 'column_sc' );	
}

if(!function_exists('icon_sc')) {

	function icon_sc( $atts, $content="" ) {
	
		extract(shortcode_atts(array(
			   'class' =>"fa fa-wordpress"
		 ), $atts));
		 
		return '<i class="'.$class.'"></i>' . $content;
	 
	}
		
	add_shortcode( 'icon', 'icon_sc' );
}

if (!function_exists('link_sc')) {

	function link_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'id'=>'',
			'class' => '',
			'link' => '#',
		 ), $atts));
		
		if (!empty($id)) 
			$id = 'id="' . $id . '"'; 
		$classes = 'iconlink';
		if(!empty($class)){
			$classes .= ' '.$class;
		}

		$html = '<a href="'.$link.'" '.$classes.'>'.do_shortcode($content ).'</a>';

		return $html;
	}

	add_shortcode( 'link', 'link_sc' );
}

if (!function_exists('iconlink_sc')) {

	function iconlink_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'id'=>'',
			'class' => '',
			'link' => '#',
			'animation'=>'0',
			'target'=>'',
			'effect'=>'bounceInDown',
			'delay'=>'',
			'iconclass'=>'fa fa-magic'
		), $atts));
		
		if (!empty($id)) 
			$id = 'id="' . $id . '"'; 
		$classes = 'iconlink';
		if(!empty($class)){
			$classes .= ' '.$class;
		}

		if($animation === '1'){
			$classes .= ' wow '.$effect;
		}

		$classes = 'class="'.$classes.'"';
		if(!empty($delay)){
			$classes .=' data-wow-delay="'.$delay.'"';
		}

		if(!empty($target)){
			$target = 'target="'.$target.'"';
		}

		$html = '<a href="'.$link.'" '.$classes.' '.$target.'><i class="'.$iconclass.'"></i></a>' . $content;

		return $html;
	}

	add_shortcode( 'iconlink', 'iconlink_sc' );
}

if (!function_exists('paragraph_sc')) {

	function paragraph_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'id'=>'',
			'class' => '',
			'wrapper'=>'p'
		 ), $atts));
		
		if (!empty($id)) 
			$id = 'id="' . $id . '"'; 
		if(!empty($class)){
			$class = 'class="'.$class.'"';
		}

		$html = '<'.$wrapper.' '.$id.' '.$class.'>' . do_shortcode($content ).'</'.$wrapper.'>';

		return $html;
	}

	add_shortcode( 'paragraph', 'paragraph_sc' );
}

if (!function_exists('icon_animated_sc')) {

	function icon_animated_sc( $atts, $content="" ){
		
		extract(shortcode_atts(array(
			'name'=>'quote-left',
			'extra_class' => '',
			'animation'=>'no',
			'effect'=>'bounceInDown',
			'delay'=>'',
		 ), $atts));
		
		$classes = 'fa fa-'.$name;
		if(!empty($extra_class)){
			$classes .= ' '.$extra_class;
		}

		if($animation === 'yes'){
			$classes .= ' wow '.$effect;
		}

		$classes = 'class="'.$classes.'"';
		if(!empty($delay)){
			$classes .=' data-wow-delay="'.$delay.'"';
		}

		$html = '<i '.$classes.'></i>' . $content;

		return $html;
	}

	add_shortcode( 'icon_animated', 'icon_animated_sc' );
}


?>