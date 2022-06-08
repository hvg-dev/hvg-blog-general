<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package hvg-blog-general
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <header class="article-header">

        <?php
        if (get_the_post_thumbnail()) {
            hvg_blog_general_post_thumbnail('post_thumbnail');
        }
        ?>

        <?php the_title('<h1 class="entry-title h1 page-title">', '</h1>'); ?>

        <p class="post-meta">
            <?php hvg_blog_general_posted_on();?>
            <?php hvg_blog_general_posted_by();?>
            <?php /*<span class="post-comments"><a href="#comments"><i class="fa fa-comments"></i>  6 comments</a></span>*/?>
        </p>
        <div class="fb-like fb_iframe_widget fb_iframe_widget_fluid" data-href="<?php echo esc_url(get_permalink());?>" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true" fb-xfbml-state="rendered" fb-iframe-plugin-query="action=like&amp;app_id=&amp;container_width=683&amp;href=https%3A%2F%2Fhvg.hu%2Fitthon%2F20200908_covid_19_kezeles_koronavirus_gyogyszerek&amp;layout=standard&amp;locale=hu_HU&amp;sdk=joey&amp;share=true&amp;size=small&amp;width="><span style="vertical-align: bottom; width: 450px; height: 20px;"><iframe name="f318479f0dfb998" width="1000px" height="1000px" data-testid="fb:like Facebook Social Plugin" title="fb:like Facebook Social Plugin" frameborder="0" allowtransparency="true" allowfullscreen="true" scrolling="no" allow="encrypted-media" src="https://www.facebook.com/v8.0/plugins/like.php?action=like&amp;app_id=&amp;channel=https%3A%2F%2Fstaticxx.facebook.com%2Fx%2Fconnect%2Fxd_arbiter%2F%3Fversion%3D46%23cb%3Df19fc1bb588dcec%26domain%3Dpeti.rkdesign.hu%26origin%3Dhttp%253A%252F%252Fpeti.rkdesign.hu%252Ff132fce208ecea%26relation%3Dparent.parent&amp;container_width=683&amp;href=https%3A%2F%2Fhvg.hu%2Fitthon%2F20200908_covid_19_kezeles_koronavirus_gyogyszerek&amp;layout=standard&amp;locale=hu_HU&amp;sdk=joey&amp;share=true&amp;size=small&amp;width=" style="border: none; visibility: visible; width: 450px; height: 20px;" class=""></iframe></span></div>

    </header>

    <div class="entry-content">
        <?php
        the_content();

        $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'hvg-blog-general'));
        if ($tags_list) {
            /* translators: 1: list of tags. */
            printf('<span class="tags-links">' . esc_html__('%1$s', 'hvg-blog-general') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
        }

        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'hvg-blog-general'),
                'after'  => '</div>',
            )
        );
        ?>
    </div><!-- .entry-content -->

    <?php if (get_edit_post_link()) : ?>
        <footer class="entry-footer">
            <?php
            edit_post_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: Name of current post. Only visible to screen readers */
                        __('Edit <span class="screen-reader-text">%s</span>', 'hvg-blog-general'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                ),
                '<span class="edit-link">',
                '</span>'
            );
            ?>
        </footer><!-- .entry-footer -->
    <?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
