<?php
/**
 * hvg-blog-general functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package hvg-blog-general
 */

require_once('inc/bs4navwalker.php');

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.15');
}

if (! function_exists('hvg_blog_general_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function hvg_blog_general_setup()
    {
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
                'primary_menu' => esc_html__('Fejléc navigációs menü', 'hvg-blog-general'),
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
                'hvg_blog_general_custom_background_args',
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
    }
endif;
add_action('after_setup_theme', 'hvg_blog_general_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hvg_blog_general_content_width()
{
    $GLOBALS['content_width'] = apply_filters('hvg_blog_general_content_width', 1280);
}
add_action('after_setup_theme', 'hvg_blog_general_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function hvg_blog_general_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'hvg-blog-general'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'hvg-blog-general'),
            'before_widget' => '<section id="%1$s" class="widget aside-content %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h6 class="widget-title">',
            'after_title'   => '</h6>',
        )
    );
}
add_action('widgets_init', 'hvg_blog_general_widgets_init');

function hvg_blog_custom_header_setup()
{
    $args = array(
            'default-image'      => get_template_directory_uri() . '/assets/images/default_empty_image.jpg',
            'default-text-color' => '000',
            'width'              => 1280,
            'height'             => 250,
            'flex-width'         => true,
            'flex-height'        => true,
    );
    add_theme_support('custom-header', $args);
}
add_action('after_setup_theme', 'hvg_blog_custom_header_setup');


/**
 * Enqueue scripts and styles.
 */
function hvg_blog_general_scripts()
{
    wp_enqueue_style('hvg-blog-general-style', get_stylesheet_uri(), array(), _S_VERSION);

    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css', array(), _S_VERSION);

    wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', false);

    wp_enqueue_script('hvg-blog-general-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true);
    wp_enqueue_script('hvg-blog-jquery', get_template_directory_uri() . '/js/jquery-3.5.1.slim.min.js', array(), '3.5.1', true);
    wp_enqueue_script('hvg-blog-bootstrap-js', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array(), '4.5.2', true);
    wp_enqueue_script('hvg-blog-js', get_template_directory_uri() . '/js/main.js', array(), _S_VERSION, true);
}
add_action('wp_enqueue_scripts', 'hvg_blog_general_scripts');

/**
 * Enqueue scripts and styles.
 */
function hvg_blog_customizer_fonts()
{
    $headings_font = esc_html(get_theme_mod('hvg_blog_headings_fonts'));
    $body_font = esc_html(get_theme_mod('hvg_blog_body_fonts'));

    if ($headings_font) {
        wp_enqueue_style('hvg_blog_blog-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font);
    } else {
        wp_enqueue_style('hvg_blog_blog-source-sans', '//fonts.googleapis.com/css?family=Abril+Fatface:400italic,700italic,400,700');
    }
    if ($body_font) {
        wp_enqueue_style('hvg_blog_blog-body-fonts', '//fonts.googleapis.com/css?family='. $body_font);
    } else {
        wp_enqueue_style('hvg_blog_blog-source-body', '//fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic');
    }
}
add_action('wp_enqueue_scripts', 'hvg_blog_customizer_fonts');

/**
 * Google Fonts
 */
require get_template_directory() . '/inc/gfonts.php';

function catch_that_image($size, $show_empty = true)
{
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+?src=[\'"]([^\'"]+)[\'"].*?>/i', $post->post_content, $matches);

    if ($output > 0) {
        $first_img = $matches[1][0];

        if (empty($first_img) && $show_empty) {
            if (get_theme_mod('hvg_blog_default_image')) {
                $first_img = get_theme_mod('hvg_blog_default_image');
            } else {
                $first_img = get_template_directory_uri().'/iassets/mages/default_empty_image.jpg';
            }
        }
    } else {
        $first_img = false;
        if ($show_empty) {
            if (get_theme_mod('hvg_blog_default_image')) {
                $first_img = get_theme_mod('hvg_blog_default_image');
            } else {
                $first_img = get_template_directory_uri().'/iassets/mages/default_empty_image.jpg';
            }
        }
    }

    return $first_img;
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/theme-customizer.php';

/**
 * Customize widgets.
 */
require get_template_directory() . '/inc/template-widgets.php';

/**
 * Load Jetpack compatibility file.
 */
if (defined('JETPACK__VERSION')) {
    require get_template_directory() . '/inc/jetpack.php';
}
