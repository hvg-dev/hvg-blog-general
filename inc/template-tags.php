<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package hvg-blog-general
 */

if (! function_exists('hvg_blog_general_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function hvg_blog_general_posted_on()
    {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
        }

        $time_string = sprintf(
            $time_string,
            esc_attr(get_the_date(DATE_W3C)),
            esc_html(get_the_date()),
            esc_attr(get_the_modified_date(DATE_W3C)),
            esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
            $time_string
        );

        echo '<span class="post-date"><i class="fa fa-clock-o"></i> ' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (! function_exists('hvg_blog_general_posted_by')) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function hvg_blog_general_posted_by()
    {
        $byline = sprintf(
            '<span class="author vcard"><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="post-author"><i class="fa fa-pencil"></i> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    }
endif;

if (! function_exists('hvg_blog_general_entry_footer')) :
    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function hvg_blog_general_entry_footer()
    {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'hvg-blog-general'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                // printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'hvg-blog-general' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }

            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html_x(' ', 'list item separator', 'hvg-blog-general'));
            if ($tags_list) {
                /* translators: 1: list of tags. */
                printf('<span class="tags-links">' . esc_html__('%1$s', 'hvg-blog-general') . '</span>', $tags_list); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            }
        }

        if (! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(
                sprintf(
                    wp_kses(
                        /* translators: %s: post title */
                        __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hvg-blog-general'),
                        array(
                            'span' => array(
                                'class' => array(),
                            ),
                        )
                    ),
                    wp_kses_post(get_the_title())
                )
            );
            echo '</span>';
        }

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
    }
endif;

if (! function_exists('hvg_blog_general_post_thumbnail')) :
    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function hvg_blog_general_post_thumbnail($size = 'large')
    {
        if (post_password_required() || is_attachment() || ! has_post_thumbnail()) {
            return;
        }



        ?>

            <div class="post-thumbnail generted">
                <?php hvg_blog_general_get_image($size); ?>
            </div><!-- .post-thumbnail -->

            <?php
    }
endif;

if (! function_exists('wp_body_open')) :
    /**
     * Shim for sites older than 5.2.
     *
     * @link https://core.trac.wordpress.org/ticket/12563
     */
    function wp_body_open()
    {
        do_action('wp_body_open');
    }
endif;

if (! function_exists('hvg_blog_general_search_form')) :
    function hvg_blog_general_search_form()
    {

        echo '
		<form role="search" method="get" id="searchform" action="' . home_url('/') . '"  class="input-group search-group">
			<label class="screen-reader-text" for="s">Keresés az oldalon</label>
			<input type="text" value="' . get_search_query() . '" class="form-control" placeholder="Keresés..." aria-label="Keresés..." name="s" id="s" />
			<div class="input-group-append">
				<button class="btn btn-outline-secondary" type="submit"><i class="fa fa-search"></i></button>
			</div>
		</form>';
    }

endif;

if (! function_exists('hvg_blog_general_get_image')) :
    function hvg_blog_general_get_image($size = 'medium_large', $class = '', $hide_empty_image = 0)
    {

        if (get_the_post_thumbnail()) {
            $post_thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $size, false);
            echo '<a href="';
            the_permalink();
            echo '" class="thumbnail-wrapper article-header__image-link '.$class.'">';
            echo '<figure class=" has-post-thumbnail">';
            echo '<img src="'.esc_url($post_thumbnail[0]).'" alt="'.get_the_title().'" loading="lazy">';
            echo '</figure>';
            echo '</a>';
        } else if ($hide_empty_image == 0) {
            $image = catch_that_image($size, false);
            if ($image) {
                echo '<a href="';
                the_permalink();
                echo '" class="thumbnail-wrapper article-header__image-link  '.$class.'"" loading="lazy">';
                echo '<figure class="'.$class.' has-post-first-image">';
                echo '<img src="';
                echo $image;
                echo '" alt="'.get_the_title().'" />';
                echo '</figure>';
                echo '</a>';
            }
        } else {
            return false;
        }
    }

endif;


if (! function_exists('hvg_blog_posts_navigation')) :
    function hvg_blog_posts_navigation(\WP_Query $wp_query = null, $echo = true, $params = [])
    {
        if (null === $wp_query) {
            global $wp_query;
        }

        $add_args = [];

    //add query (GET) parameters to generated page URLs
    /*if (isset($_GET[ 'sort' ])) {
        $add_args[ 'sort' ] = (string)$_GET[ 'sort' ];
    }*/

        $pages = paginate_links(array_merge([
            'base'         => str_replace(999999999, '%#%', esc_url(get_pagenum_link(999999999))),
            'format'       => '?paged=%#%',
            'current'      => max(1, get_query_var('paged')),
            'total'        => $wp_query->max_num_pages,
            'type'         => 'array',
            'show_all'     => false,
            'end_size'     => 3,
            'mid_size'     => 1,
            'prev_next'    => true,
            'prev_text'    => __('<i class="fa fa-long-arrow-left"></i> Előző'),
            'next_text'    => __('Következő <i class="fa fa-long-arrow-right"></i>'),
            'add_args'     => $add_args,
            'add_fragment' => ''
        ], $params));

        if (is_array($pages)) {
            //$current_page = ( get_query_var( 'paged' ) == 0 ) ? 1 : get_query_var( 'paged' );
            $pagination = '<div class="container px-0 article-pagination"><nav aria-label="Lapozás az oldalak között"><ul class="pagination">';

            foreach ($pages as $page) {
                $pagination .= '<li class="page-item' . (strpos($page, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link', $page) . '</li>';
            }

            $pagination .= '</ul></nav></div>';

            if ($echo) {
                echo $pagination;
            } else {
                return $pagination;
            }
        }

        return null;
    }

endif;

if (! function_exists('hvg_blog_slider')) :
    function hvg_blog_slider($count = 3)
    {

        $q_args = array(
            'orderby'        => 'rand',
            'posts_per_page' => $count,

        );

        $query = new WP_Query($q_args);
        if ($query->have_posts()) :
            echo '
			<section class="site-carousel container pt-5">
			<div id="hvg_carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
			';
            for ($c = 0; $c < $count; $c++) {
                $active_class = ($c == 0) ?  'active' : '';
                echo '<li data-target="#hvg_carousel" data-slide-to="'.$c.'" class="'.$active_class.'"></li>';
            }

            echo '
			</ol>
			<div class="carousel-inner">
			';

            $item_count = 0;
            while ($query->have_posts()) :
                $query->the_post();
                $active_class = ($item_count == 0) ?  'active' : '';
                if (get_the_post_thumbnail()) {
                    $slider_image = get_the_post_thumbnail(get_the_ID(), 'full');
                } else {
                    $slider_image = catch_that_image('full');
                }
                ?>
                <div class="recommended-article carousel-item <?php echo $active_class;?>">
                    <div class="recommended-article__content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                        <a href="<?php the_permalink(); ?>" class="more">Elolvasom</a>
                    </div>
                    <?php echo $slider_image;?>
                </div>

                <?php
                $item_count++;
            endwhile;

            echo '
				</div>
				<a class="carousel-control-prev" href="#hvg_carousel" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Előző</span>
				</a>
				<a class="carousel-control-next" href="#hvg_carousel" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Következő</span>
				</a>
			</div>
			</section>


			';
        endif;
        wp_reset_postdata();
    }

endif;

if (! function_exists('hvg_blog_home_recommended_post')) :
    function hvg_blog_home_recommended_post($count = 3, $type = "row")
    {

        $q_args = array(
            'orderby'        => 'rand',
            'posts_per_page' => $count,

        );

        $query = new WP_Query($q_args);
        if ($query->have_posts()) :
            if ($type == 'grid') {
                echo '<section class="home-recommended-posts home-recommended-posts__grid container">';
            } else {
                echo '<section class="home-recommended-posts container">';
            }

            $item_count = 0;
            while ($query->have_posts()) :
                $query->the_post();

                if (get_the_post_thumbnail()) {
                    $slider_image = get_the_post_thumbnail(get_the_ID(), 'full');
                } else {
                    $slider_image = catch_that_image('full');
                }
                ?>
                <div class="recommended-article">
                    <div class="recommended-article__content">
                        <h2><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h2>
                        <a href="<?php the_permalink(); ?>" class="more">Elolvasom</a>
                    </div>
                    <?php echo $slider_image;?>
                </div>

                <?php
                $item_count++;
            endwhile;

            echo '</section>';
        endif;

        wp_reset_postdata();
    }

endif;


if (! function_exists('hvg_blog_breadcrumb')) :
    function hvg_blog_breadcrumb()
    {

        $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
        $delimiter = ''; // delimiter between crumbs
        $home = get_bloginfo('name'); // text for the 'Home' link
        $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
        $before = '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumb-item active">'; // tag before the current crumb
        $after = '</li>'; // tag after the current crumb
        $before_list = '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumb-item">';
        $after_list = '</li>';

        global $post;
        $homeLink = get_bloginfo('url');

        if (is_home() || is_front_page()) {
            if ($showOnHome == 1) {
                echo '<ul class="breadcrumb"><li><a href="' . $homeLink . '">' . $home . '</a></li></ul>';
            }
        } else {
            echo '
			<nav class="breadcrumb-navigation">
      <div role="navigation" aria-label="Breadcrumbs" class="breadcrumb__navigation" itemprop="breadcrumb">
        <ul class="breadcrumb" itemscope="" itemtype="http://schema.org/BreadcrumbList">
          <meta name="numberOfItems" content="2">
          <meta name="itemListOrder" content="Ascending">
			';

            echo '<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem" class="breadcrumb-item"><a href="' . $homeLink . '" rel="home" itemprop="item"><span itemprop="name">' . $home . '</span></a> <span class="divider">' . $delimiter . '</span></li>';

            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo(get_category_parents($parentCat, true, ' ' . $delimiter . ' '));
                }
                echo $before . '' . single_cat_title('', false) . '' . $after;
            } elseif (is_search()) {
                echo $before . 'Keresési eredmény a  "' . get_search_query() . '" kulcsszóra' . $after;
            } elseif (is_day()) {
                echo $before_list.'<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' '.$after_list;
                echo $before_list.'<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' '.$after_list;
                echo $before . get_the_time('d') . $after;
            } elseif (is_month()) {
                echo $before_list.'<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' '.$after_list;
                echo $before . get_the_time('F') . $after;
            } elseif (is_year()) {
                echo $before . get_the_time('Y') . $after;
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    echo $before_list.'<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a> ' . $delimiter . ' '.$after_list;
                    if ($showCurrent == 1) {
                        echo $before . get_the_title() . $after;
                    }
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    $cats = get_category_parents($cat, true, ' ' . $delimiter . ' ');
                    if ($showCurrent == 0) {
                        $cats = preg_replace("/^(.+)\s$delimiter\s$/", "$1", $cats);
                    }
                    echo $before_list.$cats.$after_list;
                    if ($showCurrent == 1) {
                        echo $before . get_the_title() . $after;
                    }
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                echo $before . $post_type->labels->singular_name . $after;
            } elseif (is_attachment()) {
                $parent = get_post($post->post_parent);
                $cat = get_the_category($parent->ID);
                $cat = $cat[0];
                echo get_category_parents($cat, true, ' ' . $delimiter . ' ');
                echo $before_list.'<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' '.$after_list;
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            } elseif (is_page() && !$post->post_parent) {
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            } elseif (is_page() && $post->post_parent) {
                $parent_id  = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_page($parent_id);
                    $breadcrumbs[] = $before_list.'<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>'.$after_list;
                    $parent_id  = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb) {
                    echo $crumb . ' ' . $delimiter . ' ';
                }
                if ($showCurrent == 1) {
                    echo $before . get_the_title() . $after;
                }
            } elseif (is_tag()) {
                echo $before . 'Címkék: "' . single_tag_title('', false) . '"' . $after;
            } elseif (is_author()) {
                 global $author;
                $userdata = get_userdata($author);
                echo $before . 'Szerző ' . $userdata->display_name . $after;
            } elseif (is_404()) {
                echo $before . '404' . $after;
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ' (';
                }
                echo get_query_var('paged').'. oldal';
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author()) {
                    echo ')';
                }
            }

            echo '
					</ul>
				</div>
			</nav>
			';
        }
    }



endif;


if (! function_exists('hvg_blog_social_links')) :
    function hvg_blog_social_links()
    {
        $get_mods = get_theme_mods();

        $filtered = array_filter($get_mods, function ($key) {
            return strpos($key, 'hvg_blog_social_') === 0;
        }, ARRAY_FILTER_USE_KEY);

        foreach ($filtered as $key => $value) {
            if ($value != '') {
                echo '<a href="'.$value.'" target="_blank"><i class="fa fa-'.str_replace('hvg_blog_social_', '', $key).'"></i></a> ';
            }
        }
    }

endif;
