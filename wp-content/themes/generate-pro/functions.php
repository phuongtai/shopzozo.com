<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );
//Tai add pagination
require_once(get_stylesheet_directory() .'/inc/pagination.php');
//* Setup Theme
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

//* Set Localization (do not remove)
load_child_theme_textdomain( 'generate', apply_filters( 'child_theme_textdomain', get_stylesheet_directory() . '/languages', 'generate' ) );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', __( 'Generate Pro Theme', 'generate' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/generate/' );
define( 'CHILD_THEME_VERSION', '2.1' );

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Enqueue Scripts
add_action( 'wp_enqueue_scripts', 'generate_load_scripts' );
function generate_load_scripts() {

wp_enqueue_script( 'generate-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js#asyncload', array( 'jquery' ), '1.0.0' );

wp_enqueue_script( 'jquery_2.3.3', get_bloginfo( 'stylesheet_directory' ) . '/lib/js/jquery-2.2.3.min.js#asyncload');
wp_enqueue_script( 'tether', get_bloginfo( 'stylesheet_directory' ) . '/lib/js/tether.min.js#asyncload');
wp_enqueue_script( 'bootstrap_min', get_bloginfo( 'stylesheet_directory' ) . '/lib/js/bootstrap.min.js#asyncload');
wp_enqueue_script( 'mdb_min', get_bloginfo( 'stylesheet_directory' ) . '/lib/js/mdb.min.js#asyncload');

wp_enqueue_style( 'dashicons' );
wp_enqueue_style( 'bootstrap',get_bloginfo( 'stylesheet_directory' ) . '/lib/css/complied.css');
//wp_enqueue_style( 'bootstrap_mdb',get_bloginfo( 'stylesheet_directory' ) . '/lib/css/mdb.min.css');
//wp_enqueue_style( 'Style',get_bloginfo( 'stylesheet_directory' ) . '/lib/css/style.css');
//wp_enqueue_style( 'google_font', '//fonts.googleapis.com/css?family=Source+Sans+Pro:300,600', array(), CHILD_THEME_VERSION );
	
}

//* Add new image sizes
add_image_size( 'blog', 700, 300, TRUE );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 360,
	'height'          => 140,
	'header-selector' => '.site-title a',
	'header-text'     => false,
) );

//* Add support for custom background
add_theme_support( 'custom-background' );

//* Add support for additional color style options
add_theme_support( 'genesis-style-selector', array(
	'generate-pro-blue'   => __( 'Generate Pro Blue', 'generate' ),
	'generate-pro-green'  => __( 'Generate Pro Green', 'generate' ),
	'generate-pro-orange' => __( 'Generate Pro Orange', 'generate' ),
) );

//* Unregister layout settings
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );

//* Unregister secondary sidebar 
unregister_sidebar( 'sidebar-alt' );

//* Remove unused sections from Genesis Customizer
add_action( 'customize_register', 'generate_customize_register', 16 );
function generate_customize_register( $wp_customize ) {

	$wp_customize->remove_control( 'genesis_image_alignment' );
	
}

//* Reposition the secondary navigation menu
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 7 );

//* Reduce the secondary navigation menu to one level depth
add_filter( 'wp_nav_menu_args', 'generate_secondary_menu_args' );
function generate_secondary_menu_args( $args ){

	if( 'secondary' != $args['theme_location'] )
	return $args;

	$args['depth'] = 1;
	return $args;

}

//* Remove default post image
remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

//* Add featured image above the entry content
add_action( 'genesis_entry_content', 'generate_featured_photo', 8 );
function generate_featured_photo() {
	if ( is_page() || ! genesis_get_option( 'content_archive_thumbnail' ) )
		return;

	if ( $image = genesis_get_image( array( 'format' => 'url', 'size' => genesis_get_option( 'image_size' ) ) ) ) {
		printf( '<div class="col-md-4"><div class="view overlay hm-white-slight"><img src="%s" alt="%s" /><a>
                    <div class="mask"></div></a></div></div>', $image, the_title_attribute( 'echo=0' ) );
	}
}


//* Reposition the post info
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );
add_action( 'genesis_entry_header', 'genesis_post_info', 5 );

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'generate_remove_comment_form_allowed_tags' );
function generate_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Hook after home featured widget before the content
add_action( 'genesis_after_header', 'generate_home_featured' );
function generate_home_featured() {

	if ( is_front_page() )
		genesis_widget_area( 'home-featured', array(
			'before' => '<div class="home-featured widget-area"><div class="wrap">',
			'after'  => '</div></div>',
		) );

}

//* Add support for 3-column footer widgets
add_theme_support( 'genesis-footer-widgets', 3 );

//* Add support for after entry widget
add_theme_support( 'genesis-after-entry-widget-area' );

//* Relocate after entry widget
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-featured',
	'name'        => __( 'Home Featured', 'generate' ),
	'description' => __( 'This is the featured widget area of the home page.', 'generate' ),
) );

