<?php
if (isset(get_query_var('previewVariables')['hide_empty_image'])) {
    $hide_empty_image = get_query_var('previewVariables')['hide_empty_image'];
} else {
    $hide_empty_image = false;
}
?>
<article class="article-card" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php hvg_blog_general_get_image('medium_large', 'article-card__featured-image', $hide_empty_image);?>

    <header class="article-header entry-header">
        <?php hvg_blog_general_get_image('medium_large', '', $hide_empty_image);?>
        <?php the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>'); ?>

        <p class="post-meta">
            <?php hvg_blog_general_posted_on();?>
            <?php hvg_blog_general_posted_by();?>
            <!--<span class="post-comments"><a href="#comments"><i class="fa fa-comments"></i>  6 comments</a></span>-->
        </p>
    </header>

    <div class="article-content">

        <?php echo hvg_blog_excerpt(get_the_excerpt(), get_the_excerpt());?>

        <p><a href="<?php echo esc_url(get_permalink());?>" class="more">Tovább olvasom</a></p>
    </div>

    <footer class="article-footer entry-footer">
        <?php hvg_blog_general_entry_footer(); ?>
    </footer>
</article>
