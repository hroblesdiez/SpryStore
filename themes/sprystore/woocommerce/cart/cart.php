<?php

/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined('ABSPATH') || exit;

do_action('woocommerce_before_cart'); ?>
<div class="container my-5">
	<div class="main-cart d-flex flex-md-row flex-column mb-lg-4">
		<form class="woocommerce-cart-form d-flex justify-content-center" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
			<?php do_action('woocommerce_before_cart_table'); ?>

			<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
				<thead class="bg-bgcolor">
					<tr>
						<th class="product-remove">&nbsp;</th>
						<th class="product-thumbnail">&nbsp;</th>
						<th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
						<th class="product-price"><?php esc_html_e('Price', 'woocommerce'); ?></th>
						<th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
						<th class="product-subtotal"><?php esc_html_e('Subtotal', 'woocommerce'); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php do_action('woocommerce_before_cart_contents'); ?>

					<?php
					foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
						$_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
						$product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

						if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
							$product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
					?>
							<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

								<td class="product-remove pt-3 pe-3">
									<?php
									echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
										'woocommerce_cart_item_remove_link',
										sprintf(
											'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><span><i class="fas fa-trash"></i></span></a>',
											esc_url(wc_get_cart_remove_url($cart_item_key)),
											esc_html__('Remove this item', 'woocommerce'),
											esc_attr($product_id),
											esc_attr($_product->get_sku())
										),
										$cart_item_key
									);
									?>
								</td>

								<td class="product-thumbnail pt-3 pe-3">
									<?php
									$thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

									if (!$product_permalink) {
										echo $thumbnail; // PHPCS: XSS ok.
									} else {
										printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
									}
									?>
								</td>

								<td class="product-name pt-3 pe-3" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
									<?php
									if (!$product_permalink) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
									} else {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
									}

									do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

									// Meta data.
									echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

									// Backorder notification.
									if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
										echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
									}
									?>
								</td>

								<td class="product-price pt-3 pe-3" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</td>

								<td class="product-quantity pt-3 pe-3" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
									<?php
									if ($_product->is_sold_individually()) {
										$product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item); // PHPCS: XSS ok.
									?>
								</td>

								<td class="product-subtotal pt-3 pe-3" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
									<?php
									echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
									?>
								</td>
							</tr>
					<?php
						}
					}
					?>

					<?php do_action('woocommerce_cart_contents'); ?>

					<tr>
						<td colspan="6" class="actions">

							<?php if (wc_coupons_enabled()) { ?>
								<div class="coupon justify-content-center justify-content-lg-start">
									<label for="coupon_code"><?php esc_html_e('Coupon:', 'woocommerce'); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e('Coupon code', 'woocommerce'); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply coupon', 'woocommerce'); ?>"><?php esc_attr_e('Apply coupon', 'woocommerce'); ?></button>
									<?php do_action('woocommerce_cart_coupon'); ?>
								</div>
							<?php } ?>

							<button type="submit" class="button" name="update_cart" value="<?php esc_attr_e('Update cart', 'woocommerce'); ?>"><?php esc_html_e('Update cart', 'woocommerce'); ?></button>

							<?php do_action('woocommerce_cart_actions'); ?>

							<?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
						</td>
					</tr>

					<?php do_action('woocommerce_after_cart_contents'); ?>
				</tbody>
			</table>

			<?php do_action('woocommerce_after_cart_table'); ?>
		</form>

		<?php do_action('woocommerce_before_cart_collaterals'); ?>

		<div class="cart-collaterals d-flex flex-column align-items-center">
			<?php
			/**
			 * Cart collaterals hook.
			 *
			 * @hooked woocommerce_cross_sell_display
			 * @hooked woocommerce_cart_totals - 10
			 */
			do_action('woocommerce_cart_collaterals'); ?>
			<a href="<?php echo esc_url(site_url('/shop')); ?>"><button class="continue-shopping-button button mt-8"><?php echo __('Continue shopping', 'sprystore'); ?>&nbsp;&nbsp;<i class="fas fa-shopping-bag"></i></button></a>
		</div>
	</div>
	<!-- Custom code: info to the customer and FAQs -->

	<div class="container buying-info mb-4 py-2">

		<div class="row justify-content-center">
			<div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex flex-column text-center mx-2 px-3 py-5 mt-4 rounded-3 bg-bgcolor">
				<span><i class="fas fa-sync"></i></span>
				<p class="m-0">30-day exchanges and returns</p>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex flex-column text-center mx-2 px-3 py-5 mt-4 rounded-2 bg-bgcolor">
				<span><i class="fas fa-user-shield"></i></span>
				<p class="m-0">100% secure</p>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex flex-column text-center mx-2 px-3 py-5 mt-4 rounded-2 bg-bgcolor">
				<span><i class="fas fa-shipping-fast"></i></span>
				<p class="m-0">Free Worldwide shipping</p>
			</div>
			<div class="col-6 col-sm-6 col-md-6 col-lg-3 d-flex flex-column text-center mx-2 px-3 py-5 mt-4 rounded-2 bg-bgcolor">
				<span><i class="fas fa-info-circle"></i></span>
				<p class="m-0">24/7 customer support</p>
			</div>
		</div>

	</div>
	<div class="container faq w-100">
		<h3 class="faq text-center fs-4 fw-normal">Frequently Asked Cuestions</h3>
		<div class="accordion" id="accordionExample">
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingOne">
					<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
						Can I pay by Paypal?
					</button>
				</h2>
				<div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<strong>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sed, aliquid!</strong>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti neque ipsam alias repellendus beatae suscipit at modi veritatis atque dolores.
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingTwo">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
						How many days will I have to wait for the order?
					</button>
				</h2>
				<div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<strong>Lorem ipsum dolor sit amet.</strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure nihil qui atque reiciendis consectetur iste sunt aliquid delectus, maxime sequi dicta cum in adipisci commodi.
					</div>
				</div>
			</div>
			<div class="accordion-item">
				<h2 class="accordion-header" id="headingThree">
					<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
						What is the warranty?
					</button>
				</h2>
				<div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
					<div class="accordion-body">
						<strong>Lorem ipsum dolor, sit amet consectetur adipisicing.</strong>Lorem ipsum dolor sit amet consectetur adipisicing elit. Perferendis dolorem quasi excepturi at provident, reprehenderit, quidem, eos exercitationem cumque ratione cupiditate ipsum veritatis eveniet pariatur.
					</div>
				</div>
			</div>
		</div>

	</div>
	<!--end custom code-->
</div><!-- end container-->
<?php do_action('woocommerce_after_cart'); ?>