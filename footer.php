</div>
    </main>


    <footer class="site-footer container-fluid">
    <div class="container">
      <div class="row">
        <div class="col-md-12 footer-brand">
          <h2>
            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
            <?php
            if (get_bloginfo('description') <> '') :
                ?>
              <span class="footer-description"> | <?php bloginfo('description'); ?></span>
            <?php endif; ?>
          </h2>
          <p>Ez is egy HVG blog!</p>
        </div>
        <div class="col-md-4 footer-nav">
            <h4>Egyéb kiadványok —</h4>
            <div class="row">
            <div class="col-md-12">
                  <ul class="pages">
                      <li><a href="https://hvg.hu"  target="_blank">HVG</a></li>
                      <li><a href="https://hvg.hu/360/"  target="_blank">HVG360</a></li>
                      <li><a href="https://jobline.hu/"  target="_blank">jobline.hu</a></li>
                      <li><a href="https://adozona.hu/"  target="_blank">adózóna</a></li>
                      <li><a href="https://eduline.hu/"  target="_blank">eduline</a></li>
                      <li><a href="https://hvgkonyvek.hu/"  target="_blank">HVG Könyvek</a></li>
                      <li><a href="https://hvgallasborze.hu/"  target="_blank">HVG Állásbörze</a></li>
                      <li>
                        <a href="https://bolt.hvg.hu" target="_blank">bolt.hvg.hu</a>
                    </li>
                  </ul>
              </div>
          </div>
        </div>
        <div class="col-md-4 footer-social">
            <h4>Kövess minket! —</h4>
            <p>
              <?php hvg_blog_social_links();?>
            </p>
          </div>
        <div class="col-md-4 footer-ns">
                            <h4>Keresés a(z) <strong><?php bloginfo('name');?></strong> oldalon  —</h4>
              <?php hvg_blog_general_search_form();?>
          </div>
      </div>

      <div class="row footer__hvg-content">
        <div class="col-md-12">
          <ul class="list text-center">
            <li>
              <a href="https://portfolio.hvg.hu"  target="_blank">Hirdetési információk</a>
            </li>
            <li>
              <a href="https://hvg.hu/adatvedelem" title="Adatvédelmi tájékoztató"  rel="nofollow">Adatvédelmi tájékoztató</a>
            </li>
            <li>
              <a href="https://hvg.hu/egyeb/cookiekezelesi_tajekoztato" title="Cookie-kezelési tájékoztató" rel="nofollow">Cookie-kezelési tájékoztató</a>
            </li>
            <li>
              <a href="https://hvg.hu/egyeb/impresszum" title="Impresszum">Impresszum</a>
            </li>
          </ul>
        </div>
        <div class="col-md-12 footer-brand text-center">
          <p>HVG Kiadó Zrt. © 2020
            <?php if (date("Y") > 2020) {
                echo ' - '.date("Y");
            } ?>
            </p>
        </div>
      </div>
    </div>

  </footer>


</div>

<?php
  $body_background_image = get_theme_mod('body_background_image');
  $body_background_opacity = get_theme_mod('background_image_opacity');
  echo '<div class="body-background-image" style="background-image: url('.$body_background_image.');background-position: center center;background-size:cover;opacity: '.$body_background_opacity.'"></div>';
?>

<?php wp_footer(); ?>

</body>
</html>
