<?php

/**
 * sprystore functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package sprystore
 */

if (!defined('_S_VERSION')) {
	// Replace the version number of the theme on each release.
	define('_S_VERSION', '1.0.0');
}


include_once __DIR__ . '/include/sprystore_settings.php'; //theme_settings
include_once __DIR__ . '/include/enqueue_assets.php'; //enqueue css, js for theme and gutenberg
include_once __DIR__ . '/include/custom_post_types.php'; //CPT 
include_once __DIR__ . '/include/shortcodes.php'; //shortcodes to show in front-end the new CPT (testimonials, team)
include_once __DIR__ . '/include/woocommerce_settings.php'; //woocommerce settings 
include_once __DIR__ . '/include/gutenberg_settings.php'; //guttenberg settings 



/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
	require get_template_directory() . '/inc/jetpack.php';
}
