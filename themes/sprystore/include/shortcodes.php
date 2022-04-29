<?php

/****************Shortcode to show the Teams Custom Post Type in the Front end ***************/

function hr_show_teams()
{
    $args = array(
        'post_type' => 'team',
        'posts_per_page' => -1
    );
?>
    <?php ob_start(); ?>
    <div class="container-fluid">
        <div class="team-title">
            meet the <span class="text-orange">team</span>
        </div>
        <div class="row d-flex flex-wrap justify-content-evenly px-6 pb-6">
            <?php
            // The Query
            $the_query = new WP_Query($args);

            //The loop 
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) :
                    $the_query->the_post();
            ?>
                    <div class="col-12 col-md-4 justify-content-center team-card px-3 my-3">
                        <?php if (has_post_thumbnail()) :
                            the_post_thumbnail(array(350, 450), array('alt' => get_the_title(), 'class' => "card-img img-fluid"));
                        endif; ?>
                        <div class="card-info">
                            <?php $name = get_field('teams_name');
                            $role = get_field('teams_role');
                            $facebook = get_field('teams_facebook');
                            $twitter = get_field('teams_twitter');
                            ?>
                            <a href="#" class="card-info-name pt-3"><?php echo '<h3>' . $name . '</h3>'; ?></a>
                            <p class="card-info-role"><?php echo $role; ?></p>
                            <div class="card-info-social pb-2 d-flex align-items-center justify-content-between">
                                <a href="<?php echo $facebook; ?>"><span class="fa fa-facebook"></span></a>
                                <a href="<?php echo $twitter; ?>"><span class="fa fa-twitter"></span></a>
                            </div>

                        </div>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;

            ?>
        </div>
    </div>
    <?php $output = ob_get_clean(); ?>
    <?php return $output; ?>
<?php
}
add_shortcode('show_team', 'hr_show_teams');

/****************Shortcode to show the Testimonials Custom Post Type in the Front end ***************/

function hr_show_testimonials()
{
    $args = array(
        'post_type' => 'testimonial',
        'posts_per_page' => -1
    );
    ob_start(); ?>
    <?php $count_testimonials = wp_count_posts('testimonial')->publish; ?>
    <div class="container-fluid testimonials bg-bgcolor">
        <div class="testimonial-title text-center pt-6 pb-3">
            <h2>customers <span class="text-orange">love</span></h2>
            <p class="subtitle">what people say</p>
        </div>
        <div class="row d-flex flex-wrap justify-content-evenly px-6 pb-6">
            <?php
            // The Query
            $the_query = new WP_Query($args);

            //The loop 
            if ($the_query->have_posts()) :
                while ($the_query->have_posts()) :
                    $the_query->the_post();
            ?>
                    <?php if ($count_testimonials > 4) { ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-4 justify-content-center testimonial-card px-3 my-3">
                        <?php } else { ?>
                            <div class="col-12 col-sm-6 col-md-6 col-lg-3 justify-content-center testimonial-card px-3 my-3">
                            <?php } ?>
                            <div class="testimonial-body bg-secondary text-center">
                                <span class="fa fa-quote-left"></span>
                                <p class="testimonial-body-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Labore rem, dicta assumenda mollitia molestias quas nihil quasis.</p>
                            </div>
                            <div class="testimonial-footer text-center mt-4">
                                <?php if (has_post_thumbnail()) :
                                    the_post_thumbnail(array(70, 70), array('alt' => get_the_title(), 'class' => "card-img img-fluid rounded-circle"));
                                endif; ?>
                                <?php $name = get_field('testimonials-name'); ?>
                                <h5 class="testimonial-footer-name pt-2"><?php echo $name; ?></h5>
                            </div>
                            </div>
                    <?php
                endwhile;
                wp_reset_postdata();
            endif;

                    ?>
                        </div>
        </div>
        <?php $output = ob_get_clean(); ?>
        <?php return $output; ?>
    <?php
}
add_shortcode('show_testimonial', 'hr_show_testimonials');

/********Shortcode to show the Latest Posts (in the Blog) in the Front end ***************/

function hr_show_latest_posts()
{
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC'
    );
    ob_start(); ?>

        <div class="container-fluid testimonials">
            <div class="testimonial-title text-center pt-6 pb-3">
                <h2>Latest blog <span class="text-orange">posts</span></h2>
                <p class="subtitle">Handpicked Favourites just for you</p>
            </div>
            <div class="row d-flex flex-wrap justify-content-evenly px-6 pb-6">
                <?php
                // The Query
                $the_query = new WP_Query($args);

                //The loop 
                if ($the_query->have_posts()) :
                    while ($the_query->have_posts()) :
                        $the_query->the_post();
                ?>
                        <div class="entry-header__post col-12 col-md-6 col-lg-3 px-4 py-3" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

                            <?php sprystore_post_thumbnail(); ?>
                            <div class="entry-meta bg-bgcolor px-3">
                                <div class="entry-meta__post text-center pt-2 pb-4">
                                    <span class="author">By <?php echo get_the_author(); ?></span>
                                    <span class="date"><?php echo get_the_date('d/m/Y'); ?></span>
                                </div><!-- .entry-meta -->
                                <h2 class="entry-title__post text-center">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark">
                                        <p><?php echo get_the_title(); ?></p>
                                    </a>
                                </h2>
                            </div>

                        </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;

                ?>
            </div>
        </div>
        <?php $output = ob_get_clean(); ?>
        <?php return $output; ?>
    <?php
}
add_shortcode('show_latest_posts', 'hr_show_latest_posts');
