<?php
/**
 * @package Lotek - App Landing Page Wordpress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 25-10-2014
 *
 * @copyright  Copyright ( C ) 2014 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if (!isset($theme_options) && file_exists(get_template_directory() . '/functions/admin-config.php')) {
    require_once (get_template_directory() . '/functions/admin-config.php');
}
function lotek_removeDemoModeLink() { // Be sure to rename this function to something more unique
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_filter( 'plugin_row_meta', array( ReduxFrameworkPlugin::get_instance(), 'plugin_metalinks'), null, 2 );
    }
    if ( class_exists('ReduxFrameworkPlugin') ) {
        remove_action('admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );    
    }
}
add_action('init', 'lotek_removeDemoModeLink');
/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Lotek 1.0
 */
if (!isset($content_width)) {
    $content_width = 662;
}

if (!function_exists('lotek_setup_theme')) {
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     *
     * @since Lotek 1.0
     */

    function lotek_setup_theme() {
        load_theme_textdomain('lotek', get_template_directory() . '/languages');
        /*
         * This theme uses a custom image size for featured images, displayed on
         * "standard" posts and pages.
         */
        add_theme_support('post-thumbnails');

        add_image_size('lotek-blog-content', 960, 640, true);
        add_image_size('lotek-blog-thumb', 385, 428, true);
        add_image_size('lotek-testi-thumb', 385, 428, true);
        add_image_size('lotek-folio-thumb', 500, 500, true);
        add_image_size('lotek-member-thumb', 170, 170, true);
        
        // Adds RSS feed links to <head> for posts and comments.
        add_theme_support('automatic-feed-links');
        
        // Switches default core markup for search form, comment form, and comments
        
        add_theme_support('title-tag');
        
        // to output valid HTML5.
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list'));
        
        //Post formats
        add_theme_support('post-formats', array('audio', 'gallery', 'image', 'link', 'quote', 'status', 'video'));

        add_theme_support('custom-header');

        add_theme_support('custom-background');
        
        // This theme uses wp_nav_menu() in one location.
        register_nav_menu( 'primary', __( 'Main Navigation Menu', 'lotek' ) );
        register_nav_menu( 'landing-menu', __( 'Landing Page Navigation Menu', 'lotek' ) );
        
        // This theme uses its own gallery styles.
        
        add_filter('use_default_gallery_style', '__return_false');

        add_editor_style(get_template_directory_uri().'/inc/assets/custom-editor-style.css');

    }
}
add_action('after_setup_theme', 'lotek_setup_theme');

/**
 * Register widget area.
 *
 * @since Lotek 1.0
 *
 * @link https://codex.wordpress.org/Function_Reference/register_sidebar
 */
