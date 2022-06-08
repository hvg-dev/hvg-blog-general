<?php

add_action('wp_head', 'hvg_blog_customizer_fonts_css');
function hvg_blog_customizer_fonts_css()
{
    $headings_font = esc_html(get_theme_mod('hvg_blog_headings_fonts'));
    $body_font = esc_html(get_theme_mod('hvg_blog_body_fonts'));
    $custom = '';
    if ($headings_font) {
        $font_pieces = explode(":", $headings_font);

        $custom .= "h1, h2, h3, h4, h5, h6, .site-title, .h1, .site-header .navbar-brand__text-logo h1, .site-header .navbar-brand__text-logo .site-title { font-family: {$font_pieces[0]}; }"."\n";
    }

    if ($body_font) {
        $font_pieces = explode(":", $body_font);

        $custom .= "body, button, input, select, textarea, p, ul li, ol li { font-family: {$font_pieces[0]}; }"."\n";
    }
    ?>
         <style type="text/css">
            <?php echo $custom;?>
         </style>
    <?php
}

//Sanitizes Fonts
function hvg_blog_sanitize_fonts($input)
{
    $valid = array(
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

    if (array_key_exists($input, $valid)) {
        return $input;
    } else {
        return '';
    }
}
