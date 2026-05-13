<?php
$page_title       = 'Our Work';
$page_description = 'Selected animation, healthcare, and production projects from IronSpark Studios.';
require_once 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow" data-reveal>Portfolio</span>
      <h1 class="page-hero__hl" data-reveal>
        Selected<br><em>Projects.</em>
      </h1>
      <p class="page-hero__sub" data-reveal>
        A cross-section of our work across entertainment and healthcare.
        Each project starts with a story problem. This is how we solve them.
      </p>
    </div>
  </div>
</section>

<!-- FILTER -->
<div class="work-filter-bar">
  <div class="container">
    <div class="work-filter" role="group" aria-label="Filter by category">
      <button class="wf-btn is-active" data-filter="all">All</button>
      <button class="wf-btn" data-filter="entertainment">Entertainment</button>
      <button class="wf-btn" data-filter="healthcare">Healthcare</button>
      <button class="wf-btn" data-filter="production">Production</button>
    </div>
  </div>
</div>

<!-- WORK TABLE -->
<section class="section section--bt">
  <div class="container">
    <div class="work-table">

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="entertainment" data-preview="">
        <span class="work-row__id">IS&mdash;001</span>
        <span class="work-row__title">The Ember Series</span>
        <span class="work-row__tags">Entertainment &mdash; Original IP &mdash; 2D Animation</span>
        <span class="work-row__year">2024</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="healthcare" data-preview="">
        <span class="work-row__id">IS&mdash;002</span>
        <span class="work-row__title">Lifeline Patient Portal</span>
        <span class="work-row__tags">Healthcare &mdash; Motion Design &mdash; Patient Education</span>
        <span class="work-row__year">2024</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="entertainment" data-preview="">
        <span class="work-row__id">IS&mdash;003</span>
        <span class="work-row__title">Wonderforge</span>
        <span class="work-row__tags">Entertainment &mdash; Visual Development &mdash; Series Concept</span>
        <span class="work-row__year">2023</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="healthcare" data-preview="">
        <span class="work-row__id">IS&mdash;004</span>
        <span class="work-row__title">ClearPath</span>
        <span class="work-row__tags">Healthcare &mdash; Behavior Change &mdash; Script &amp; Animation</span>
        <span class="work-row__year">2023</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="production" data-preview="">
        <span class="work-row__id">IS&mdash;005</span>
        <span class="work-row__title">Kinetic Brand Rebrand</span>
        <span class="work-row__tags">Production &mdash; Brand Film &mdash; Motion System</span>
        <span class="work-row__year">2023</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="entertainment" data-preview="">
        <span class="work-row__id">IS&mdash;006</span>
        <span class="work-row__title">Hollow &amp; the Haunt</span>
        <span class="work-row__tags">Entertainment &mdash; Short Film &mdash; Character Animation</span>
        <span class="work-row__year">2022</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="healthcare" data-preview="">
        <span class="work-row__id">IS&mdash;007</span>
        <span class="work-row__title">PediatricPath</span>
        <span class="work-row__tags">Healthcare &mdash; Pediatric Education &mdash; 2D</span>
        <span class="work-row__year">2022</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="production" data-preview="">
        <span class="work-row__id">IS&mdash;008</span>
        <span class="work-row__title">Roots &amp; Routes</span>
        <span class="work-row__tags">Production &mdash; Documentary Motion &mdash; Title Design</span>
        <span class="work-row__year">2022</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="entertainment" data-preview="">
        <span class="work-row__id">IS&mdash;009</span>
        <span class="work-row__title">Neon Valley</span>
        <span class="work-row__tags">Entertainment &mdash; Original IP &mdash; Pilot</span>
        <span class="work-row__year">2021</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

      <a href="/portfolio/professional-works/IronSpark/work.php" class="work-row" data-cat="healthcare" data-preview="">
        <span class="work-row__id">IS&mdash;010</span>
        <span class="work-row__title">Meridian Health Network</span>
        <span class="work-row__tags">Healthcare &mdash; Institutional Brand &mdash; Motion</span>
        <span class="work-row__year">2021</span>
        <span class="work-row__arrow">&#8599;</span>
      </a>

    </div>
  </div>
</section>

<!-- floating preview -->
<div class="work-preview" id="workPreview" aria-hidden="true">
  <img src="" alt="" id="workPreviewImg">
</div>

<!-- CLOSING CTA -->
<section class="cta-full">
  <div class="container">
    <div class="cta-full__inner" data-reveal>
      <h2 class="cta-full__hl">
        See your<br><em>project</em><br>here.
      </h2>
      <div style="display:flex;flex-direction:column;gap:1.5rem;align-items:flex-start">
        <p style="font-size:1rem;line-height:1.75;color:var(--muted-2);max-width:38ch">
          We work with a carefully chosen set of clients each year. Reach out and let's see if we're the right fit.
        </p>
        <a href="/portfolio/professional-works/IronSpark/contact.php" class="btn btn--spark btn--lg">
          Start a Project
          <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
        </a>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