function lotek_register_sidebars() {

    register_sidebar( array(
        'name'          => __( 'Main Sidebar', 'lotek' ),
        'id'            => 'sidebar-1',        
        'description'   => __( 'Appears in the sidebar section of the site.', 'lotek' ),        
        'before_widget' => '<div id="%1$s" class="widget %2$s">',        
        'after_widget'  => '</div>',        
        'before_title'  => '<h5>',        
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Page Sidebar', 'lotek' ),
        'id'            => 'sidebar-2',
        'description'   => __( 'Appears in the sidebar section of the page template.', 'lotek' ),
        'before_widget' => '<div id="%1$s" class="widget cth %2$s">',        
        'after_widget'  => '</div>',        
        'before_title'  => '<h5>',        
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(

        'name'          => __( 'Footer Widget Area 1', 'lotek' ),
        'id'            => 'footer-1',
        'description'   => __( 'Appears in Footer 1.', 'lotek' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',        
        'after_widget'  => '</div>',        
        'before_title'  => '<h5>',        
        'after_title'   => '</h5>',
    ) );
    register_sidebar( array(

        'name'          => __( 'Footer Widget Area 2', 'lotek' ),
        'id'            => 'footer-2',
        'description'   => __( 'Appears in Footer 2.', 'lotek' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',        
        'after_widget'  => '</div>',        
        'before_title'  => '<h5>',        
        'after_title'   => '</h5>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 3', 'lotek' ),
        'id'            => 'footer-3',
        'description'   => __( 'Appears in Footer 3.', 'lotek' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',        
        'after_widget'  => '</div>',        
        'before_title'  => '<h5>',        
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Widget Area 4', 'lotek' ),
        'id'            => 'footer-4',
        'description'   => __( 'Appears in Footer 4.', 'lotek' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',        
        'after_widget'  => '</div>',        
        'before_title'  => '<h5>',        
        'after_title'   => '</h5>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Footer Copyright Area', 'lotek' ),
        'id'            => 'footer-widget',
        'description'   => __( 'Appears in Footer Copyright position.', 'lotek' ),
        'before_widget' => '',
        'after_widget'  => '',
        'before_title'  => '',
        'after_title'   => '',
    ) );

    //new in version 2.0
    register_sidebar(
        array(
            'name' => esc_html__('Footer Columns Widget', 'lotek'), 
            'id' => 'footer_columns_widget', 
            'description' => esc_html__('Appears above the footer copyright content.', 'lotek'), 
            'before_widget' => '<div id="%1$s" class="footer-columns-widget %2$s ' . lotek_slbd_count_widgets('footer_columns_widget') . '">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
}

add_action('widgets_init', 'lotek_register_sidebars');

if(!function_exists('lotek_slbd_count_widgets')){
   /**
     * Count number of widgets in a sidebar
     * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
     */
    function lotek_slbd_count_widgets($sidebar_id) {
        
        // If loading from front page, consult $_wp_sidebars_widgets rather than options
        // to see if wp_convert_widget_settings() has made manipulations in memory.
        global $_wp_sidebars_widgets;
        if (empty($_wp_sidebars_widgets)):
            $_wp_sidebars_widgets = get_option('sidebars_widgets', array());
        endif;
        
        $sidebars_widgets_count = $_wp_sidebars_widgets;
        
        if (isset($sidebars_widgets_count[$sidebar_id])):
            $widget_count = count($sidebars_widgets_count[$sidebar_id]);
            $widget_classes = 'widget-count-' . count($sidebars_widgets_count[$sidebar_id]);
            if ($widget_count % 6 == 0 && $widget_count >= 6):
                
                // Six widgets er row if there are exactly four or more than six
                $widget_classes.= ' col-md-2';
            elseif ($widget_count % 4 == 0 && $widget_count >= 4):
                
                // Four widgets er row if there are exactly four or more than six
                $widget_classes.= ' col-md-3';
            elseif ($widget_count % 3 == 0 && $widget_count >= 3):
                
                // Three widgets per row if there's three or more widgets
                $widget_classes.= ' col-md-4';
            elseif (2 == $widget_count):
                
                // Otherwise show two widgets per row
                $widget_classes.= ' col-md-6';
            elseif (1 == $widget_count):
                
                // Otherwise show two widgets per row
                $widget_classes.= ' col-md-12';
            endif;
            
            return $widget_classes;
        endif;
    } 
}

/*Custom Title tag for older wordpress version */
if (!function_exists('_wp_render_title_tag')) {
    function lotek_render_title() {
?>
<title><?php
        wp_title('|', true, 'right'); ?></title>
<?php
    }
    add_action('wp_head', 'lotek_render_title');
}


//For IE
function lotek_script_ie() {
        echo '<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
            <!--[if lt IE 9]>
              <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
              <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
            <![endif]-->';    
    }
add_action( 'wp_head', 'lotek_script_ie' );

if(!function_exists('lotek_theme_scripts_styles')){
    function lotek_theme_scripts_styles() {
        global $theme_options;
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
        //Javascript
        wp_enqueue_script("bootstrap-script", get_template_directory_uri()."/js/plugins.js",array('jquery'),false,true);
        wp_enqueue_script("lotek_custom_scripts", get_template_directory_uri()."/js/custom.js",array(),false,true);

        $lotek_obj = array();
        $lotek_obj['disable_animation'] = $theme_options['disable_animation'];
        $lotek_obj['disable_mobile_animation'] = $theme_options['disable_mobile_animation'];
        wp_localize_script('lotek_custom_scripts', 'lotek_obj', $lotek_obj);
        wp_enqueue_style( 'lotekplugins-style', get_template_directory_uri().'/css/plugins.css');
        wp_enqueue_style( 'theme-style', get_stylesheet_uri(), array(), '2014-10-31' );
        wp_enqueue_style( 'lotekcustom-style', get_stylesheet_directory_uri().'/css/custom.css');
        if($theme_options['override-preset'] == 'yes'){
            $inline_style = lotek_overridestyle();
            if (!empty($inline_style)) {
                wp_add_inline_style('lotekcustom-style', $inline_style);
            }
        }else{
            wp_enqueue_style( 'lotekskin', get_template_directory_uri().'/skins/'.$theme_options['color-preset'].'/skin.css');
        }
        
        
        if($theme_options['custom-css'] !== ''){
            wp_add_inline_style( 'lotekcustom-style', $theme_options['custom-css'] );
        }

    }
}

add_action( 'wp_enqueue_scripts', 'lotek_theme_scripts_styles' );

/**
 * Enqueue admin scripts and styles.
 *
 * @since Lotek 1.0
 */

if (!function_exists('lotek_enqueue_admin_scripts')) {
    function lotek_enqueue_admin_scripts() {
        wp_register_script('cththemes-import', get_template_directory_uri() . '/includes/cththemes-import.js', false, '1.0.0', true);
        wp_enqueue_script('cththemes-import');
        
        wp_enqueue_style('lotekadmin-styles', get_template_directory_uri() . '/inc/assets/admin_styles.css');
    }
}
add_action('admin_enqueue_scripts', 'lotek_enqueue_admin_scripts');

/* Enable shortcode in widget text content */
add_filter('widget_text', 'do_shortcode');







//Bread Crumb

function lotek_breadcrumbs() {

    /* === OPTIONS === */
    $text['home']     = 'Blog'; // text for the 'Home' link
    $text['category'] = 'Archive by Category "%s"'; // text for a category page
    $text['tax']       = 'Archive for "%s"'; // text for a taxonomy page
    $text['search']   = 'Search Results for "%s" Query'; // text for a search results page
    $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
    $text['author']   = 'Articles Posted by %s'; // text for an author page
    $text['archive']  = 'Archive: %s';
    $text['404']      = 'Error 404'; // text for the 404 page
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter   = ''; // delimiter between crumbs
    $before      = '<h4>';//'<li class="active">'; // tag before the current crumb
    $after       = '</h4>';//'</li>'; // tag after the current crumb
 
    global $post, $theme_options;

    if (is_home()) {
        //if ($showOnHome == 1) 
            echo '<h4>'. esc_html($theme_options['blog_home_text'] ) . '</h4>';
    }else{
        if ( is_category() ) {
            
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['category'], single_cat_title('', false)) . $after ));
        } elseif( is_tax() ){

            echo htmlspecialchars_decode(esc_html($before . sprintf($text['tax'], single_cat_title('', false)) . $after ));
        }elseif ( is_search() ) {
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['search'], get_search_query()) . $after ));
        } elseif ( is_day() ) {
           
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['archive'], get_the_time('F jS, Y')) . $after ));
        } elseif ( is_month() ) {
            
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['archive'],get_the_time('F, Y'))  . $after ));
        } elseif ( is_year() ) {
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['archive'],get_the_time('Y')) . $after ));
        } elseif ( is_single() && !is_attachment() ) {
            
            if ($showCurrent == 1) echo htmlspecialchars_decode(esc_html($before . get_the_title() . $after ));
            
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
            $post_type = get_post_type_object(get_post_type());
            echo htmlspecialchars_decode(esc_html($before . $post_type->labels->singular_name . $after));
        } elseif ( is_attachment() ) {
            
        } elseif ( is_page() && !$post->post_parent ) {
            if ($showCurrent == 1) echo htmlspecialchars_decode(esc_html($before . get_the_title() . $after ));
        } elseif ( is_page() && $post->post_parent ) {
            
            if ($showCurrent == 1) echo htmlspecialchars_decode(esc_html($before . get_the_title() . $after ));
        } elseif ( is_tag() ) {
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['tag'], single_tag_title('', false)) . $after ));
        } elseif ( is_author() ) {
             global $author;
            $userdata = get_userdata($author);
            echo htmlspecialchars_decode(esc_html($before . sprintf($text['author'], $userdata->display_name) . $after ));
        } elseif ( is_404() ) {
            echo htmlspecialchars_decode(esc_html($before . $text['404'] . $after ));
        }
        if ( get_query_var('paged') ) {
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page','lotek') . ' ' . get_query_var('paged');
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
        } 
    }
 
}

