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

/**
 * Change search placeholder text using gettext filter
 * Changes "Search for products" to "Search 2000+ products..."
 */
function woodmart_child_change_search_placeholder_gettext( $translated_text, $text, $domain ) {
	// Check if this is the WoodMart theme and the search placeholder
	if ( 'woodmart' === $domain && 'Search for products' === $text ) {
		return 'Search 2000+ products...';
	}

	return $translated_text;
}
add_filter( 'gettext', 'woodmart_child_change_search_placeholder_gettext', 20, 3 );

/**
 * Change search placeholder text using JavaScript
 * This ensures the change is applied even if translation cache is used
 */
function woodmart_child_search_placeholder_script() {
	?>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			// Change all search placeholders on the site
			$('input.s[placeholder="Search for products"]').attr('placeholder', 'Search 2000+ products...');

			// Also change the title attribute
			$('input.s[title="Search for products"]').attr('title', 'Search 2000+ products...');
		});
	</script>
	<?php
}
add_action( 'wp_footer', 'woodmart_child_search_placeholder_script', 999 );
