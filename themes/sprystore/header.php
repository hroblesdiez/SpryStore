<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sprystore
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">


		<header id="masthead" class="site-header">
			<div class="header">
				<div class="top-header d-flex justify-content-between align-items-center py-3 px-2">
					<h6>Upto 30% off on All styles, Click here for<span><i class="far fa-hand-point-right"></i></span><span class="details">More Details</span></h6>

					<div class="modal-container-off" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-off">
							<div class="top-modal-off d-flex flex-row align-items-strecht justify-content-between w-100">
								<!-- Modal title -->
								<h1 class="modal-title-off">30% Off!</h1>
								<i class="fa fa-window-close modal__close" aria-hidden="true"></i>
							</div>
							<!--End  Modal title -->

							<div class="low-modal-off">
								<!-- Card Poducts with 30% off -->
								<?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$args = array(
									'post_type'      => 'product',
									'posts_per_page' => 3,
									'product_tag'    => 'discount-30',
									'paged'			 => $paged,
									'orderby'        => 'rand'
								);

								$productsOff = new WP_Query($args);

								if ($productsOff->have_posts()) {
									while ($productsOff->have_posts()) {
										$productsOff->the_post();

										$image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');

								?>

										<div class="card my-2 col-md-4">

											<img src="<?php echo esc_url($image_src[0]); ?>" class="card-img-top img-fluid" alt="<?php esc_attr(get_the_title()); ?>">
											<a href="<?php esc_url(the_permalink()); ?>">
												<div class=" card-body d-flex flex-column flex-wrap justify-content-between align-items-center text-center">
													<h5 class="card-title"><?php echo esc_html(get_the_title()); ?></h5>
													<!-- <?php wc_get_template('/single-product/tabs/description.php'); ?> -->
													<?php wc_get_template('loop/price.php'); ?>
													<a href="<?php esc_url(the_permalink()); ?>" class="btn btn-primary"> Buy</a>
												</div>
											</a>
										</div>

									<?php } ?>

								<?php }
								wp_reset_postdata(); ?>

							</div><!-- End Card Poducts with 30% off -->
							<?php  ?>

						</div>
						<!--End  Modal -->
					</div>
					<!--End  Modal Container -->

					<a href="<?php echo esc_url(site_url('/cart', 'https')); ?>"><button class="shopping-button" type="submit" value name="submit">My Cart<span><i class="fas fa-shopping-cart"></i></button></a>
				</div>
				<nav class="low-header navbar navbar-expand-lg navbar-light px-2">
					<div class="container-fluid">

						<a href="<?php echo esc_url(site_url('/')); ?>" class="navbar-brand">spry<span class="s">s</span>tore</a>

						<div class="search d-flex align-items-center">
							<?php get_search_form(true); ?>
						</div>

						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
							<i class="fas fa-bars"></i>
						</button>
						<?php
						wp_nav_menu(array(
							'theme_location'  => 'menu-1',
							'depth'           => 2, // 1 = no dropdowns, 2 = with dropdowns.
							'container'       => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id'    => 'navbarNav',
							'menu_class'      => 'nav navbar-nav ms-auto',
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'walker'          => new WP_Bootstrap_Navwalker(),
						));
						?>
					</div>
				</nav><!-- #site-navigation -->

			</div>
			<?php if (is_front_page()) : ?>
				<div class="container-fluid banner-left">
					<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

						<div class="carousel-inner">
							<div class="carousel-item active">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?> . /img/banner1.jpg" class="d-block w-100 h-100 img-fluid" alt="Women's fashion">
								<div class="carousel-caption d-md-block">
									<h3 class="mb-4 text-white">WOMEN'S FASHION</h3>
									<a href="<?php echo esc_url(site_url('/shop')); ?>" class="shop-button">Shop now</a>
								</div>
							</div>
							<div class="carousel-item">
								<img src="<?php echo esc_url(get_template_directory_uri()); ?> . /img/banner2.jpg" class="d-block w-100 h-100 img-fluid" alt="Men's fashion">
								<div class="carousel-caption d-md-block">
									<h3 class="mb-4 text-white">MEN'S FASHION</h3>
									<a href="<?php echo esc_url(site_url('/shop')); ?>" class="shop-button">Shop now</a>
								</div>
							</div>

						</div>
						<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
							<span class="carousel-control-prev-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Previous</span>
						</button>
						<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
							<span class="carousel-control-next-icon" aria-hidden="true"></span>
							<span class="visually-hidden">Next</span>
						</button>
					</div>
				</div>
				<div class="container-fluid banner-right">

					<div class="carousel-item active">

						<img src="<?php echo esc_url(get_template_directory_uri()); ?> . /img/banner4.jpg" class="d-block w-100 h-100 img-fluid" alt="Men's fashion">

						<div class="carousel-caption d-md-block">
							<h3 class="mb-4 text-white">MEN'S FASHION</h3>
							<a href="<?php echo esc_url(site_url('/shop')); ?>" class="shop-button">Shop now</a>
						</div>
					</div>
				</div>
			<?php endif; ?>
			<?php
			switch ($wp_query) {
				case is_page('cart'); ?>
					<div class="container-fluid banner" style="max-height: 12rem;">

					</div> <?php
							break;
						case is_404() || is_search(); ?>
					<div class="container-fluid banner" style="max-height: 12rem;">

					</div> <?php
							break;

						case is_home(): ?>
					<div class="container-fluid banner">

						<div class="banner-title-container">
							<?php echo '<h1 class="banner-title">Blog</h1>'; ?>
						</div><!-- .entry-header -->
					</div> <?php
							break;

						case is_page() && !is_front_page(): ?>
					<div class="container-fluid banner">

						<div class="banner-title-container">
							<?php the_title('<h1 class="banner-title">', '</h1>'); ?>
						</div><!-- .entry-header -->
					</div> <?php
							break;
						case is_archive() || is_singular('product'): ?>
					<div class="container-fluid banner" style="max-height: 12rem;">
						<div class="banner-title-container">
							<a href="<?php echo esc_url(site_url('/shop')); ?>">
								<h1 class="banner-title">Shop</h1>
							</a>
						</div><!-- .entry-header -->
					</div> <?php
							break;
					} ?>

		</header>

	</div>