// add_shortcode('gallery', '__return_false');


// //pagination
function lotek_pagination($prev = 'Prev', $next = 'Next', $pages='',$wrap = false) {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if($pages==''){
        global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
    }
    $pagination = array(
		'base' 			    => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),
		'format' 		       => '',
		'current' 		      => max( 1, get_query_var('paged') ),
		'total' 		    => $pages,
		'prev_text'       => $prev,
        'next_text'       => $next,	
        'type'			=> 'list',
		'end_size'		=> 3,
		'mid_size'		=> 3
);
    $return =  paginate_links( $pagination );
    if($wrap) echo '<div class="portfolio-pagi">';
	echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $return );
    if($wrap) echo '</div>';
}

function lotek_post_nav() {
    global $post;
    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );
    if ( ! $next && ! $previous )
        return;
    ?>
    <ul class="pager clearfix">
      <li class="previous">
        <?php previous_post_link( '%link', _x( ' &larr; Older Item', 'Previous post link', 'lotek' ) ); ?>
      </li>
      <li class="next">
        <?php next_post_link( '%link', _x( 'Newer Item &rarr;', 'Next post link', 'lotek' ) ); ?>
      </li>
    </ul>   
<?php
}

function lotek_search_form( $form ) {
    $form = '
		<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
		<div class="search">
		<input type="text" size="16" class="search-field form-control" placeholder="'.__('Search ...','lotek').'" value="' . get_search_query() . '" name="s" id="s" />
        <input type="hidden" name="post_type" value="post">
		</div>
		</form>
	';
  return $form;
}

