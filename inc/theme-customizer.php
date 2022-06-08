<?php
// remove nave menus
add_action('customize_register', function ($wp_customize) {
  /** @var WP_Customize_Manager $wp_customize */
  //remove_action( 'customize_controls_enqueue_scripts', array( $wp_customize->nav_menus, 'enqueue_scripts' ) );
  //remove_action( 'customize_register', array( $wp_customize->nav_menus, 'customize_register' ), 11 );
  //remove_filter( 'customize_dynamic_setting_args', array( $wp_customize->nav_menus, 'filter_dynamic_setting_args' ) );
  //remove_filter( 'customize_dynamic_setting_class', array( $wp_customize->nav_menus, 'filter_dynamic_setting_class' ) );
  //remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->nav_menus, 'print_templates' ) );
  //remove_action( 'customize_controls_print_footer_scripts', array( $wp_customize->nav_menus, 'available_items_template' ) );
  //remove_action( 'customize_preview_init', array( $wp_customize->nav_menus, 'customize_preview_init' ) );
}, 10);

function hvg_blog_remove_sections($wp_customize)
{
  //$wp_customize->remove_section('header_image');
  //$wp_customize->remove_panel('nav_menus');
  //$wp_customize->remove_panel('widgets');
  //$wp_customize->remove_section('custom_css');
  //$wp_customize->remove_section('colors');
    $wp_customize->remove_section('background_image');
    $wp_customize->remove_panel('themes');
  //$wp_customize->remove_section('static_front_page');
  //$wp_customize->remove_section('title_tagline');
}
add_action('customize_register', 'hvg_blog_remove_sections');

require_once 'custom-controls.php';

