<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sprystore
 */

?>

<article class="col-12 col-md-6 px-4 py-3" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-header__img">
			<?php sprystore_post_thumbnail(); ?>
		</div>
		<div class="entry-meta pt-2 pb-4">
			<span class="author">By <?php echo get_the_author(); ?></span>
			<span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
		</div><!-- .entry-meta -->
		<h2 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php echo get_the_title(); ?></a>
		</h2>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		echo get_the_excerpt();
		// the_content(
		// 	sprintf(
		// 		wp_kses(
		// 			/* translators: %s: Name of current post. Only visible to screen readers */
		// 			__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'sprystore'),
		// 			array(
		// 				'span' => array(
		// 					'class' => array(),
		// 				),
		// 			)
		// 		),
		// 		wp_kses_post(get_the_title())
		// 	)
		// );

		// wp_link_pages(
		// 	array(
		// 		'before' => '<div class="page-links">' . esc_html__('Pages:', 'sprystore'),
		// 		'after'  => '</div>',
		// 	)
		// );
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->