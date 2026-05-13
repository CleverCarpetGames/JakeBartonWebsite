<?php
$pageTitle = 'Animation &amp; Media Studio';
$pageDesc  = 'IronSpark Studios — Birmingham, AL animation and media studio. Original IP, entertainment content, and healthcare media.';
$bodyClass = 'home-page has-hero';
require_once 'includes/header.php';

$entVideo = '/portfolio/professional-works/IronSpark/Assets/' . rawurlencode('Gaming Stock Footage Medium shot of young men beta testing video game  4K  HD - Royalty Free Music Video & Template (1080p, h264, youtube).mp4');
$hcVideo  = '/portfolio/professional-works/IronSpark/Assets/' . rawurlencode('4K Hospital Notes  Clipboard  Sick  Patient  Free Stock Video Footage [ No Copyright ] - HD Video Library - No Copyright Footage (1080p, h264, youtube).mp4');
?>

<!-- HERO -->
<section class="hero" id="hero" data-cursor-theme="light">
  <!-- Background: Birmingham drone footage — perspective camera -->
  <div class="hero__bg" aria-hidden="true">
    <div class="hero__bg-scene" id="heroBgScene">
      <video class="hero__bg-video" id="heroBgVideo"
             src="/portfolio/professional-works/IronSpark/Assets/hero-bg-scrub.mp4"
             muted playsinline preload="auto"></video>
    </div>
    <div class="hero__bg-overlay"></div>
  </div>

  <!-- Centre: orange logo with clip-path wipe animation -->
  <div class="hero__center">
    <div class="hero__logo-mask" id="heroLogoMask" aria-label="IronSpark Studios">
      <div class="hero__logo-orange"></div>
    </div>
    <div class="hero__sub">
      <span class="hero__sub-inner">Animation &amp; Media Studio</span>
      <span class="hero__sub-sep" aria-hidden="true">—</span>
      <span class="hero__sub-inner">Birmingham, AL</span>
      <span class="hero__sub-sep" aria-hidden="true">—</span>
      <span class="hero__sub-inner">Est. 2020</span>
    </div>
  </div>

  <div class="hero__footer">
    <a href="/portfolio/professional-works/IronSpark/work.php" class="hero__view-work">
      <span>View Our Work</span>
      <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
    </a>
  </div>
</section>

<!-- DIVISIONS -->
<section class="divisions" id="divisions" aria-label="Our Divisions" data-cursor-theme="dark">

  <div class="divisions__header">
    <span class="eyebrow">What We Do</span>
    <h2 class="divisions__title">Our Divisions</h2>
  </div>

  <div class="divisions__cards">

    <a class="division division--ent" href="/portfolio/professional-works/IronSpark/services.php#entertainment" data-cursor-theme="light">
      <div class="division__media">
        <img class="division__img" src="/portfolio/professional-works/IronSpark/Assets/rs=w-776,h-388,cg-true-3.webp" alt="Entertainment production" draggable="false">
        <video class="division__video" src="<?= $entVideo ?>" muted loop playsinline preload="none"></video>
      </div>
      <div class="division__overlay"></div>
      <div class="division__inner">
        <div class="division__label-wrap">
          <h2 class="division__label">Entertainment</h2>
        </div>
        <p class="division__tags">Animation · Original IP · Visual Dev</p>
      </div>
      <span class="division__cta">Explore
        <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
      </span>
    </a>

    <a class="division division--hc" href="/portfolio/professional-works/IronSpark/services.php#healthcare" data-cursor-theme="light">
      <div class="division__media">
        <img class="division__img" src="/portfolio/professional-works/IronSpark/Assets/rs=w-776,h-388,cg-true-2.webp" alt="Healthcare animation" draggable="false">
        <video class="division__video" src="<?= $hcVideo ?>" muted loop playsinline preload="none"></video>
      </div>
      <div class="division__overlay"></div>
      <div class="division__inner">
        <div class="division__label-wrap">
          <h2 class="division__label">Healthcare</h2>
        </div>
        <p class="division__tags">Patient Ed · Behavior Change · Motion</p>
      </div>
      <span class="division__cta">Explore
        <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
      </span>
    </a>

  </div>
</section>

<!-- TICKER -->
<!-- STATIC ORANGE DIVIDER BAR -->
<div class="orange-bar" aria-hidden="true" data-cursor-theme="on-orange">
  <span>Animation</span><span class="orange-bar__dot">✦</span>
  <span>Original IP</span><span class="orange-bar__dot">✦</span>
  <span>Visual Development</span><span class="orange-bar__dot">✦</span>
  <span>Healthcare Media</span><span class="orange-bar__dot">✦</span>
  <span>Motion Design</span><span class="orange-bar__dot">✦</span>
  <span>Birmingham, AL</span>
</div>

<!-- MANIFESTO + CTA (merged) -->
<section class="manifesto-cta" id="manifesto" aria-label="Our philosophy and contact" data-cursor-theme="light">
  <div class="container">
    <div class="manifesto-cta__inner">
      <div class="manifesto-cta__text-col">
        <p class="manifesto__text" id="manifestoText">We build stories that connect, educate, and entertain.</p>
        <a href="/portfolio/professional-works/IronSpark/about.php" class="manifesto__link">
          Our Story
          <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
        </a>
      </div>
      <div class="manifesto-cta__action">
        <a href="/portfolio/professional-works/IronSpark/contact.php" class="btn btn--orange btn--lg" data-cursor-theme="on-orange">
          Start a Project
          <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
        </a>
        <p class="cta-block__note">Whether it's a series, a health campaign,<br>or something without a name yet.</p>
      </div>
    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
