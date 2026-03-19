<?php
/**
 * Enqueue script and styles for child theme
 */
function woodmart_child_enqueue_styles() {
	// Enqueue main child theme style
	wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css', array( 'woodmart-style' ), woodmart_get_theme_info( 'Version' ) );

	// Enqueue About Us page specific CSS (only on About Us page)
	if ( is_page_template( 'page-about-us.php' ) ) {
		wp_enqueue_style( 'about-page-css', get_stylesheet_directory_uri() . '/about.css', array(), '1.0.0' );
	}

	// Enqueue Font Awesome for icons
	wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css', array(), '6.5.1' );
}
add_action( 'wp_enqueue_scripts', 'woodmart_child_enqueue_styles', 10010 );
