<?php
get_header();
?>

        <section class="col-md-8">
            <?php if (have_posts()) : ?>
                <header class="page-header">
                    <h1 class="h1 page-title">
                    <?php
                    printf(esc_html__('Keresési találatok a  %s kifejezésre', 'hvg-blog-general'), '<span>' . get_search_query() . '</span>');
                    ?>
                    </h1>
                </header>

                <?php hvg_blog_breadcrumb();?>

                <div class="article-card-list">
                <?php
                while (have_posts()) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    get_template_part('template-parts/content', 'preview');
                endwhile;

                echo '</div>';

                hvg_blog_posts_navigation();
            else :
                get_template_part('template-parts/content', 'none');
            endif;
            ?>

            </section>

            <aside class="col-md-4">
                <?php
                    get_sidebar();
                ?>
      </aside>

<?php

get_footer();
