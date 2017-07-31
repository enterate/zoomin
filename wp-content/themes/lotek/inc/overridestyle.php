<?php

/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if (!function_exists('lotek_hex2rgb')) {
    function lotek_hex2rgb($hex) {
        
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if (!function_exists('lotek_colourBrightness')) {
    
    /*
     * $hex = '#ae64fe';
     * $percent = 0.5; // 50% brighter
     * $percent = -0.5; // 50% darker
    */
    function lotek_colourBrightness($hex, $percent) {
        
        // Work out if hash given
        $hash = '';
        if (stristr($hex, '#')) {
            $hex = str_replace('#', '', $hex);
            $hash = '#';
        }
        
        /// HEX TO RGB
        $rgb = lotek_hex2rgb($hex);
        
        //// CALCULATE
        for ($i = 0; $i < 3; $i++) {
            
            // See if brighter or darker
            if ($percent > 0) {
                
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1 - $percent));
            } 
            else {
                
                // Darker
                $positivePercent = $percent - ($percent * 2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1 - $positivePercent));
            }
            
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        
        //// RBG to Hex
        $hex = '';
        for ($i = 0; $i < 3; $i++) {
            
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            
            // Add a leading zero if necessary
            if (strlen($hexDigit) == 1) {
                $hexDigit = "0" . $hexDigit;
            }
            
            // Append to the hex string
            $hex.= $hexDigit;
        }
        return $hash . $hex;
    }
}
if (!function_exists('lotek_bg_png')) {
    function lotek_bg_png($color, $input, $output) {
        $image = imagecreatefrompng($input);
        $rgbs = lotek_hex2rgb($color);
        $background = imagecolorallocate($image, $rgbs[0], $rgbs[1], $rgbs[2]);
        
        imagepng($image, $output);
    }
}

if (!function_exists('lotek_stripWhitespace')) {
    
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function lotek_stripWhitespace($content) {
        
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);
        
        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);
        
        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);
        
        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);
        
        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);
        
        return trim($content);
    }
}

if (!function_exists('lotek_add_rgba_background_inline_style')) {
    function lotek_add_rgba_background_inline_style($color = '#ed5153', $handle = 'skin') {
        $inline_style = '.testimoni-wrapper,.pricing-wrapper,.da-thumbs li  article,.team-caption,.home-centered{background-color:rgba(' . implode(",", hex2rgb($color)) . ', 0.9);}';
        wp_add_inline_style($handle, $inline_style);
    }
}