add_action('customize_register', 'hvg_blog_customizer_settings');
function hvg_blog_customizer_settings($wp_customize)
{


  /*
  * Social links
  */
    $wp_customize->add_section('hvg_blog_socials', array(
    'title'      => 'Közösségi oldalak linkjei',
    'priority'   => 22,
    ));

    $wp_customize->add_setting(
        'hvg_blog_social_toggle',
        array(
        'default' => true,
        'transport' => 'refresh',
        //'sanitize_callback' => 'hvg_blog_sanitize_checkbox',
        'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control(
        'hvg_blog_social_toggle',
        array(
        'label' => 'Közösségi linkek megjelenítése a fejléc alatt',
        'section'  => 'hvg_blog_socials',
        'type'=> 'checkbox'
        )
    );

    $wp_customize->add_setting('hvg_blog_social_facebook_appid', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_facebook_appid', array(
    'type'     => 'text',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'Facebook oldal alkalmazás ID/appID (a kommentelés moderálásához szükséges)',
    ));

    $wp_customize->add_setting('hvg_blog_social_facebook', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_facebook', array(
    'type'     => 'url',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'Facebook oldal linkje',
    ));

    $wp_customize->add_setting('hvg_blog_social_instagram', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_instagram', array(
    'type'     => 'url',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'Instagram oldal linkje',
    ));


    $wp_customize->add_setting('hvg_blog_social_linkedin', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_linkedin', array(
    'type'     => 'url',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'LinkedIn oldal linkje',
    ));


    $wp_customize->add_setting('hvg_blog_social_twitter', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_twitter', array(
    'type'     => 'url',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'Twitter oldal linkje',
    ));


    $wp_customize->add_setting('hvg_blog_social_pinterest', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_pinterest', array(
    'type'     => 'url',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'Pinterest oldal linkje',
    ));


    $wp_customize->add_setting('hvg_blog_social_youtube', array(
    'capability' => 'edit_theme_options'
    ));

    $wp_customize->add_control('hvg_blog_social_youtube', array(
    'type'     => 'url',
    'priority' => 10,
    'section'  => 'hvg_blog_socials',
    'label'    => 'YouTube oldal linkje',
    ));



    $wp_customize->add_section('hvg_blog_general_settings', array(
    'title'      => 'Blog általános beállítások',
    'priority'   => 23,
    ));

    $wp_customize->add_setting('site_width', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'hvg_blog_sanitize_number_absint',
    'default' => 1150,
    ));

    $wp_customize->add_control(new WP_Customize_Range_Control($wp_customize, 'site_width', array(
      'label'       => 'Kontent szélessége',
      'section'     => 'hvg_blog_general_settings',
      'settings'    => 'site_width',
      'description' => 'Alapértelmezett esetben a kontent szélessége 1280px. A minimum 800px, a maximum pedig 1500px szélesség.',
      'input_attrs' => array(
          'min' => 800,
          'max' => 1511,
          'step' => 10
      ),
    )));

    $wp_customize->add_setting('background_color', array(
    'default'     => '#e4e4e4',
    'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'background_color', array(
    'label'        => 'Oldal háttérszín',
    'section'    => 'hvg_blog_general_settings',
    'settings'   => 'background_color',
    )));

    $wp_customize->add_setting(
        'body_background_image',
        array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'body_background_image',
        array(
        'label' => __('Oldal háttérkép'),
        'section' => 'hvg_blog_general_settings',
        'button_labels' => array( // Optional.
          'select' => __('Select Image'),
          'change' => __('Change Image'),
          'remove' => __('Remove'),
          'default' => __('Default'),
          'placeholder' => __('No image selected'),
          'frame_title' => __('Select Image'),
          'frame_button' => __('Choose Image'),
        )
        )
    ));

    $wp_customize->add_setting('background_image_opacity', array(
    'transport'   => 'refresh',
    'default' => 1,
    ));

    $wp_customize->add_control(new WP_Customize_Range_Control($wp_customize, 'background_image_opacity', array(
    'label'       => 'Háttérkép átlátszósága',
    'section'     => 'hvg_blog_general_settings',
    'settings'    => 'background_image_opacity',
    'description' => '1: nem átlátszó | 0: teljesen átlátszó',
    'input_attrs' => array(
        'min' => 0,
        'max' => 1,
        'step' => 0.1
    ),
    )));

    $wp_customize->add_setting(
        'hvg_blog_default_image',
        array(
        'default' => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw'
        )
    );

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'hvg_blog_default_image',
        array(
        'label' => 'Alapértelmezett kép',
        'description' => 'Tölts fel egy képet, ami megjelenik azokon a helyeken, ahol nincs feltöltve a bejegyzéshez kép (ilyenek pl a listák, a widget ajánlók, stb).',
        'section' => 'hvg_blog_general_settings',
        'button_labels' => array( // Optional.
          'select' => __('Select Image'),
          'change' => __('Change Image'),
          'remove' => __('Remove'),
          'default' => __('Default'),
          'placeholder' => __('No image selected'),
          'frame_title' => __('Select Image'),
          'frame_button' => __('Choose Image'),
        )
        )
    ));

    $wp_customize->add_setting('content_background_color', array(
    'default'     => '#ffffff',
    'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'content_background_color', array(
    'label'        => 'Kontent háttérszín',
    'section'    => 'hvg_blog_general_settings',
    'settings'   => 'content_background_color',
    )));

    $wp_customize->add_setting(
        'site_content_boxed',
        array(
        'default' => true,
        'transport' => 'refresh',
        //'sanitize_callback' => 'hvg_blog_sanitize_checkbox',
        'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control(
        'site_content_boxed',
        array(
        'label' => 'Kontent doboz eltartás és árnyék bekapcsolása',
        'section'  => 'hvg_blog_general_settings',
        'type'=> 'checkbox'
        )
    );

  /*
  * home random posts
  */
    $wp_customize->add_section('hvg_blog_random_post_slider', array(
    'title'      => 'Random bejegyzés ajánló a nyitólapra',
    'priority'   => 24,
    ));

    $wp_customize->add_setting(
        'home_slider_toggle',
        array(
        'default' => false,
        'transport' => 'refresh',
        //'sanitize_callback' => 'hvg_blog_sanitize_checkbox',
        'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control(
        'home_slider_toggle',
        array(
        'label' => 'Véletlenszerű bejegyzés ajánló bekapcsolása',
        'section'  => 'hvg_blog_random_post_slider',
        'type'=> 'checkbox'
        )
    );

    $wp_customize->add_setting(
        'home_slider_type',
        array(
        'default' => 'slider',
        'transport' => 'refresh',
        //'sanitize_callback' => 'hvg_blog_sanitize_checkbox',
        'capability'     => 'edit_theme_options'
        )
    );

    $wp_customize->add_control(
        'home_slider_type',
        array(
        'label' => 'Ajánló típusa',
        'section'  => 'hvg_blog_random_post_slider',
        'type'=> 'radio',
            'choices'  => array(
                'slider'    => 'Slider',
                'row'   => 'Több megjelenítése egymás mellett (maximum 3)',
                'grid'   => 'Grid megjelenítés (maximum 4)',
            )
        )
    );

    $wp_customize->add_setting('home_slider_number', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'hvg_blog_sanitize_number_absint',
    'default' => 4,
    ));


    $wp_customize->add_control(new WP_Customize_Range_Control($wp_customize, 'home_slider_number', array(
    'label'       => 'Megjelenő bejegyzések száma',
    'description' => 'Alapértelmezett: 4. Bizonyos nézetben nem jelenik meg az összes (lásd Ajánló típusa)',
    'section'     => 'hvg_blog_random_post_slider',
    'settings'    => 'home_slider_number',
    'input_attrs' => array(
        'min' => 1,
        'max' => 8,
        'step' => 1
    ),
    )));

  // google fonts
    $wp_customize->add_section('hvg_blog_google_fonts_section', array(
    'title'       => __('Tipográfia', 'hvg'),
    'priority'       => 24,
    ));

    $font_choices = array(
    '' => 'Válassz betűtípust',
    'Source Sans Pro:400,700,400italic,700italic' => 'Source Sans Pro',
        'Open Sans:300italic,600italic,300,400,600' => 'Open Sans',
        'Abril Fatface:400italic,700italic,400,700' => 'Abril Fatface',
    'Oswald:400,700' => 'Oswald',
    'Playfair Display:400,700,400italic' => 'Playfair Display',
    'Montserrat:400,700' => 'Montserrat',
    'Raleway:400,700' => 'Raleway',
    'Droid Sans:400,700' => 'Droid Sans',
    'Lato:400,700,400italic,700italic' => 'Lato',
    'Arvo:400,700,400italic,700italic' => 'Arvo',
    'Lora:400,700,400italic,700italic' => 'Lora',
    'Merriweather:400,300italic,300,400italic,700,700italic' => 'Merriweather',
    'Oxygen:400,300,700' => 'Oxygen',
    'PT Serif:400,700' => 'PT Serif',
    'PT Sans:400,700,400italic,700italic' => 'PT Sans',
    'PT Sans Narrow:400,700' => 'PT Sans Narrow',
    'Cabin:400,700,400italic' => 'Cabin',
    'Fjalla One:400' => 'Fjalla One',
    'Francois One:400' => 'Francois One',
    'Josefin Sans:400,300,600,700' => 'Josefin Sans',
    'Libre Baskerville:400,400italic,700' => 'Libre Baskerville',
    'Arimo:400,700,400italic,700italic' => 'Arimo',
    'Ubuntu:400,700,400italic,700italic' => 'Ubuntu',
    'Bitter:400,700,400italic' => 'Bitter',
    'Droid Serif:400,700,400italic,700italic' => 'Droid Serif',
    'Roboto:400,400italic,700,700italic' => 'Roboto',
    'Open Sans Condensed:700,300italic,300' => 'Open Sans Condensed',
    'Roboto Condensed:400italic,700italic,400,700' => 'Roboto Condensed',
    'Roboto Slab:400,700' => 'Roboto Slab',
    'Yanone Kaffeesatz:400,700' => 'Yanone Kaffeesatz',
    'Rokkitt:400' => 'Rokkitt',
    );

    $wp_customize->add_setting('hvg_blog_headings_fonts', array(
      'sanitize_callback' => 'hvg_blog_sanitize_fonts',
    ));

    $wp_customize->add_control('hvg_blog_headings_fonts', array(
      'type' => 'select',
      'description' => __('Válaszd ki a címsorok betűtípusát', 'hvg'),
      'section' => 'hvg_blog_google_fonts_section',
      'choices' => $font_choices
    ));

    $wp_customize->add_setting('hvg_blog_body_fonts', array(
      'sanitize_callback' => 'hvg_blog_sanitize_fonts'
    ));

    $wp_customize->add_control('hvg_blog_body_fonts', array(
      'type' => 'select',
      'description' => __('Válaszd ki a törzsszövegel betűtípusát', 'hvg'),
      'section' => 'hvg_blog_google_fonts_section',
      'choices' => $font_choices
    ));

    $wp_customize->add_setting('body_color', array(
    'default'     => '#454545',
    'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'body_color', array(
    'label'        => 'Törzsszövegek betűszíne',
    'section'    => 'hvg_blog_google_fonts_section',
    'settings'   => 'body_color',
    )));


    $wp_customize->add_setting('heading_color', array(
    'default'     => '#e25900',
    'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'heading_color', array(
    'label'        => 'Címsorok betűszíne',
    'section'    => 'hvg_blog_google_fonts_section',
    'settings'   => 'heading_color',
    )));


    $wp_customize->add_setting('link_color', array(
    'default'     => '#e25900',
    'transport'   => 'refresh',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'link_color', array(
    'label'        => 'Linkek betűszíne',
    'section'    => 'hvg_blog_google_fonts_section',
    'settings'   => 'link_color',
    )));

    $wp_customize->add_setting('base_font_size', array(
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'hvg_blog_sanitize_number_absint',
    'default' => 16,
    ));

    $wp_customize->add_control(new WP_Customize_Range_Control($wp_customize, 'base_font_size', array(
    'label'       => 'Törzsszöveg betűméret',
    'description' => 'Alapértelmezett: 16px. Minimum: 10px, maximum: 22px. A címsorok betűmérete növekedik a törzsszöveg betűméretének növelésével.',
    'section'     => 'hvg_blog_google_fonts_section',
    'settings'    => 'base_font_size',
    'input_attrs' => array(
      'min'   => 10,
      'max'   => 22,
      'step'  => 1,
    ),
    )));

    //checkbox sanitization function
    function hvg_blog_sanitize_checkbox($input)
    {
        //returns true if checkbox is checked
        return ( isset($input) ? true : false );
    }


    function hvg_blog_sanitize_number_absint($number, $setting)
    {
        $number = absint($number);
        return ( $number ? $number : $setting->default );
    }
}

