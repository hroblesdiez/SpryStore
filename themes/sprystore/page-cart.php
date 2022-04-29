<?php

/**
 * The template for displaying the cart page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package sprystore
 */

get_header();
?>

<main id="primary" class="site-main">
    <?php
    wc_get_template('cart/cart.php');
    ?>
</main><!-- #main -->

<?php
//get_footer();
get_footer();
