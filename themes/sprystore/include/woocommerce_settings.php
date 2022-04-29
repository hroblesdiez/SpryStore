<?php

/****************************WOOCOMMERCE********************************/

/**
 * Custom breadcrumb
 */
function sprystore_get_breadcrumb()
{
    global $post;
    echo '<a href=" ' . esc_url(home_url()) . '" rel="nofollow">Home</a>';
    echo "&nbsp;>&nbsp;";
    echo '<a href=" ' . esc_url(home_url('shop')) . '" rel="nofollow">Shop</a>';

    if (is_single()) {
        echo "&nbsp;>&nbsp;";
        global $post;
        $categories = get_the_terms($post->ID, 'product_cat');
        foreach ($categories as $category) {
            $product_category_name = $category->name;
            $product_category_id = $category->term_id;
            $link = get_category_link($product_category_id);
            echo '<a href=" ' . esc_url($link) . ' ">' . esc_html($product_category_name) . ' </a>';
        }
        echo "&nbsp;>&nbsp;";
        echo $post->post_title;
    } else if (is_archive()) {
        echo "&nbsp;>&nbsp;";
        $categories = get_the_terms($post->ID, 'product_cat');
        foreach ($categories as $category) {
            $product_category_name = $category->name;
            echo esc_html($product_category_name);
        }
    }
}



/********************************************SINGLE-PRODUCT Changes****************************/



/* Add a div to contain the woocommerce images on the left and the summary on the right*/
add_filter('woocommerce_before_single_product_summary', 'sprystore_insert_div_before_single_product_summary');
function sprystore_insert_div_before_single_product_summary()
{
    echo '<div class="single-product-wrapper row">';
}
add_filter('woocommerce_after_single_product_summary', 'sprystore_close_div_before_single_product_summary');
function sprystore_close_div_before_single_product_summary()
{
    echo '</div>';
}


/* Remove meta, excerpt, sidebar and sale flash, data tabs. I move the wc notices down the summary*/
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);

remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);


remove_action('woocommerce_before_single_product', 'woocommerce_output_all_notices', 10);
add_action('woocommerce_after_add_to_cart_form', 'woocommerce_output_all_notices', 20);

add_action('woocommerce_after_add_to_cart_form', 'woocommerce_output_related_products', 60);

/*I move the Description tab from the tabs to the Summary area*/
add_action('woocommerce_single_product_summary', 'sprystore_product_description', 20);
function sprystore_product_description()
{
    wc_get_template('/single-product/tabs/description.php');
}




/*Add a reminder text in sales offers*/
add_action('woocommerce_single_product_summary', 'sprystore_discount_notification', 0);
function sprystore_discount_notification()
{

    if (is_product() && has_term('discount-30', 'product_tag')) {

        echo '<p><strong>This product applies for a 30% discount for the next 48 hours!</strong></p>';
    }
}


/*Change the text in the Add to cart buttons*/
add_filter('woocommerce_product_single_add_to_cart_text', 'sprystore_add_to_crt_text');
function sprystore_add_to_crt_text()
{
    return __('Go', 'sprystore');
}
if (is_shop()) {
    add_filter('woocommerce_product_add_to_cart_text', 'sprystore_add_product_to_cart_text');
    function sprystore_add_product_to_cart_text()
    {
        return __('Buy', 'sprystore');
    }
}


/* Change the Description title in related products */
add_filter('woocommerce_product_related_products_heading', 'sprystore_change_relate_products_title');
function sprystore_change_relate_products_title()
{
    return __('You could be interested in...', 'sprystore');
}


/*Add a new class (text-center) to products in related products*/
function sprystore_woocommerce_post_class($classes, $product)
{
    global $woocommerce_loop;

    // is_product() - Returns true on a single product page
    // NOT single product page, so return
    if (!is_product()) return $classes;

    // The related products section, so return
    if ($woocommerce_loop['name'] == 'related')
        // Add new class
        $classes[] = 'text-center';
    return $classes;
}
add_filter('woocommerce_post_class', 'sprystore_woocommerce_post_class', 10, 2);


/**
 * Enqueue  my own woocommerce stylesheet
 */
function sprystore_enqueue_woocommerce_style()
{
    wp_register_style('sprystore-woocommerce', get_template_directory_uri() . '/css/mywoocommerce.css');

    if (class_exists('woocommerce')) {
        wp_enqueue_style('sprystore-woocommerce');
    }
}
add_action('wp_enqueue_scripts', 'sprystore_enqueue_woocommerce_style');

