<?php
/*
Hide featured image from post/page individually
Add adult warning to posts individually
*/

// Actions and hooks
add_action('add_meta_boxes', 'hvgblog_post_types_custom_box'); // WP 3.0+
add_action('admin_init', 'hvgblog_post_types_custom_box', 1); // backwards compatible
add_action('save_post', 'hvgblog_post_types_save_postdata'); /* Do something with the data entered */
add_action('wp_head', 'hvgblog_featured_image');
add_action('init', 'hvgblog_hide_featured_image_init');

/**
 *  Adds a box to the main column on the Post and Page edit screens
 *
 * @since Hide Featured Image 1.0
 */
function hvgblog_post_types_custom_box()
{

    global $hvgblog_post_types;
    $hvgblog_post_types = get_post_types('', 'names');
    unset($hvgblog_post_types['attachment'], $hvgblog_post_types['revision'], $hvgblog_post_types['nav_menu_item']);

    foreach ($hvgblog_post_types as $post_type) {
        add_meta_box('hide_featured', __('Kiemelt kép elrejtése a bevezetőben', 'hide-featured-image'), 'hvgblog_featured_box', $post_type, 'side', 'default');
        add_meta_box('adult_warning', __('18+-os tartalom', 'hide-featured-image'), 'hvgblog_adult_warning_box', $post_type, 'side', 'default');
    }
}

/**
 * Add metabox to posts.
 */
function hvgblog_featured_box($post)
{
    wp_nonce_field(plugin_basename(__FILE__), $post->post_type . '_noncename');
    $hide_featured = get_post_meta($post->ID, '_hide_featured', true) ?: 2;
    ?>
    <input type="radio" name="_hide_featured" value="1" <?php checked($hide_featured, 1); ?>><?php _e('Elrejt', 'hide-featured-image'); ?>&nbsp;&nbsp;
    <input type="radio" name="_hide_featured" value="2" <?php checked($hide_featured, 2); ?>><?php _e('Mutat', 'hide-featured-image'); ?><?php
}

function hvgblog_adult_warning_box($post)
{
    wp_nonce_field(plugin_basename(__FILE__), $post->post_type . '_noncename');
    $adult_warning = get_post_meta($post->ID, '_adult_warning', true) ?: 2;
    ?>
    <input type="radio" name="_adult_warning" value="1" <?php checked($adult_warning, 1); ?>>Bekapcsol&nbsp;&nbsp;
    <input type="radio" name="_adult_warning" value="2" <?php checked($adult_warning, 2); ?>>Kikapcsol
    <style>
    #adult_warning {

    }
    #adult_warning .postbox-header h2:before {
        content: '';
        width: 24px;
        height: 24px;
        display: block;
        margin-right: 5px;
        background-size: 100%;
        background-repeat: no-repeat;
        background-image: url(<?php echo get_template_directory_uri();?>/assets/images/icon-18-plus.svg);
    }
    </style>
    <?php
}

/**
 * When the post is saved, saves our custom data
 *
 * @since Hide Featured Image 1.0
 */
function hvgblog_post_types_save_postdata($post_id)
{

    global $hvgblog_post_types;

    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times

    if (!wp_verify_nonce(@$_POST[$_POST['post_type'] . '_noncename'], plugin_basename(__FILE__))) {
        return;
    }

    // OK,nonce has been verified and now we can save the data according the the capabilities of the user
    if (in_array($_POST['post_type'], $hvgblog_post_types)) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        } else {
            $hide_featured = ( isset($_POST['_hide_featured']) && $_POST['_hide_featured'] == 1 ) ? '1' : $_POST['_hide_featured'];
            update_post_meta($post_id, '_hide_featured', $hide_featured);
            $hide_featured = ( isset($_POST['_adult_warning']) && $_POST['_adult_warning'] == 1 ) ? '1' : $_POST['_adult_warning'];
            update_post_meta($post_id, '_adult_warning', $hide_featured);
        }
    }
}

/**
 *  To hide featured image from single post page
 *
 * @since Hide Featured Image 1.0
 */
function hvgblog_featured_image()
{

    if (is_single() || is_page()) {
        $hide = false;
        $hvgblog_hide_all = get_option('hvgblog_hide_all_image');/* Hide all post or image */
        $hide_image =  get_post_meta(get_the_ID(), '_hide_featured', true);/* Hide single post */


        $hide = ( is_page() && isset($hvgblog_hide_all['page_image']) && $hvgblog_hide_all['page_image'] && $hide_image != 2 ) ? true : $hide ;
        $hide = ( is_singular('post') && isset($hvgblog_hide_all['post_image']) && $hvgblog_hide_all['post_image'] && $hide_image != 2 ) ? true : $hide ;
        $hide = ( isset($hide_image) && $hide_image && $hide_image != 2 )? true : $hide;/* Hide single post */

        if ($hide) { ?>
          <style>
          .article-header .post-thumbnail { display: none !important; }
          </style><?php
        }
    }
}

add_filter('body_class', 'hvgblog_add_body_class');
function hvgblog_add_body_class($classes)
{
    if (!empty(get_post_meta(get_the_ID(), '_adult_warning', true)) && get_post_meta(get_the_ID(), '_adult_warning', true) == '1') {
        $classes[] = 'post-adult-warning';
        return $classes;
    }
}

function hvgblog_hide_featured_image_init()
{
    load_plugin_textdomain('hide-featured-image', false, 'hide-featured-image/languages');
}
?>
