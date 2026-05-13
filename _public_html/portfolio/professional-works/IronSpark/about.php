<?php
$page_title       = 'About';
$page_description = 'IronSpark Studios is a Birmingham-based animation and media studio working at the intersection of entertainment and healthcare.';
require_once 'includes/header.php';
?>

<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow" data-reveal>The Studio</span>
      <h1 class="page-hero__hl" data-reveal>We build<br><em>stories</em><br>with purpose.</h1>
      <p class="page-hero__sub" data-reveal>Birmingham, Alabama &mdash; Est. 2020</p>
    </div>
  </div>
</section>

<section class="section about-grid">
  <div class="container">
    <div class="about-grid__inner">
      <div class="about-grid__left" data-reveal>
        <span class="eyebrow">Our Story</span>
        <h2 class="about-grid__hl">Born from a belief that&nbsp;great animation&nbsp;changes things.</h2>
        <p class="about-grid__body">IronSpark Studios was founded in 2020 with a single conviction: the world needed more intentional, human-centered storytelling. We weren't interested in production-line content. We wanted to build studios — real creative engines with real points of view.</p>
        <p class="about-grid__body">Over four years, we've grown into a lean, deliberate team operating at the intersection of two disciplines: entertainment and healthcare. Different industries, but the same core belief — that animated stories move people, and moving people matters.</p>
      </div>
      <div class="about-grid__right" data-reveal>
        <div class="about-grid__img-wrap">
          <div class="about-grid__img-placeholder" aria-hidden="true"><span>IronSpark Team</span></div>
        </div>
        <div class="about-grid__values">
          <div class="about-grid__value">
            <span class="about-grid__value-num">01</span>
            <div><h4>Human First</h4><p>Every frame we create has a real person on the other end. We don't forget that.</p></div>
          </div>
          <div class="about-grid__value">
            <span class="about-grid__value-num">02</span>
            <div><h4>Craft Over Speed</h4><p>We'd rather take the time to do it right than move fast and miss.</p></div>
          </div>
          <div class="about-grid__value">
            <span class="about-grid__value-num">03</span>
            <div><h4>Story as Strategy</h4><p>Great narrative isn't decoration — it's the most powerful tool we have.</p></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--bt stats-section">
  <div class="container">
    <div class="stat-grid">
      <div class="stat-item" data-reveal>
        <div class="stat-item__num"><span class="stat-counter" data-count="4">0</span>+</div>
        <p class="stat-item__label">Years in production</p>
      </div>
      <div class="stat-item" data-reveal>
        <div class="stat-item__num"><span class="stat-counter" data-count="30">0</span>+</div>
        <p class="stat-item__label">Projects completed</p>
      </div>
      <div class="stat-item" data-reveal>
        <div class="stat-item__num"><span class="stat-counter" data-count="2">0</span></div>
        <p class="stat-item__label">Divisions: entertainment &amp; healthcare</p>
      </div>
    </div>
  </div>
</section>

<section class="section disciplines">
  <div class="container">
    <span class="eyebrow" data-reveal style="display:block;margin-bottom:2rem">What drives us</span>
    <div class="disciplines__grid">
      <div class="discipline-block" data-reveal>
        <span class="discipline-block__num" aria-hidden="true">ENT</span>
        <h3>Entertainment</h3>
        <p>We develop original animated content for kids and families — series concepts, character worlds, and narrative formats built to last.</p>
        <a href="/services.php#entertainment" class="discipline-block__link">Explore Entertainment &rarr;</a>
      </div>
      <div class="discipline-block" data-reveal>
        <span class="discipline-block__num" aria-hidden="true">HLT</span>
        <h3>Healthcare</h3>
        <p>We translate clinical realities into animated stories that help patients understand complex conditions, treatments, and behavioral shifts.</p>
        <a href="/services.php#healthcare" class="discipline-block__link">Explore Healthcare &rarr;</a>
      </div>
    </div>
  </div>
</section>

<section class="cta-full">
  <div class="container">
    <div class="cta-full__inner" data-reveal>
      <h2 class="cta-full__hl">Ready to<br><em>work</em><br>together?</h2>
      <div style="display:flex;flex-direction:column;gap:1.5rem;align-items:flex-start">
        <p style="font-size:1rem;line-height:1.75;color:var(--muted-2);max-width:40ch">We take a limited number of new projects each year. If you have something worth building, let's talk about it.</p>
        <a href="/contact.php" class="btn btn--spark btn--lg">Get in Touch <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg></a>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
