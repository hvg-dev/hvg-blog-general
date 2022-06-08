<?php the_title('<h1 class="entry-title h1 page-title adult-warning__title">', '</h1>'); ?>
<div id="adultWarning" class="adult-warning">
  <div class="row">
    <div class="col-md-3">
      <div class="adult-warning__icon">
        <div class="circle circle_start"></div>
        <div class="circle circle_end"></div>
        <span class="adult-warning__icon--number">18</span>
        <span class="adult-warning__icon--plus">+</span>
      </div>
    </div>
    <div class="col-md-9">
      <p>
        <strong>Figyelem!</strong> Az ön által letölteni kívánt tartalom olyan elemeket tartalmaz, amelyek Mttv. által rögzített
        besorolás szerinti V. vagy VI. kategóriába tartoznak, és a kiskorúakra káros hatással lehetnek. Ha szeretné,
        hogy az ilyen tartalmakhoz kiskorú ne férhessen hozzá, használjon <a href=" http://mte.hu/gyermekbarat-internet/" target="_blank">szűrőprogramot</a>.
      </p>
      <div class="adult-warning__buttons">
        <button class="btn btn__over">Elmúltam 18 éves</button>
        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn__under">Még nem múltam el 18 éves</a>
      </div>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const adultWarningConsent = localStorage.getItem(pageURL+'_adult-consent');
  const body = document.body;
  const adultWarning = document.getElementById('adultWarning');
  const buttonOver = adultWarning.querySelector('.btn__over');

  buttonOver.addEventListener('click', function () {
    localStorage.setItem(pageURL+'_adult-consent', true);
    body.classList.remove('post-adult-warning');
  });

  if (adultWarningConsent && adultWarningConsent === 'true') {
    body.classList.remove('post-adult-warning');
  }
});
</script>