//Custom comment List:
function lotek_theme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);

    if ( 'div' == $args['style'] ) {
        $tag = 'div';
        $add_below = 'comment';
    } else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php echo esc_attr($tag ); ?> <?php comment_class( empty( $args['has_children'] ) ? 'media' : 'media parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>

    <?php endif; ?>
    <div class="media-avatar">
        <a href="#" ><?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?></a>
    
    </div>
    <div class="media-body">
        <div  class="media-heading"><h6><a href="#"><?php echo get_comment_author_link(); ?></a></h6></div>
        <?php comment_text(); ?>
        <p>
        <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
        </p>
    </div>
    <?php if ( $comment->comment_approved == '0' ) : ?>
    <em class="comment-awaiting-moderation aligncenter"><?php _e( 'Your comment is awaiting moderation.','lotek'); ?></em>
    <br />
    <?php endif; ?>
    
    <?php if ( 'div' != $args['style'] ) : ?>

    <?php endif; ?>
<?php
}


/**
 * Modify tag cloud format
 *
 * @since Lotek 2.0
 */
function lotek_custom_tag_cloud_widget($args) {
    $args['format'] = 'list';
     //ul with a class of wp-tag-cloud
    return $args;
}
add_filter('widget_tag_cloud_args', 'lotek_custom_tag_cloud_widget');
// add_filter( 'woocommerce_product_tag_cloud_widget_args','lotek_custom_tag_cloud_widget');

/**
 * Change posts per page setting for portfolio archive pages.
 *
 * @since Lotek 2.0
 */
function lotek_pagesize($query) {
    global $theme_options;
    
    if (is_admin() || !$query->is_main_query()) return;
    
    if (is_post_type_archive('portfolio') || is_tax('portfolio_cat')) {
        
        // Display 50 posts for a custom post type called 'portfolio'
        if ($theme_options['folio_posts_per_page']) {
            $query->set('posts_per_page', $theme_options['folio_posts_per_page']);
        }
        return;
    }
}
add_action('pre_get_posts', 'lotek_pagesize', 1);

/**
 * Change excerpt length.
 *
 * @since Lotek 2.0
 */

function lotek_excerpt_length( $length ) {
    global $theme_options;
    if($theme_options['blog_excerpt']){
        return $theme_options['blog_excerpt'];
    }else{
        return 20;
    }
    
}
add_filter( 'excerpt_length', 'lotek_excerpt_length', 999 );

/**
 * Change excerpt more character.
 *
 * @since Lotek 2.0
 */

function lotek_excerpt_more($more) {
    return esc_html__('...','lotek' );
}
add_filter('excerpt_more', 'lotek_excerpt_more');

/**
 * Modify menu link class attribute
 *
 * @since Lotek 2.1
 */
add_filter('nav_menu_css_class', 'lotek_nav_menu_css_class_func', 10, 2);

$lotek_menu_link_class = array();
if(!function_exists('lotek_nav_menu_css_class_func')){
    function lotek_nav_menu_css_class_func($classes, $item) {
        global $lotek_menu_link_class;
        $lotek_menu_link_class = array();
        $disabled = array_search("disabled", $classes);
        if ($disabled !== false) {
            $lotek_menu_link_class[] = 'disabled';
            unset($classes['disabled']);
        }
        return $classes;
    }
}


