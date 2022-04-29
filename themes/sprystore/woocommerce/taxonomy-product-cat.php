<?php

/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */
get_header();

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
global $wp;
$url =  home_url($wp->request);

switch ($url) {
	case site_url('/product-category/bag'):
		wc_get_template('archive-bag.php');
		break;
	case site_url('/product-category/sweater'):
		wc_get_template('archive-sweater.php');
		break;
	case site_url('/product-category/shoes'):
		wc_get_template('archive-shoes.php');
		break;
	case site_url('/product-category/coat'):
		wc_get_template('archive-coat.php');
		break;
	case site_url('/product-category/hat'):
		wc_get_template('archive-hat.php');
		break;
	case site_url('/product-category/shirt'):
		wc_get_template('archive-shirt.php');
		break;
	case site_url('/product-category/t-shirt'):
		wc_get_template('archive-t-shirt.php');
		break;
	case site_url('/product-category/trousers'):
		wc_get_template('archive-trousers.php');
		break;
}

get_footer();