//I change the message and button when customer click in "add to cart" button in single-product page 
add_filter('wc_add_to_cart_message_html', 'wc_add_to_cart_message_html_filter', 60, 2);
function wc_add_to_cart_message_html_filter($message, $products)
{
    foreach ($products as $product_id => $quantity) {

        // Get the WC_Product object
        $product = wc_get_product($product_id);
        //The product wp_title
        $product_title = $product->get_title();
        //Get the quantity
        $product_quantity = $_POST['quantity'];

        return '<a href="https://sprystore.com/cart/" tabindex="1" class="button wc-forward">
                        <span class=" view_cart">View Cart</span>
                        <span class="cart-icon-notice"><i class="fas fa-shopping-cart" aria-hidden="true"></i></span>
                </a>
                <p>You have added ' . $product_quantity . ' ' . $product_title . ' to the cart </p>
    
            </div>';
    }
    return $message;
}

//Change the Checkout button in cart page
remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
add_action('woocommerce_proceed_to_checkout', 'sp_woo_custom_checkout_button_text', 20);

function sp_woo_custom_checkout_button_text()
{

?>
    <button type="button" class="checkout-button button alt wc-forward" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><?php esc_html_e('Checkout&nbsp;&nbsp;&euro;', 'woocommerce'); ?></button>
    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php echo __('<p>Thanks for your attention.<br/>This is not a commercial web, just a portfolio one.</p>', 'sprystore'); ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
<?php
}


add_action('woocommerce_before_cart', 'woocommerce_output_all_notices', 10);

/**
 *  Disable specific stylesheets 
 */
// Remove each style one by one
add_filter('woocommerce_enqueue_styles', 'sprystore_dequeue_styles');
function sprystore_dequeue_styles($enqueue_styles)
{
    unset($enqueue_styles['woocommerce-general']);    // Remove the gloss
    //unset($enqueue_styles['woocommerce-layout']);        // Remove the layout
    unset($enqueue_styles['woocommerce-smallscreen']);    // Remove the smallscreen optimisation
    return $enqueue_styles;
}
/**
 * Change the number of columns in related products in single-product
 */
add_filter('woocommerce_product_loop_start', 'sprystore_change_number_columns_related_products', 20);
function sprystore_change_number_columns_related_products($class)
{
    if (!is_front_page()) {
        $class = '<ul class="products d-flex flex-row align-items-stretch">';
        return $class;
    }
}

//Function that will return the HTML for the advanced-search-form 

function buildSelect($tax)
{
    $terms = get_terms($tax);
    $selectHTML = '<select name="' . $tax . '" class="">';
    $selectHTML .= '<option value=""> ' . ucfirst($tax) . ' </option>';
    foreach ($terms as $term) {
        $selectHTML .= '<option value="' . $term->slug . ' "> ' . $term->slug . ' </option>';
    }
    $selectHTML .= '</select>';
    return $selectHTML;
}

//Hide sales offer in front-page 

add_filter('woocommerce_sale_flash', 'sprystore_hide_sales_offer_ad', 10, 1);

function sprystore_hide_sales_offer_ad()
{

    if (is_front_page()) {
        return false;
    }
}

add_filter('woocommerce_before_shop_loop_item_title', 'sprystore_sales_offer_ad');

function sprystore_sales_offer_ad()
{
    global $product;
    global $post;
    $terms = get_the_terms($post->ID, 'product_tag');
    $offer = [];
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $offer[] = $term->description;
        }
        if ($product->is_on_sale() && !is_front_page()) {
            if (count($offer) > 1) {
                echo '<span class="on-sale">Sale Off</span>';
            } else {
                echo '<span class="on-sale">' . $offer[0] . '</span>';
            }
        }
    }
}
// Add clases to product gallery wrapper in single product page 
add_filter('woocommerce_single_product_image_gallery_classes', 'sprystore_add_classes_single_product_image_gallery');

function sprystore_add_classes_single_product_image_gallery($wrapper_classes)
{

    $wrapper_classes = array('woocommerce-product-gallery', 'col-12', 'col-lg-7', 'px-3');
    return $wrapper_classes;
}

/**
 * Change number of related products output
 */
add_filter('woocommerce_output_related_products_args', 'sprystore_related_products_args', 20);
function sprystore_related_products_args($args)
{
    $args['posts_per_page'] = 3; // 3 related products
    $args['columns'] = 3; // arranged in 3 columns
    return $args;
}