add_action('wp_head', 'hvg_blog_customizer_css');
function hvg_blog_customizer_css()
{

    ?>
         <style type="text/css">
            :root {
              --base-font-color: <?php echo get_theme_mod('body_color', '#000000'); ?>; ;
              --base-heading-font-color: <?php echo get_theme_mod('heading_color', '#ff4400'); ?>;
              --base-heading-font-family: <?php echo get_theme_mod('hvg_blog_headings_fonts', ''); ?>;
              --base-primary-color: <?php echo get_theme_mod('--base-primary-color', '#ff4400'); ?>;
              --base-link-color: <?php echo get_theme_mod('link_color', '#ff4400'); ?>;
            }
             body {
               background: #<?php echo get_theme_mod('background_color', '#ffffff'); ?>;
               font-size:  <?php echo get_theme_mod('base_font_size', '16'); ?>px;
              }
            .body-background-image {

            }
             body, button, input, select, textarea, p, ul li, ol li  {color: <?php echo get_theme_mod('body_color', '#000000'); ?>; }
             h1, h2, h3, h4, h5, h6, .h1, .site-title, .site-title a {color: <?php echo get_theme_mod('heading_color', '#ff4400'); ?>; }
             a, a:hover, a:visited, a:focus{color: <?php echo get_theme_mod('link_color', '#ff4400'); ?>; }

             .site-wrapper {
                background: <?php echo get_theme_mod('content_background_color', '#ffffff'); ?>;
             }
             .container {
               max-width: <?php echo get_theme_mod('site_width', '1280'); ?>px;
             }
         </style>
    <?php
}
