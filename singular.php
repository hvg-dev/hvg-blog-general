<?php
get_header();
?>
      <section class="col-md-8 post">
                <?php hvg_blog_breadcrumb();?>
            <?php
            if (have_posts()) :
                ?>
                <header>
                    <h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
                </header>

                <?php

                /* Start the Loop */
                while (have_posts()) :
                    $adultWarning = get_post_meta($post->ID, '_adult_warning', true) ?? '2';

                    if ($adultWarning == '1') {
                        get_template_part('template-parts/adult-warning');
                    }

                    the_post();

                    get_template_part('template-parts/content', 'page');
                endwhile;

                the_posts_navigation();
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
