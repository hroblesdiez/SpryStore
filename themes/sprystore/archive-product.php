<?php get_header();

$products_cats = array();

$args = array(
	'post_type'         => 'product',
	'posts_per_page'    => -1,

);
$products = new WP_Query($args);

if ($products->have_posts()) {
	while ($products->have_posts()) {
		$products->the_post();
		$products_categories = get_the_terms(get_the_ID(), 'product_cat');

		foreach ($products_categories as $product_category) {
			if (!in_array($product_category->name, $products_cats, true)) {
				array_push($products_cats, $product_category->name);
			}
		}
	}

	sort($products_cats);
?>
	<div class="container mt-3 mb-3">

		<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
			<?php
			$counter = 0;
			$class = '';
			foreach ($products_cats as $key => $product_cat) {
				$counter++;
				if ($counter === 1) {
					$class = 'active';
				} else {
					$class = '';
				}
			?>
				<li class="nav-item" role="presentation">
					<button class="nav-link <?php echo $class; ?>" id="<?php echo $product_cat; ?>-tab" data-bs-toggle="tab" data-bs-target="#<?php echo $product_cat; ?>" type="button" role="tab" aria-controls="<?php echo $product_cat; ?>" aria-selected="false"><?php echo esc_html($product_cat); ?></button>
				</li>

			<?php
			}

			?>
		</ul>
		<div class="tab-content d-flex flex-wrap" id="myTabContent">
			<?php
			$counter = 0;
			$class = '';
			foreach ($products_cats as $key => $product_cat) {
				$counter++;
				if ($counter === 1) {
					$class = 'show active';
				} else {
					$class = '';
				}
			?>
				<div class="tab-pane flex-wrap justify-content-evenly w-100 mt-4 fade <?php echo $class; ?>" id="<?php echo $product_cat; ?>" role="tabpanel" aria-labelledby="<?php echo $product_cat; ?>-tab">
					<?php
					$args = array(
						'post_type'     => 'product',
						'posts_per_page' => -1,
						'tax_query'     => array(
							array(
								'taxonomy'  => 'product_cat',
								'field'     => 'name',
								'terms'     =>  array($product_cat),
								'operator'  => 'IN'
							)
						),
					);
					$div_products = new WP_Query($args);
					if ($div_products->have_posts()) {
						while ($div_products->have_posts()) {
							$div_products->the_post();

							$image_src = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail');

					?>

							<div class="card my-2" style="width: 18rem;">

								<img src="<?php echo esc_url($image_src[0]); ?>" class="card-img-top img-fluid" alt="<?php esc_attr(get_the_title()); ?>">
								<a href="<?php esc_url(the_permalink()); ?>">
									<div class=" card-body d-flex flex-column flex-wrap justify-content-between align-items-center text-center">
										<h5 class="card-title"><?php echo esc_html(get_the_title()); ?></h5>
										<?php wc_get_template('/single-product/tabs/description.php'); ?>
										<?php wc_get_template('loop/price.php'); ?>
										<a href="<?php esc_url(the_permalink()); ?>" class="btn btn-primary"> Buy</a>
									</div>
								</a>
							</div>

					<?php }
					}
					wp_reset_postdata();

					?>

				</div>

			<?php
			}

			?>
		</div>
	</div>
<?php } else {
	esc_attr_e('No products', 'sprystore');
}
wp_reset_postdata();

?>

<?php get_footer(); ?>