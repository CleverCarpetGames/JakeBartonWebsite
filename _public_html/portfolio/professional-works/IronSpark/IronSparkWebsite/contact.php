<?php
$pageTitle = 'Contact';
$pageDesc  = 'Get in touch with IronSpark Studios. We\'d love to hear about your project.';
$bodyClass = 'inner-page';
require_once 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero" data-cursor-theme="dark">
  <div class="container">
    <span class="eyebrow js-reveal">Get In Touch</span>
    <h1 class="page-hero__hl js-reveal">Drop us<br><em>a line.</em></h1>
    <p class="page-hero__sub js-reveal">We're a small studio — we actually read these.</p>
  </div>
</section>

<!-- CONTACT FORM + INFO -->
<section class="section" data-cursor-theme="dark">
  <div class="container">
    <div class="contact-grid">

      <!-- FORM -->
      <div class="contact-form-wrap js-reveal">
        <?php if (isset($_GET['sent']) && $_GET['sent'] === '1'): ?>
          <div class="form-success">
            <p>&#10003; Message sent — we'll be in touch soon.</p>
          </div>
        <?php else: ?>
        <form class="contact-form" action="/portfolio/professional-works/IronSpark/send-mail.php" method="POST">
          <div class="form-row">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Your name" required>
          </div>
          <div class="form-row">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="your@email.com" required>
          </div>
          <div class="form-row">
            <label for="company">Company / Project <span class="form-optional">(optional)</span></label>
            <input type="text" id="company" name="company" placeholder="Company or project name">
          </div>
          <div class="form-row">
            <label for="division">Division of Interest</label>
            <select id="division" name="division">
              <option value="" disabled selected>Select a division</option>
              <option value="entertainment">Entertainment</option>
              <option value="healthcare">Healthcare</option>
              <option value="both">Both / Not Sure</option>
            </select>
          </div>
          <div class="form-row">
            <label for="message">Message</label>
            <textarea id="message" name="message" rows="5" placeholder="Tell us about your project..." required></textarea>
          </div>
          <button type="submit" class="btn btn--orange btn--lg" data-cursor-theme="on-orange">
            <span>Send Message</span>
            <svg viewBox="0 0 13 13" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M1 12L12 1M12 1H4M12 1v8"/></svg>
          </button>
        </form>
        <?php endif; ?>
      </div>

      <!-- INFO -->
      <div class="contact-info js-reveal">
        <div class="contact-info__block">
          <span class="eyebrow" style="display:block;margin-bottom:.75rem">Location</span>
          <p>Birmingham, Alabama</p>
        </div>
        <div class="contact-info__block">
          <span class="eyebrow" style="display:block;margin-bottom:.75rem">Email</span>
          <a href="mailto:hello@ironsparkstudios.com" class="contact-info__link">hello@ironsparkstudios.com</a>
        </div>
        <div class="contact-info__block">
          <span class="eyebrow" style="display:block;margin-bottom:.75rem">Hours</span>
          <p>Mon – Fri &nbsp; 9am – 5pm CT</p>
          <p style="color:rgba(29,29,29,.45)">Sat – Sun &nbsp; Closed</p>
        </div>
        <div class="contact-info__block">
          <span class="eyebrow" style="display:block;margin-bottom:.75rem">Divisions</span>
          <a href="/portfolio/professional-works/IronSpark/services.php#entertainment" class="contact-info__link">Entertainment ↗</a>
          <a href="/portfolio/professional-works/IronSpark/services.php#healthcare" class="contact-info__link">Healthcare ↗</a>
        </div>
        <div class="contact-info__note">
          <p>We take a limited number of new projects each year. The earlier you reach out, the better.</p>
        </div>
      </div>

    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
