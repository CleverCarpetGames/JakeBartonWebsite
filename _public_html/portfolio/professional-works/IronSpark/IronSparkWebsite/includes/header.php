<?php
$current = basename($_SERVER['PHP_SELF'], '.php');
require_once __DIR__ . '/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle).' — '.SITE_NAME : SITE_NAME.' — Animation &amp; Media Studio' ?></title>
  <meta name="description" content="<?= isset($pageDesc) ? htmlspecialchars($pageDesc) : SITE_DESCRIPTION ?>">
  <link rel="canonical" href="<?= SITE_URL . '/' . ($current === 'index' ? '' : $current.'.php') ?>">
  <!-- OG -->
  <meta property="og:title" content="<?= isset($pageTitle) ? htmlspecialchars($pageTitle).' — '.SITE_NAME : SITE_NAME ?>">
  <meta property="og:description" content="<?= isset($pageDesc) ? htmlspecialchars($pageDesc) : SITE_DESCRIPTION ?>">
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= SITE_URL ?>">
  <!-- Kill white flash: dark bg before any stylesheet loads -->
  <style>html,body{background:#1d1d1d;}</style>
  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
  <!-- GSAP — defer so they don't block HTML parsing; executes in order before main.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js" defer></script>
  <!-- Styles -->
  <link rel="stylesheet" href="/portfolio/professional-works/IronSpark/css/style.css">
</head>
<body<?= isset($bodyClass) ? ' class="'.htmlspecialchars($bodyClass).'"' : '' ?>>

<!-- Main script — lives outside #page so it never gets re-executed on DOM swap -->
<script src="/portfolio/professional-works/IronSpark/js/main.js" defer></script>

<!-- Page transition curtain -->
<div id="curtain" aria-hidden="true">
  <div id="curtain__inner" style="transform:translateY(0)"></div>
</div>

<!-- Cursor -->
<div id="cursorDot" aria-hidden="true"></div>
<div id="cursorRing" aria-hidden="true"></div>

<!-- Nav -->
<nav class="nav" id="mainNav" aria-label="Main navigation"
     data-cursor-theme="<?= (isset($bodyClass) && str_contains($bodyClass, 'has-hero')) ? 'light' : 'dark' ?>">
  <a href="/" class="nav__logo" aria-label="IronSpark Studios — Home">
    <img src="/portfolio/professional-works/IronSpark/Assets/IronsparkLogo.webp" alt="IronSpark Studios logo" width="120" height="26">
  </a>

  <ul class="nav__links" role="list">
    <li><a href="/portfolio/professional-works/IronSpark/about.php"    <?= $current==='about'    ? 'aria-current="page"' : '' ?>>About</a></li>
    <li><a href="/portfolio/professional-works/IronSpark/services.php" <?= $current==='services' ? 'aria-current="page"' : '' ?>>Services</a></li>
    <li><a href="/portfolio/professional-works/IronSpark/contact.php"  <?= $current==='contact'  ? 'aria-current="page"' : '' ?>>Contact</a></li>
  </ul>

  <div class="nav__cta">
    <a href="/portfolio/professional-works/IronSpark/contact.php" class="btn btn--spark">
      <span>Start a Project</span>
      <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
    </a>
  </div>

  <!-- Hamburger — mobile only -->
  <button class="nav__burger" aria-label="Open navigation" aria-expanded="false" aria-controls="mobileMenu">
    <span></span><span></span><span></span>
  </button>
</nav>

<!-- Mobile full-screen menu (outside nav so it covers entire viewport) -->
<div class="nav__mobile" id="mobileMenu" aria-hidden="true" role="dialog" aria-label="Navigation">
  <ul class="nav__mobile-links" role="list">
    <li><a href="/portfolio/professional-works/IronSpark/about.php"    <?= $current==='about'    ? 'aria-current="page"' : '' ?>>About</a></li>
    <li><a href="/portfolio/professional-works/IronSpark/services.php" <?= $current==='services' ? 'aria-current="page"' : '' ?>>Services</a></li>
    <li><a href="/portfolio/professional-works/IronSpark/contact.php"  <?= $current==='contact'  ? 'aria-current="page"' : '' ?>>Contact</a></li>
  </ul>
  <div class="nav__mobile-footer">
    <a href="/portfolio/professional-works/IronSpark/contact.php" class="btn btn--orange btn--lg">
      <span>Start a Project</span>
      <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
    </a>
    <p class="nav__mobile-note">Birmingham, AL · Since 2021</p>
  </div>
</div>

<main id="page">