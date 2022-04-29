<div class="container d-flex flex-column justify-content-start mt-3 mb-3">

    <div class="breadcrumb ms-lg-8 ms-md-6 ms-sm-4">
        <?php
        sprystore_get_breadcrumb(); ?>
    </div>
    <div class="d-flex flex-wrap justify-content-evenly w-100">

        <?php $args = array(
            'post_type'     => 'product',
            'posts_per_page' => -1,
            'tax_query'     => array(
                array(
                    'taxonomy'  => 'product_cat',
                    'field'     => 'slug',
                    'terms'     => 'trousers',
                    'operator'  => 'IN'
                )
            ),
        );
        $sweater_products = new WP_Query($args);
        if ($sweater_products->have_posts()) {
            while ($sweater_products->have_posts()) {
                $sweater_products->the_post();

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
            wp_reset_postdata();
        } else {
            esc_attr_e('No trousers', 'sprystore');
        }

        ?>
    </div>
</div>