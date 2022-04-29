<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package sprystore
 */

get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found px-5 py-5">
		<header class="page-header">
			<h2 class="page-title"><?php esc_html_e('This page can&rsquo;t be found.', 'sprystore'); ?></h2>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php esc_html_e('It looks like nothing was found at this location. Try one of the links below or a search', 'sprystore'); ?></p>

			<?php
			get_search_form(); ?>



		</div><!-- .page-content -->
	</section><!-- .error-404 -->

</main><!-- #main -->

<?php
get_footer();
