<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package sprystore
 */

?>

<footer id="colophon" class="site-footer">
	<div class="container left-footer">
		<h2 class="left-footer__logo">spry<span class="s">s</span>tore</h2>
		<p>Lorem ipsum dolor sit amet,Ea consequuntur illum facere aperiam sequi optio consectetur.Vivamus a ligula quam. Ut blandit eu leo non suscipit.</p>
		<div class="social pt-3">
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-google-plus"></i></a>
			<a href="#"><i class="fa fa-instagram"></i></a>
		</div>
	</div>
	<div class="container right-footer">
		<h3 class="right-footer__title">
			Women's Day Special Offer All Branded Sandals are Flat 50% Discount
		</h3>
		<div class="right-footer__container">
			<div class="links-container">
				<h3>Useful links</h3>
				<div class="links">
					<ul>
						<li><a href="<?php echo esc_url(site_url('/')); ?>">Home</a></li>
						<li><a href="<?php echo esc_url(site_url('/about')); ?>">About us</a></li>
						<li><a href="<?php echo esc_url(site_url('/blog')); ?>">Blog</a></li>
						<li><a href="<?php echo esc_url(site_url('/contact')); ?>">Contact</a></li>
					</ul>
					<ul>
						<li><a href="#">Careers</a></li>
						<li><a href="#">Privacy policy</a></li>
						<li><a href="#">Terms and Conditions</a></li>
						<li><a href="#">Support</a></li>
				</div>
			</div>
			<div class="address-container">
				<h3>Our store</h3>
				<p>49436 Broaddus Honey Court Avenue, Madisonville KY 95020, United States of America</p>
				<h3>We accept:</h3>
				<a class="pay-method" href="/"><span class="fa fa-cc-visa" aria-hidden="true"></span></a>
				<a class="pay-method" href="/"><span class="fa fa-cc-mastercard" aria-hidden="true"></span></a>
				<a class="pay-method" href="/"><span class="fa fa-cc-paypal" aria-hidden="true"></span></a>
				<a class="pay-method" href="/"><span class="fa fa-cc-amex" aria-hidden="true"></span></a>

			</div>
		</div>
	</div>
	<div class="container-fluid low-footer">
		<div class="legal d-flex justify-content-between alig-items-center mb-2">
			<a href="#">Privacy Policy</a>
			<a href="#">Terms of Service</a>
			<a href="#">Customer Care</a>
		</div>
		<div class="copyright">
			<p><i class="fa fa-copyright"></i>
				<?php // set the default timezone to use.
				date_default_timezone_set('UTC');
				echo esc_html(date('Y')); ?>
				SpryStore. All rights reserved. Developed with &#128170 by Humberto
			</p>
		</div>
	</div>

</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>