<?php
get_header();
?>
      <section class="col-md-8 post 404-error">
            <header class="page-header">
                <h1 class="page-title">Ooopsz, ez az oldal nem található 😲</h1>
            </header><!-- .page-header -->

            <div class="page-content">
                <p>
                    Úgy tűnik, ez a tartalom nem található meg az oldalon. Biztos jó linkre kattintottál?<br />
                    Próbálj meg visszalépni az előző oldalra, vagy próbálkozz meg a kereséssel!
                </p>

                <?php hvg_blog_general_search_form();?>

                    <?php
                    $hvg_blog_general_archive_content = '<p>' . sprintf(esc_html__('Nézz körül az archívumban: %1$s', 'hvg-blog-general'), convert_smilies(':)')) . '</p>';

                    the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$hvg_blog_general_archive_content");

                    the_widget('WP_Widget_Tag_Cloud');

                    ?>


                </section>

                <aside class="col-md-4">
                    <?php
                        get_sidebar();
                    ?>
                </aside>
<?php
get_footer();
