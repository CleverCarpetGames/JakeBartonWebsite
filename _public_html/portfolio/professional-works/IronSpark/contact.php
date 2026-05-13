<?php
$page_title       = 'Contact';
$page_description = 'Start a project with IronSpark Studios. Tell us about your idea and we\'ll be in touch.';
require_once 'includes/header.php';
?>

<!-- PAGE HERO -->
<section class="page-hero">
  <div class="container">
    <div class="page-hero__inner">
      <span class="eyebrow" data-reveal>Let's Talk</span>
      <h1 class="page-hero__hl" data-reveal>
        Tell us<br><em>everything.</em>
      </h1>
      <p class="page-hero__sub" data-reveal>
        We take on a limited number of new projects each year. If it sounds
        like a fit, we'll reach back out within 48 hours.
      </p>
    </div>
  </div>
</section>

<!-- CONTACT GRID -->
<section class="section contact-grid">
  <div class="container">
    <div class="contact-grid__inner">

      <!-- LEFT: INFO -->
      <div class="contact-info" data-reveal>
        <div class="contact-info__item">
          <span class="eyebrow">Email</span>
          <a href="mailto:hello@ironspark.studio">hello@ironspark.studio</a>
        </div>
        <div class="contact-info__item">
          <span class="eyebrow">Location</span>
          <p>Birmingham, Alabama<br>Available worldwide</p>
        </div>
        <div class="contact-info__item">
          <span class="eyebrow">Availability</span>
          <p class="avail-line">
            <span class="avail-dot"></span>
            Currently accepting new projects
          </p>
        </div>
        <div class="contact-info__item">
          <span class="eyebrow">Follow</span>
          <div class="contact-social">
            <a href="https://instagram.com" target="_blank" rel="noopener">Instagram</a>
            <a href="https://linkedin.com" target="_blank" rel="noopener">LinkedIn</a>
            <a href="https://vimeo.com" target="_blank" rel="noopener">Vimeo</a>
          </div>
        </div>
      </div>

      <!-- RIGHT: FORM -->
      <div class="contact-form-wrap" data-reveal>
        <form id="contact-form" class="contact-form" novalidate>

          <!-- honeypot -->
          <div style="display:none" aria-hidden="true">
            <input type="text" name="website" tabindex="-1" autocomplete="off">
          </div>

          <div class="form-row form-row--half">
            <div class="form-group">
              <label for="cf-name">Your Name *</label>
              <input type="text" id="cf-name" name="name" required placeholder="Jane Doe">
            </div>
            <div class="form-group">
              <label for="cf-email">Email Address *</label>
              <input type="email" id="cf-email" name="email" required placeholder="jane@company.com">
            </div>
          </div>

          <div class="form-row form-row--half">
            <div class="form-group">
              <label for="cf-company">Company / Organization</label>
              <input type="text" id="cf-company" name="company" placeholder="Acme Inc.">
            </div>
            <div class="form-group">
              <label for="cf-division">Division of Interest *</label>
              <select id="cf-division" name="division" required>
                <option value="" disabled selected>Select one…</option>
                <option value="Entertainment">Entertainment</option>
                <option value="Healthcare">Healthcare</option>
                <option value="Production">General Production</option>
                <option value="Other">Other / Not sure yet</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="cf-budget">Approximate Budget</label>
              <select id="cf-budget" name="budget">
                <option value="" disabled selected>Select a range…</option>
                <option value="Under $10k">Under $10,000</option>
                <option value="$10k–$25k">$10,000 – $25,000</option>
                <option value="$25k–$50k">$25,000 – $50,000</option>
                <option value="$50k–$100k">$50,000 – $100,000</option>
                <option value="$100k+">$100,000+</option>
                <option value="Not sure">Not sure yet</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group">
              <label for="cf-message">Tell us about your project *</label>
              <textarea id="cf-message" name="message" required rows="6"
                placeholder="Give us the full picture — what you're building, who it's for, and why it matters."></textarea>
            </div>
          </div>

          <div class="form-row">
            <button type="submit" class="btn btn--spark btn--lg form-submit">
              <span class="form-submit__text">Send Message</span>
              <span class="form-submit__loading" aria-hidden="true">Sending…</span>
              <svg viewBox="0 0 24 24"><line x1="5" y1="12" x2="19" y2="12"/><polyline points="12 5 19 12 12 19"/></svg>
            </button>
          </div>

        </form>

        <div id="form-status" class="form-status" role="alert" aria-live="polite"></div>
      </div>

    </div>
  </div>
</section>

<?php require_once 'includes/footer.php'; ?>
