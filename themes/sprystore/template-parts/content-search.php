<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sprystore
 */

?>

<article class="col-12 col-md-6 col-lg-4 px-4 py-3" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>

		<?php if ('post' === get_post_type()) : ?>
			<div class="entry-meta pt-2 pb-4">
				<span class="author">By <?php echo get_the_author(); ?>&nbsp;|</span>
				<span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
			</div><!-- .entry-meta -->

		<?php endif; ?>
	</header><!-- .entry-header -->

	<?php sprystore_post_thumbnail(); ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

	<!--<footer class="entry-footer">
		<?php sprystore_entry_footer(); ?>
	</footer>-->
	<!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->