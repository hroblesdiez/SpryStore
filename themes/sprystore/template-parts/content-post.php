<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sprystore
 */

?>

<article class="col-12 col-sm-8 col-md-6 px-4 py-3 mx-auto" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<div class="entry-header__img">
			<?php sprystore_post_thumbnail(); ?>
		</div>
		<div class="entry-meta pt-2 pb-4">
			<span class="author">By <?php echo get_the_author(); ?></span>
			<span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
		</div><!-- .entry-meta -->
		<h2 class="entry-title">
			<?php if (is_home()) { ?>
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php } ?> <?php echo get_the_title(); ?></a>
		</h2>
	</header><!-- .entry-header -->

	<div class="entry-content">

		<?php
		if (is_home()) {
			echo get_the_excerpt();
		} else {
			echo get_the_content();
		}
		?>
	</div><!-- .entry-content -->


</article><!-- #post-<?php the_ID(); ?> -->