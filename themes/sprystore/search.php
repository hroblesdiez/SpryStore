<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package sprystore
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if (have_posts()) : ?>

		<header class="page-header text-center mt-6">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Search Results for: %s', 'sprystore'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</header><!-- .page-header -->
		<div class="search-results container">
			<div class="row d-flex flex-row flex-wrap align-items-start justify-content-evenly">

			<?php
			/* Start the Loop */
			while (have_posts()) :
				the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				if (get_post_type() === 'product' || get_post_type() === 'post') {
					get_template_part('template-parts/content', 'search');
				}

			endwhile;

			the_posts_navigation();

		else :

			get_template_part('template-parts/content', 'none');

		endif;
			?>

			</div>
		</div>
</main><!-- #main -->

<?php

get_footer();
