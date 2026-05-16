<?php
// Portfolio coming soon — redirect to Services until real case studies are ready
header('Location: /services.php', true, 301);
exit;
?>

<!-- PAGE HERO -->
<section class="page-hero" data-cursor-theme="dark">
  <div class="container">
    <span class="eyebrow js-reveal">Selected Projects</span>
    <h1 class="page-hero__hl js-reveal">Work that<br>moves<br><em>people.</em></h1>
    <p class="page-hero__sub js-reveal">Entertainment. Healthcare. Always with purpose.</p>
  </div>
</section>

<!-- FEATURED IMAGE -->
<section class="section" style="padding-top:0" data-cursor-theme="dark">
  <div class="container">
    <img loading="lazy" src="/portfolio/professional-works/IronSpark/Assets/rs=w-2320,h-1223.webp"
         alt="IronSpark Studios — Featured Work"
         class="work-hero-img js-reveal">
  </div>
</section>

<!-- WORK INTRO -->
<section class="section" data-cursor-theme="dark">
  <div class="container">
    <div class="intro-grid">
      <div class="js-reveal">
        <h2 class="intro-grid__hl">Two divisions. Dozens of stories.<br>All made with intention.</h2>
        <p class="intro-grid__body">We're a Birmingham-based animation and media studio working across entertainment and healthcare. From original IP to patient education, we design thoughtful, visually engaging experiences that resonate with real people.</p>
        <a href="/portfolio/professional-works/IronSpark/contact.php" class="btn btn--spark" style="margin-top:2rem">
          <span>Start Your Project</span>
          <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
        </a>
      </div>
      <div class="js-reveal">
        <div class="work-stat-grid">
          <div class="work-stat">
            <span class="stat-row__num">30+</span>
            <span class="stat-row__label">Projects Delivered</span>
          </div>
          <div class="work-stat">
            <span class="stat-row__num">4+</span>
            <span class="stat-row__label">Years Active</span>
          </div>
          <div class="work-stat">
            <span class="stat-row__num">2</span>
            <span class="stat-row__label">Divisions</span>
          </div>
          <div class="work-stat">
            <span class="stat-row__num">100%</span>
            <span class="stat-row__label">In-house Production</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ENTERTAINMENT WORK -->
<section class="section" data-cursor-theme="dark">
  <div class="container">
    <div class="section-header js-reveal">
      <span class="eyebrow">Entertainment Division</span>
      <a href="/portfolio/professional-works/IronSpark/services.php#entertainment" class="link-arrow">All Services <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg></a>
    </div>
    <div class="work-grid js-reveal">
      <div class="work-card">
        <div class="work-card__img-wrap">
          <img loading="lazy" src="/portfolio/professional-works/IronSpark/Assets/rs=w-776,h-388,cg-true-3.webp" alt="Entertainment project" class="work-card__img">
          <span class="division-pill division-pill--ent work-card__pill">Entertainment</span>
        </div>
        <div class="work-card__body">
          <h3 class="work-card__title">Animated Series Development</h3>
          <p class="work-card__desc">Original animated content, visual development, and storytelling for kids and families.</p>
        </div>
      </div>
      <div class="work-card">
        <div class="work-card__img-wrap">
          <img loading="lazy" src="/portfolio/professional-works/IronSpark/Assets/rs=w-776,h-388,cg-true-2.webp" alt="Entertainment project" class="work-card__img">
          <span class="division-pill division-pill--ent work-card__pill">Entertainment</span>
        </div>
        <div class="work-card__body">
          <h3 class="work-card__title">Character &amp; World Building</h3>
          <p class="work-card__desc">Deep visual development, IP strategy, and character design for original properties.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- HEALTHCARE WORK -->
<section class="section about-dark" data-cursor-theme="light">
  <div class="container">
    <div class="section-header js-reveal">
      <span class="eyebrow" style="color:rgba(247,242,233,.35)">Healthcare Division</span>
      <a href="/portfolio/professional-works/IronSpark/services.php#healthcare" class="link-arrow" style="color:rgba(247,242,233,.55)">All Services <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg></a>
    </div>
    <div class="work-grid js-reveal">
      <div class="work-card work-card--dark">
        <div class="work-card__img-wrap">
          <img loading="lazy" src="/portfolio/professional-works/IronSpark/Assets/rs=w-776,h-388,cg-true.webp" alt="Healthcare project" class="work-card__img">
          <span class="division-pill division-pill--health work-card__pill">Healthcare</span>
        </div>
        <div class="work-card__body">
          <h3 class="work-card__title" style="color:var(--cream)">Patient Education Content</h3>
          <p class="work-card__desc" style="color:rgba(247,242,233,.55)">Engaging, empathetic animations explaining procedures and improving patient outcomes.</p>
        </div>
      </div>
      <div class="work-card work-card--dark">
        <div class="work-card__img-wrap">
          <img loading="lazy" src="/portfolio/professional-works/IronSpark/Assets/rs=w-800,cg-true.webp" alt="Healthcare project" class="work-card__img">
          <span class="division-pill division-pill--health work-card__pill">Healthcare</span>
        </div>
        <div class="work-card__body">
          <h3 class="work-card__title" style="color:var(--cream)">Behavior-Change Campaigns</h3>
          <p class="work-card__desc" style="color:rgba(247,242,233,.55)">Content designed to shift behaviors — grounded in evidence, built for human beings.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CTA -->
<section class="page-cta" data-cursor-theme="light">
  <div class="container">
    <div class="manifesto-cta__inner js-reveal">
      <div class="manifesto-cta__text-col">
        <h2 class="manifesto__text" style="opacity:1;transform:none">Your story<br><em>belongs here.</em></h2>
        <p class="page-cta__note">We're always looking for projects worth doing. Tell us what you're building.</p>
      </div>
      <div class="manifesto-cta__action" style="opacity:1;transform:none">
        <a href="/portfolio/professional-works/IronSpark/contact.php" class="btn btn--orange btn--lg" data-cursor-theme="on-orange">
          <span>Let's Talk</span>
          <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
        </a>
        <p class="cta-block__note">Mon – Fri, 9am – 5pm CT</p>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