if (!function_exists('lotek_overridestyle')) {
    function lotek_overridestyle() {
        global $theme_options;
        
        $inline_style = '
body,
.colorbg,
.tags li a:hover,
.wp-tag-cloud li a:hover,
div.pp_default .pp_close:hover,
.icon-social:hover,
.pricing-price,
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus,
.navbar-default .navbar-toggle:active,
.subscribe-button:hover,
.pager li > a:hover,
.pager li > span:hover,
.item-detail,
.style2 .accordion-heading a:hover i,
.style1 .accordion-heading a:hover,
.style2 .wpb_accordion_header a:hover i,
.style1 .wpb_accordion_header a:hover,
.btn-flat,
#home .btn-flat:hover {background-color:' . $theme_options['background-color'] . ';}
.darkbg {background-color:' . $theme_options['dark-background-color'] . ';}
.navbar-default .navbar-nav li a.selected,
.navbar-default .navbar-nav .active a,
.navbar-default .navbar-nav .dropdown.active a,
.navbar-default .navbar-nav .active a:hover,
.navbar-default .navbar-nav .dropdown.active a:hover,
.navbar-default .navbar-nav .active a:focus,
.navbar-default .navbar-nav .dropdown.active a:focus,
.colorbg .icon-title,
.image-caption .zoom:hover,
.image-title a:hover,
.form-control:focus,
.totop,
.social-network:hover,
.navbar-default .navbar-toggle:hover,
.navbar-default .navbar-toggle:focus,
.navbar-default .navbar-toggle:active,
input.subscribe:focus,
.pager li > a:hover,
.pager li > span:hover,
.style2 .accordion-heading a:hover,
.style2 .wpb_accordion_header a:hover,
.tabbable.style1 .tabber li a:hover,
.tabbable.style2 .tabber li a:hover,
.tabbable.style2 .tabber li.active a,
.tabbable.style2 .tabber li.active a:hover,
.tabbable.style2 .tabber li.active a:focus,
.tabbable.style2 .tabber li.active a:active,
.btn-flat,
#home .btn-flat:hover {border-color:' . $theme_options['border-color'] . ';}
.navbar-default,
.nav li a.selected, .navbar-default .navbar-nav li a.selected, .navbar-default .navbar-nav .active a, .navbar-default .navbar-nav .dropdown.active a, .navbar-default .navbar-nav .active a:hover, .navbar-default .navbar-nav .dropdown.active a:hover, .navbar-default .navbar-nav .active a:focus, .navbar-default .navbar-nav .dropdown.active a:focus {background-color:' . $theme_options['navigation-bg-color'] . ';}
.navbar-default .navbar-nav li a {border-color:' . $theme_options['navigation-bg-color'] . ';}
a,
a:hover,
.pagination > li > a,
.pagination > li > a:hover,
.navbar-default .navbar-nav li a.selected,
.navbar-default .navbar-nav .active a,
.navbar-default .navbar-nav .dropdown.active a,
.navbar-default .navbar-nav .active a:hover,
.navbar-default .navbar-nav .dropdown.active a:hover,
.navbar-default .navbar-nav .active a:focus,
.navbar-default .navbar-nav .dropdown.active a:focus,
.navbar-default .navbar-nav li a:hover,
.icon-title,
.company-name,
.image-caption .zoom:hover,
.image-title a:hover,
.date,
.meta-post,
.validation,
.social-network:hover,
.style1 .accordion-heading a:hover i,
.style2 .accordion-heading a:hover,
.style1 .wpb_accordion_header a:hover i,
.style2 .wpb_accordion_header a:hover,
.tabbable.style1 .tabber li a:hover,
.tabbable.style2 .tabber li a:hover,
.tabbable.style2 .tabber li.active a,
.tabbable.style2 .tabber li.active a:hover,
.tabbable.style2 .tabber li.active a:focus,
.tabbable.style2 .tabber li.active a:active {color:' . $theme_options['text-color'] . ';}
body,pre,code,.style1 .accordion-heading a,.style2 .accordion-heading a,
.style2 .accordion-heading a,
.style1 .accordion-heading a i,
.style2 .accordion-heading a i,
.style2 .accordion-heading a:hover,
.style1 .accordion-inner,
.style2 .accordion-inner,
.style2 .accordion-inner,
.style1 .panel-heading a,
.style2 .panel-heading a,
.style2 .panel-heading a,
.style1 .panel-heading a i,
.style2 .panel-heading a i,
.style2 .panel-heading a:hover,
.style1 .panel-body,
.style2 .panel-body,
.style1 .wpb_accordion_header a,
.style2 .wpb_accordion_header a,
.style2 .wpb_accordion_header a,
.style2 .wpb_accordion_header a:hover,
.style1 .wpb_accordion_content,
.style2 .wpb_accordion_content,
.tabbable.style1 .tabber li a,
.tabbable.style2 .tabber li a,
.tabbable.style2 .tabber li a,
.tabbable.style2 .tab-content,
.btn-default,
#home .btn-default:hover,
#intro .btn-default:hover,
.item-detail .btn-default:hover,
#home .btn-flat,
#intro .btn-flat,
.item-detail .btn-flat,
.inner,.testimoni-box,.icon-social,.blog-box,.article-wrapper,aside,.recent li h6 a,.comment-wrapper,.comment-wrapper .media label,.media-heading h6,.media-heading h6 a,.pricing-head,.pricing-head h4,.pricing-body,.contact-body,.demo-panel h6,
.contain .blog article, .singlepost article {color:' . $theme_options['main-text-color'] . ';}
.heading {color:' . $theme_options['section-title-color'] . ';}
footer.lotek-footer {background-color:' . $theme_options['footer-bg-color'] . ';}
footer.lotek-footer .subfooter {background-color:' . $theme_options['footer-copyright-bg-color'] . ';}
.navbar-default .navbar-nav li a, .navbar-default .navbar-nav li a:focus  {color:' . $theme_options['navigation-text-color'] . ';}
.navbar-default .navbar-nav li a.selected,
.navbar-default .navbar-nav .active a,
.navbar-default .navbar-nav .dropdown.active a,
.navbar-default .navbar-nav .active a:hover,
.navbar-default .navbar-nav .dropdown.active a:hover,
.navbar-default .navbar-nav .active a:focus,
.navbar-default .navbar-nav .dropdown.active a:focus,
.navbar-default .navbar-nav li a:hover {color:' . $theme_options['navigation-active-text-color'] . ';}
';
        if($divider_image = $theme_options['divider-image']['url']){
            $inline_style .= ".colorbg .divider{background:url($divider_image) no-repeat top center;}";
        }
        if ($dark_divider_image = $theme_options['dark-divider-image']['url']) {
            $inline_style .= ".darkbg .divider{background:url($dark_divider_image) no-repeat top center;}";
        }
        // Remove whitespace
        $inline_style = lotek_stripWhitespace($inline_style);
        
        return $inline_style;
    }
}
