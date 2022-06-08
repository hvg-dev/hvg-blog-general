<?php
get_header();
?>

      <section class="col-md-8">
                <div class="article-card-list">

            <?php
            if (have_posts()) :
                if (is_home() && ! is_front_page()) :
                    ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>

                    <?php
                endif;

                $post_count = 0;

                while (have_posts()) :
                    the_post();

                    /*
                     * Include the Post-Type-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Type name) and that will be used instead.
                     */
                    set_query_var('previewVariables', array('count' => $post_count, 'hide_empty_image' => false));
                    get_template_part('template-parts/content', 'preview', array('count' => $post_count, 'hide_empty_image' => false));

                    $post_count ++;
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