//Tai edit async js
function taiphuong_async_scripts($url)
{
    if ( strpos( $url, '#asyncload') === false )
        return $url;
    else if ( is_admin() )
        return str_replace( '#asyncload', '', $url );
    else
	return str_replace( '#asyncload', '', $url )."' async='async"; 
    }
add_filter( 'clean_url', 'taiphuong_async_scripts', 11, 1 );


//add_action('genesis_setup','child_theme_setup', 15);
//Tai edit menu
//function child_theme_setup() {add_action( 'genesis_before_header', 'be_nav_menus' );}

remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_after_header', 'taiphuong_do_nav' );
function taiphuong_do_nav(){
if ( ! genesis_nav_menu_supported( 'primary' ) || ! has_nav_menu( 'primary' ) )
		return;

	$class = 'menu genesis-nav-menu menu-primary';
	if ( genesis_superfish_enabled() ) {
		$class .= ' js-superfish';
	}

	if ( genesis_a11y( 'headings' ) ) {
		printf( '<h2 class="screen-reader-text">%s</h2>', __( 'Main navigation', 'genesis' ) );
	}

	genesis_nav_menu( array(
		'theme_location' => 'primary',
		'menu_class'     => $class,
	) );
}

//remove page title

//add_action('get_header', 'remove_post_titles_home_page');
function remove_post_titles_home_page() {
	if(is_home()){remove_action( 'genesis_entry_header', 'genesis_do_post_title' );}
}

remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'taiphuong_do_header' );
function taiphuong_do_header(){
	global $wp_registered_sidebars;
	genesis_markup( array(
		'html5'   => '<div %s>',
		'xhtml'   => '<div id="title-area">',
		'context' => 'title-area',
	) );
	do_action( 'genesis_site_title' );
	do_action( 'genesis_site_description' );
	echo '</div>';

	if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {

		genesis_markup( array(
			'html5'   => '<div %s>' . genesis_sidebar_title( 'header-right' ),
			'xhtml'   => '<div class="widget-area header-widget-area">',
			'context' => 'header-widget-area',
		) );

			do_action( 'genesis_header_right' );
			add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
			dynamic_sidebar( 'header-right' );
			remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
			remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

		echo '</div>';

	}
}

remove_action( 'genesis_loop', 'genesis_do_loop' );
add_action( 'genesis_loop', 'taiphuong_custom_loop' );
function taiphuong_custom_loop(){
	if ( ! genesis_html5() ) {
		genesis_legacy_loop();
		return;
	}

	if ( have_posts() ) :

		do_action( 'genesis_before_while' );
		while ( have_posts() ) : the_post();

			//do_action( 'genesis_before_entry' );

			printf( '<div class="card" %s>', genesis_attr( 'entry' ) );

				//do_action( 'genesis_entry_header' );

				do_action( 'genesis_before_entry_content' );

				printf( '<div class="row">');
				do_action( 'genesis_entry_content' );
				echo '</div>';

				//do_action( 'genesis_after_entry_content' );

				//do_action( 'genesis_entry_footer' );

				echo '</div>';

			//do_action( 'genesis_after_entry' );

		endwhile; //* end of one post
		do_action( 'genesis_after_endwhile' );

	else : //* if no posts exist
		do_action( 'genesis_loop_else' );
	endif; //* end loop


}

//readmore link
function be_more_link($more_link) {
return sprintf('<p><a href="%s" class="small btn btn-primary">%s</a></span></p>', get_permalink(), 'Xem chi tiết');
}
//add_filter( 'excerpt_more', 'be_more_link' );
//add_filter( 'get_the_content_more_link', 'be_more_link' );
//add_filter( 'the_content_more_link', 'be_more_link' );

remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );
//remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'taiphuong_do_post_content' );

function taiphuong_do_post_content(){

if ( is_singular() ) {
do_action( 'genesis_entry_header' );
the_content();

		if ( is_single() && 'open' === get_option( 'default_ping_status' ) && post_type_supports( get_post_type(), 'trackbacks' ) ) {
			echo '<!--';
			trackback_rdf();
			echo '-->' . "\n";
		}

		if ( is_page() && apply_filters( 'genesis_edit_post_link', true ) )
			edit_post_link( __( '(Edit)', 'genesis' ), '', '' );
	}
	elseif ( 'excerpts' === genesis_get_option( 'content_archive' ) ) {
echo '<div class="col-md-8">';
	do_action( 'genesis_entry_header' );
	the_excerpt();
echo '</div>';
	}
	else {
printf('<div class="col-md-8">');
if ( genesis_get_option( 'content_archive_limit' ) ) 		the_content_limit((int)genesis_get_option('content_archive_limit' ), genesis_a11y_more_link( __( '[Xem Thêm]', 'genesis' )));
else the_content( genesis_a11y_more_link( __( '[Xem Thêm]', 'genesis' ) ) );
printf( '</div>');
}

}
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_endwhile', 'mdb_pagination');
