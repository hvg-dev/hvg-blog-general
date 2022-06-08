<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">

    <?php wp_head(); ?>

    <script type="text/javascript">
        var templateURL = '<?= get_bloginfo("template_url"); ?>';
        var pageURL = '<?= get_bloginfo("url"); ?>';
    </script>

    <?php
    if (get_theme_mod('hvg_blog_social_facebook_appid')) :
        echo '<meta property="fb:app_id" content="'.get_theme_mod('hvg_blog_social_facebook_appid').'" />';
    endif;
    ?>
</head>

<body <?php // body_class(); ?>>

<div id="fb-root"></div>

<?php  if (get_theme_mod('hvg_blog_social_facebook_appid')) { ?>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v8.0&appId=<?php echo get_theme_mod('hvg_blog_social_facebook_appid'); ?>&autoLogAppEvents=1" nonce="RM5twXwt"></script>
<?php	} else { ?>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/hu_HU/sdk.js#xfbml=1&version=v8.0" nonce="Hte0eGCX"></script>
<?php } ?>

<?php wp_body_open(); ?>

<div class="site-wrapper container <?php echo (get_theme_mod('site_content_boxed') ? 'site-wrapper__boxed' : '');?>">
<?php
$mods = get_theme_mods();

//var_dump( $mods );
?>
    <a class="skip-link screen-reader-text" href="#primary">Skip to content</a>

    <header class="site-header container">
        <div class="primary-nav justify-content-center">
            <?php
            if (has_custom_logo()) {
                $image = wp_get_attachment_image_src(get_theme_mod('custom_logo'));
                ?>
                        <a class="navbar-brand navbar-brand__logo " href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($image[0]); ?>" alt="<?php echo get_bloginfo('name'); ?>" loading="lazy" />
                        </a>
                    <?php
            }
                //the_custom_logo();
            ?>
                <?php if (display_header_text()) : ?>
                <div class="navbar-brand navbar-brand__text-logo mb-0">
                    <?php
                    if (is_front_page() && is_home()) :
                        ?>

                            <h1 class="site-title"><a  href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                            <?php
                    else :
                        ?>
                            <p class="site-title"><a  href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                            <?php
                    endif;
                        $hvg_blog_general_description = get_bloginfo('description', 'display');
                    if ($hvg_blog_general_description || is_customize_preview()) :
                        ?>
                            <p class="site-description"><?php echo $hvg_blog_general_description;?></p>
                    <?php endif; ?>

                </div>
                <?php endif; ?>

                <?php if (get_header_image()) : ?>
                        <div id="site-header" class="navbar-brand navbar-brand__background-image mb-3 pt-0">
                                <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                        <img src="<?php header_image(); ?>" width="<?php echo absint(get_custom_header()->width); ?>" height="<?php echo absint(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" loading="lazy">
                                </a>
                        </div>
                <?php endif; ?>
            </div>


        <nav class="navbar navbar-expand-lg">
            <input type="checkbox" id="navbarToggle" name="navbarToggle" class="navbar__checkbox">
            <label class="navbar__toggle" for="navbarToggle">
                <svg class="open-menu" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg>
                <svg class="close-menu" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#444" stroke-width="2" stroke-linecap="butt" stroke-linejoin="arcs">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </label>
            <div class="collapse navbar-collapse">
                <?php
                    wp_nav_menu(array(
                        'menu'            => 'primary_menu',
                        'theme_location'  => 'primary_menu',
                        'container'       => '',
                        'container_id'    => '',
                        'container_class' => 'navigation-container',
                        'menu_id'         => false,
                        'menu_class'      => 'navbar-nav mr-auto',
                        'depth'           => 2,
                        'fallback_cb'     => 'bs4navwalker::fallback',
                        'walker'          => new bs4navwalker()
                    ));
                    ?>


                <div class="navigation-right">
                    <div class="secondary-nav__social">
                        <?php
                        if (get_theme_mod('hvg_blog_social_toggle')) :
                            hvg_blog_social_links();
                        endif;
                        ?>
                    </div>
                    <div class="secondary-nav__search">
                        <?php hvg_blog_general_search_form();?>
            </div>
                </div>
            </div>

        </nav>
    </header>

    <?php
    if (is_home()) {
        if (get_theme_mod('home_slider_toggle')) {
            $count_home_sliders = get_theme_mod('home_slider_number');
            if (get_theme_mod('home_slider_type') == 'slider') {
                hvg_blog_slider($count_home_sliders);
            }
            if (get_theme_mod('home_slider_type') == 'row') {
                hvg_blog_home_recommended_post($count_home_sliders, 'row');
            }
            if (get_theme_mod('home_slider_type') == 'grid') {
                hvg_blog_home_recommended_post($count_home_sliders, 'grid');
            }
        }
    }
    ?>

  <main class="container pt-5" id="primary">
    <div class="row">
