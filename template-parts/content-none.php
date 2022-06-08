<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hvg-blog-general
 */

?>

<section class="no-results not-found">
    <header class="page-header">
        <h1 class="page-title">Nincs találat  😲</h1>
    </header><!-- .page-header -->

    <div class="page-content">
        <?php
        if (is_home() && current_user_can('publish_posts')) :
            printf(
                '<p>' . wp_kses(
                    /* translators: 1: link to WP admin new post page. */
                    __('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'hvg-blog-general'),
                    array(
                        'a' => array(
                            'href' => array(),
                        ),
                    )
                ) . '</p>',
                esc_url(admin_url('post-new.php'))
            );
        elseif (is_search()) :
            ?>

            <p>
                Sajnáljuk, de a megadott kulcsszóra nincsen találat az oldalon.  Próbálj ki más kulcsszót a kereséshez.
            </p>
            <?php
            get_search_form();
        else :
            ?>
            <p>
                Sajnáljuk, de a megadott kulcsszóra nincsen találat az oldalon.  Próbálj ki más kulcsszót a kereséshez.
            </p>
            <?php
            get_search_form();
        endif;
        ?>
    </div><!-- .page-content -->
</section><!-- .no-results -->
