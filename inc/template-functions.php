<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package hvg-blog-general
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hvg_blog_general_body_classes($classes)
{
    // Adds a class of hfeed to non-singular pages.
    if (! is_singular()) {
        $classes[] = 'hfeed';
    }

    // Adds a class of no-sidebar when there is no sidebar present.
    if (! is_active_sidebar('sidebar-1')) {
        $classes[] = 'no-sidebar';
    }

    return $classes;
}
add_filter('body_class', 'hvg_blog_general_body_classes');

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function hvg_blog_general_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">', esc_url(get_bloginfo('pingback_url')));
    }
}
add_action('wp_head', 'hvg_blog_general_pingback_header');

// custom image sizes
add_theme_support('post-thumbnails');
add_action('init', 'custom_image_sizes');
function custom_image_sizes()
{
    add_image_size('small', 100, 100);
    add_image_size('medium', 400, 400);
    add_image_size('medium_large', 800, 800);
    add_image_size('large', 1400, 1400);
    add_image_size('square', 150, 150, true);
    add_image_size('recommended_size', 470, 200, true);
    add_image_size('slider_size', 1000, 500, true);
    add_image_size('row_size', 350, 250, true);
    add_image_size('post_thumbnail', 800, 400, true);
}

function limit_words($words, $limit, $append = '...')
{
    $limit = $limit+1;
    $words = explode(' ', $words, $limit);
    array_pop($words);
    $words = implode(' ', $words) . $append;
    return $words;
}

function hvg_blog_excerpt($excerpt, $raw_excerpt)
{
    if (is_admin()) {
        return $excerpt;
    }
    if ('' !== $raw_excerpt) {
        return $excerpt;
    }

    $content = apply_filters('the_content', get_the_content());
    $text = strip_shortcodes($content);
    $emptyParagraphPattern = "/<p[^>]*><\\/p[^>]*>/";
    $cleanContent = preg_replace($emptyParagraphPattern, '', $text);
    $firstParagraph = substr($cleanContent, 0, strpos($cleanContent, '</p>') + 4);
    $strippedContent = html_entity_decode(strip_tags($firstParagraph));
    $maxWords = 50;
    $excerpt = limit_words($strippedContent, $maxWords);

    if (strlen($excerpt) > 3) {
        return wp_strip_all_tags($excerpt);
    } else {
        $content = get_the_content();
        $content = preg_replace("/<img[^>]+\>/i", "", $content);
        $content = preg_replace("/<iframe[^>]+\>/i", "", $content);
        $content = apply_filters('the_content', $content);
        $content = str_replace(']]>', ']]>', $content);
        $content = force_balance_tags($content);
        $content =  preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
        $excerpt = limit_words(wp_strip_all_tags($content), $maxWords);
        return wp_strip_all_tags($excerpt);
    }
}
add_filter('wp_trim_excerpt', 'hvg_blog_excerpt', 99, 2);

/**
 * Add custom meta boxes
 */
require get_template_directory() . '/inc/meta-boxes.php';

