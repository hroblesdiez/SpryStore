<?php

/**
 * Register Custom Navigation Walker
 */
function register_navwalker()
{
    require_once get_template_directory() . '/js/class-wp-bootstrap-navwalker.php';
}
add_action('after_setup_theme', 'register_navwalker');


//Sets up theme defaults and registers support for various WordPress features.
if (!function_exists('sprystore_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function sprystore_setup()
    {
        /*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on sprystore, use a find and replace
		 * to change 'sprystore' to the name of your theme in all the template files.
		 */
        load_theme_textdomain('sprystore', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
        add_theme_support('title-tag');

        /*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'menu-1' => esc_html__('Primary', 'sprystore'),
            )
        );

        /*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
        add_theme_support(
            'html5',
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
                'script',
            )
        );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background',
            apply_filters(
                'sprystore_custom_background_args',
                array(
                    'default-color' => 'ffffff',
                    'default-image' => '',
                )
            )
        );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support(
            'custom-logo',
            array(
                'height'      => 250,
                'width'       => 250,
                'flex-width'  => true,
                'flex-height' => true,
            )
        );
        // Add theme support for Woocommerce 
        add_theme_support('woocommerce');
    }
endif;
add_action('after_setup_theme', 'sprystore_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function sprystore_content_width()
{
    $GLOBALS['content_width'] = apply_filters('sprystore_content_width', 640);
}
add_action('after_setup_theme', 'sprystore_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function sprystore_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'sprystore'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'sprystore'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'sprystore_widgets_init');

function sprystore_widgets_woocommerce()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar woocommerce', 'sprystore'),
            'id'            => 'sidebar-2',
            'description'   => esc_html__('Add widgets here.', 'sprystore'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'sprystore_widgets_woocommerce');

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function wpdocs_excerpt_more($more)
{
    if (is_admin()) {
        return $more;
    }
    return '<a href="' . get_the_permalink() . '" rel="nofollow">... [Read more]</a>';
}
add_filter('excerpt_more', 'wpdocs_excerpt_more');



/******************* LOGO IN THE LOGIN PAGE***********************/
/*Change the logo*/
add_action('login_enqueue_scripts', 'sprystore_change_logo_login');

function sprystore_change_logo_login()
{ ?>

    <style type="text/css">
        #login h1 a {
            background-image: url('https://sprystore.com/wp-content/uploads/2021/12/logo.png');
            margin: 0 auto;
            height: 1.75rem;
            transform: scale(3);
            cursor: auto;
        }

        #login h1 a:focus {
            box-shadow: none;
        }
    </style>
<?php }
/*Change the URL link*/
add_filter('login_headerurl', 'sprystore_login_logo_url');
function sprystore_login_logo_url($url)
{
    return '#';
}

add_filter('login_headertitle', 'sprystore_login_logo_url_title');
function sprystore_login_logo_url_title()
{
    return '';
}

add_filter('nav_menu_link_attributes', 'prefix_bs5_dropdown_data_attribute', 20, 3);
/**
 * Use namespaced data attribute for Bootstrap's dropdown toggles.
 *
 * @param array    $atts HTML attributes applied to the item's `<a>` element.
 * @param WP_Post  $item The current menu item.
 * @param stdClass $args An object of wp_nav_menu() arguments.
 * @return array
 */
function prefix_bs5_dropdown_data_attribute($atts, $item, $args)
{
    if (is_a($args->walker, 'WP_Bootstrap_Navwalker')) {
        if (array_key_exists('data-toggle', $atts)) {
            unset($atts['data-toggle']);
            $atts['data-bs-toggle'] = 'dropdown';
        }
    }
    return $atts;
}

//Hide the admin bar for customers 

add_filter('show_admin_bar', 'sprystore_hide_admin_bar');
function sprystore_hide_admin_bar($show)
{
    if (!current_user_can('administrator')) {
        return false;
    }
    return $show;
}

//Hide <p> elements in Contact Form 7

add_filter('wpcf7_autop_or_not', '__return_false');