add_filter('nav_menu_link_attributes', 'lotek_nav_menu_link_attributes_func', 10, 3);
if(!function_exists('lotek_nav_menu_link_attributes_func')){
    function lotek_nav_menu_link_attributes_func($atts, $item, $args) {
        global $lotek_menu_link_class;
        if (!empty($lotek_menu_link_class)) {
            $atts['class'] = implode(" ", $lotek_menu_link_class);
        }
        
        return $atts;
    }
}


/**
 * Custom meta box for page, post, portfolio...
 *
 * @since Lotek 1.0
 */
require_once get_template_directory() . '/framework/Custom-Metaboxes/metabox-functions.php';

/**
 * Visual Composer plugin integration
 *
 * @since Lotek 1.0
 */
require_once get_template_directory() . '/inc/cth_for_vc.php';

/**
 * Theme custom style
 *
 * @since Lotek 1.0
 */
require_once get_template_directory() . '/inc/overridestyle.php';

/**
 * Taxonomy meta box
 *
 * @since Lotek 1.0
 */
//require_once get_template_directory() . '/inc/taxonomy_metabox_fields.php';

/**
 * Custom elements for VC
 *
 * @since Lotek 1.0
 */
require_once get_template_directory() . '/vc_extend/vc_shortcodes.php';

/**
 * Implement the One Click to import demo data
 *
 * @since Lotek 1.0
 */
require_once get_template_directory() . '/includes/cththemes-importer.php';


// Custom fields:
//require_once dirname( __FILE__ ) . '/framework/Custom-Metaboxes/metabox-functions.php';
require_once dirname( __FILE__ ) . '/version1.x/wp_bootstrap_navwalker.php';
// require_once dirname( __FILE__ ) . '/version1.x/post_type.php';
// require_once dirname( __FILE__ ) . '/framework/BFI_Thumb.php';
require_once dirname( __FILE__ ) . '/version1.x/shortcodes.php';
// require_once dirname( __FILE__ ) . '/framework/widget/cthwidget.php';
// require_once dirname( __FILE__ ) . '/framework/widget/recentproducts.php';


/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'lotek_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function lotek_register_required_plugins() {
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(
        // This is an example of how to include a plugin from a private repo in your theme.
        // This is an example of how to include a plugin from a private repo in your theme.
        array('name' => 'Redux Framework',
             // The plugin name.
            'slug' => 'redux-framework',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/redux-framework.3.6.0.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => true,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'https://downloads.wordpress.org/plugin/redux-framework.3.6.0.zip',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ), 
        array('name' => 'WPBakery Visual Composer',
             // The plugin name.
            'slug' => 'js_composer',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/js_composer.4.11.2.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ), 
        array('name' => 'Rock Lobster Contact Form 7',
             // The plugin name.
            'slug' => 'contact-form-7',
             // The plugin slug (typically the folder name).
            'source' => 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.1.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'https://downloads.wordpress.org/plugin/contact-form-7.4.4.1.zip',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),
        array(  
            'name'   => 'Lotek theme Plugins',  
             // The plugin name.
            'slug' => 'cth_lotek_plugins',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/cth_lotek_plugins.1.0.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.

            
        ),
        array('name' => 'Envato Wordpress Toolkit',
             // The plugin name.
            'slug' => 'envato-wordpress-toolkit',
             // The plugin slug (typically the folder name).
            'source' => get_template_directory_uri() . '/framework/plugins/envato-wordpress-toolkit.1.7.3.zip',
             // The plugin source.
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'version' => '',
             // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
            'force_activation' => false,
             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false,
             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => 'https://github.com/envato/envato-wordpress-toolkit',
             // If set, overrides default API URL and points to an external URL.
            'is_callable' => '',
             // If set, this callable will be be checked for availability to determine if a plugin is active.
        ),

    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
    */
    $config = array(
        'id' => 'tgmpa',
         // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',
         // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins',
         // Menu slug.
        'parent_slug' => 'themes.php',
         // Parent menu slug.
        'capability' => 'edit_theme_options',
         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,
         // Show admin notices or not.
        'dismissable' => true,
         // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',
         // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,
         // Automatically activate plugins after installation or not.
        'message' => '',
         // Message to output right before the plugins table.
    );
    
    tgmpa($plugins, $config);
}
?>