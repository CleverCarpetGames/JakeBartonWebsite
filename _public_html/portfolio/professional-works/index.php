<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professional Works — Jake Barton</title>
    <link rel="icon" type="image/svg+xml" href="../../assets/images/favicon.svg?v=20260325">
    <link rel="stylesheet" href="../../assets/css/base.css">
    <link rel="stylesheet" href="../../assets/css/animations.css">
    <link rel="stylesheet" href="../../assets/css/components.css">
    <style>
      .pw-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 1.5rem;
        margin-bottom: 4rem;
      }
      .pw-card {
        display: flex;
        flex-direction: column;
        background: #0f0f0f;
        border: 1px solid rgba(255,255,255,0.08);
        border-radius: 16px;
        overflow: hidden;
        text-decoration: none;
        color: var(--text);
        transition: border-color 0.3s, transform 0.35s cubic-bezier(0.16,1,0.3,1);
      }
      .pw-card:hover {
        border-color: rgba(255,255,255,0.22);
        transform: translateY(-4px);
      }
      .pw-card-img {
        width: 100%;
        aspect-ratio: 16/9;
        overflow: hidden;
        background: #111;
        flex-shrink: 0;
      }
      .pw-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.6s cubic-bezier(0.16,1,0.3,1);
      }
      .pw-card:hover .pw-card-img img { transform: scale(1.04); }
      .pw-card-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
      }
      .pw-card-eyebrow {
        font-size: 0.68rem;
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--text-faint);
      }
      .pw-card-title {
        font-family: var(--font-display);
        font-size: 1.4rem;
        font-weight: 800;
        letter-spacing: -0.03em;
        line-height: 1.1;
        color: var(--text);
        margin: 0;
      }
      .pw-card-desc {
        font-size: 0.88rem;
        color: var(--text-muted);
        line-height: 1.6;
        margin: 0;
        flex: 1;
      }
      .pw-card-footer {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255,255,255,0.07);
      }
      .pw-card-tags { display: flex; gap: 0.4rem; flex-wrap: wrap; }
      .pw-arrow {
        font-size: 1.1rem;
        color: var(--text-faint);
        transition: transform 0.2s, color 0.2s;
        flex-shrink: 0;
      }
      .pw-card:hover .pw-arrow { transform: translate(3px,-3px); color: var(--text); }
    </style>
</head>
<body>
  <div id="scroll-progress" style="position:fixed;top:0;left:0;height:2px;width:0%;background:var(--accent);z-index:100001;transition:width 0.1s linear;pointer-events:none"></div>
  <div id="cursor-glow" style="position:fixed;top:0;left:0;width:420px;height:420px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.05) 0%,transparent 70%);pointer-events:none;z-index:0;transform:translate(-50%,-50%);transition:opacity 0.3s ease;opacity:0"></div>

  <header class="site-nav" id="site-nav">
    <a href="../../index.php" class="nav-logo">
      <img src="../../assets/images/jb-logo.png" alt="JB" class="nav-logo-img">
      <span class="nav-logo-text">JB</span>
    </a>
    <nav class="nav-links">
      <a href="../../index.php#about">About</a>
      <a href="../../index.php#skills">Skills</a>
      <a href="../">Portfolio</a>
      <a href="../../assets/Jake%20Barton%20-%20Resume.pdf" class="btn btn-secondary btn-sm" download>Resume</a>
      <a href="../../index.php#contact">Contact</a>
    </nav>
  </header>

  <main class="site-content">

    <div style="max-width:1200px;margin:0 auto;padding:clamp(7rem,13vw,10rem) var(--spacing-md) 3rem;">
      <p class="rv" style="font-size:0.7rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--text-faint);margin-bottom:1rem">
        <a href="../" style="color:inherit;text-decoration:none">Portfolio</a> &rsaquo; Professional Works
      </p>
      <h1 class="rv" style="font-family:var(--font-display);font-size:clamp(3rem,7vw,5.5rem);font-weight:800;letter-spacing:-0.04em;line-height:0.95;color:var(--text);margin:0 0 1.5rem;transition-delay:0.06s">
        Professional<br><em style="font-style:italic;font-family:'Playfair Display',Georgia,serif;font-weight:400;color:var(--text-muted)">Works.</em>
      </h1>
      <p class="rv" style="font-size:1rem;color:var(--text-muted);max-width:560px;line-height:1.7;transition-delay:0.12s">
        Paid client work and fellowship projects — spanning graphic design, branding, and full website redesign.
      </p>
    </div>

    <div style="max-width:1200px;margin:0 auto;padding:0 var(--spacing-md) clamp(4rem,8vw,8rem);">
      <div class="pw-grid">

        <!-- IronSpark Studios -->
        <a href="IronSpark/showcase.php" class="pw-card rv" style="transition-delay:0.04s">
          <div class="pw-card-img" style="aspect-ratio:16/7;background:#0a0a0a;">
            <img src="IronSpark/Assets/IronsparkLogo.webp" alt="IronSpark Studios"
                 style="object-fit:contain;padding:2.5rem;filter:brightness(0) saturate(100%) invert(56%) sepia(75%) saturate(1200%) hue-rotate(360deg) brightness(100%);">
          </div>
          <div class="pw-card-body">
            <span class="pw-card-eyebrow">Iron Spark Fellowship &middot; 2025</span>
            <h2 class="pw-card-title">IronSpark Studios</h2>
            <p class="pw-card-desc">Full website redesign for a Birmingham-based animation &amp; media studio. Built as an Iron Spark Fellow &mdash; PHP, custom CSS, GSAP animations, contact API.</p>
            <div class="pw-card-footer">
              <div class="pw-card-tags">
                <span class="tag tag-muted">PHP</span>
                <span class="tag tag-muted">CSS</span>
                <span class="tag tag-muted">GSAP</span>
                <span class="tag tag-muted">Web Design</span>
              </div>
              <span class="pw-arrow">&#8599;</span>
            </div>
          </div>
        </a>

        <!-- 33 Miles Band Graphics -->
        <a href="33-miles-graphics/" class="pw-card rv" style="transition-delay:0.08s">
          <div class="pw-card-img">
            <img src="33-miles-graphics/images/full/33-miles-01-grain-regular.png" alt="33 Miles Band Graphics">
          </div>
          <div class="pw-card-body">
            <span class="pw-card-eyebrow">Paid Client Work &middot; 2024</span>
            <h2 class="pw-card-title">33 Miles Band Graphics</h2>
            <p class="pw-card-desc">Social media &amp; event graphics for Christian band 33 Miles &mdash; 8 custom designs for merch, social, and live events.</p>
            <div class="pw-card-footer">
              <div class="pw-card-tags">
                <span class="tag tag-muted">Illustrator</span>
                <span class="tag tag-muted">Branding</span>
                <span class="tag tag-muted">Print</span>
              </div>
              <span class="pw-arrow">&#8599;</span>
            </div>
          </div>
        </a>

        <!-- College Guys Pressure Washing -->
        <a href="College%20Guys%20Pressure%20Washing/" class="pw-card rv" style="transition-delay:0.12s">
          <div class="pw-card-img" style="background:#111;">
            <img src="College Guys Pressure Washing/College Guys Pressure Washing Banner.svg"
                 alt="College Guys Pressure Washing"
                 style="object-fit:contain;padding:1.75rem;">
          </div>
          <div class="pw-card-body">
            <span class="pw-card-eyebrow">Paid Client Work &middot; 2024</span>
            <h2 class="pw-card-title">College Guys Pressure Washing</h2>
            <p class="pw-card-desc">Full brand identity for a local pressure washing startup &mdash; logo, banner, and marketing graphics ready for print and social media.</p>
            <div class="pw-card-footer">
              <div class="pw-card-tags">
                <span class="tag tag-muted">Illustrator</span>
                <span class="tag tag-muted">Branding</span>
                <span class="tag tag-muted">Identity</span>
              </div>
              <span class="pw-arrow">&#8599;</span>
            </div>
          </div>
        </a>

        <!-- Veritas Social -->
        <a href="veritas-social/" class="pw-card rv" style="transition-delay:0.16s">
          <div class="pw-card-img" style="background:#0d0d0a;">
            <img src="../../assets/images/VeritasAsset 1.svg" alt="Veritas Social"
                 style="object-fit:contain;padding:2.5rem;">
          </div>
          <div class="pw-card-body">
            <span class="pw-card-eyebrow">Graphic Design Internship &middot; 2025&ndash;Present</span>
            <h2 class="pw-card-title">Veritas Social</h2>
            <p class="pw-card-desc">Event posters and promotional graphics for a Birmingham-based talent &amp; event production company &mdash; featuring Soulja Boy, LUCO, and Neeks N Brandt. 20,000+ event attendees across 13 cities.</p>
            <div class="pw-card-footer">
              <div class="pw-card-tags">
                <span class="tag tag-muted">Photoshop</span>
                <span class="tag tag-muted">Illustrator</span>
                <span class="tag tag-muted">Event Graphics</span>
                <span class="tag tag-muted">Internship</span>
              </div>
              <span class="pw-arrow">&#8599;</span>
            </div>
          </div>
        </a>

        <!-- TechBirmingham Sponsor AI -->
        <a href="../web-programming/TechBirminghamSponsorAI/" class="pw-card rv" style="transition-delay:0.20s">
          <div class="pw-card-img" style="background:#fff;">
            <img src="../../assets/images/tb-logo.jpg" alt="TechBirmingham"
                 style="object-fit:contain;padding:2rem;">
          </div>
          <div class="pw-card-body">
            <span class="pw-card-eyebrow">Internship &middot; 2025</span>
            <h2 class="pw-card-title">TechBirmingham Sponsor AI</h2>
            <p class="pw-card-desc">AI-powered sponsor matching tool built during an internship at TechBirmingham &mdash; Next.js front-end with intelligent recommendations to connect sponsors with relevant tech events.</p>
            <div class="pw-card-footer">
              <div class="pw-card-tags">
                <span class="tag tag-muted">Next.js</span>
                <span class="tag tag-muted">AI</span>
                <span class="tag tag-muted">Internship</span>
              </div>
              <span class="pw-arrow">&#8599;</span>
            </div>
          </div>
        </a>

      </div>

      <div style="text-align:center;margin-top:1rem;">
        <a href="../" class="btn-secondary magnetic rv">&#8592; Back to Portfolio</a>
      </div>
    </div>

  </main>

  <footer class="site-footer">
    <div class="container">
      <div class="footer-inner">
        <span class="footer-copy">&copy; <?php echo date('Y'); ?> Jake Barton. All rights reserved.</span>
        <div class="footer-socials">
          <a href="https://www.linkedin.com/in/jakebartoncreative" target="_blank" class="btn-icon" aria-label="LinkedIn">in</a>
          <a href="https://instagram.com/jakebarton13" target="_blank" class="btn-icon" aria-label="Instagram">IG</a>
          <a href="https://github.com/jake-barton" target="_blank" class="btn-icon" aria-label="GitHub">GH</a>
        </div>
      </div>
    </div>
  </footer>

  <canvas id="beams-canvas"></canvas>
  <script src="../../assets/js/beams-bg.js"></script>
  <script src="../../assets/js/cursor-ribbons.js"></script>
  <script src="../../assets/js/fuzzy-text.js"></script>
  <script src="../../assets/js/effects-stylekit.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="../../assets/js/staggered-menu.js"></script>
  <script>
    (function(){var b=document.getElementById('scroll-progress');if(!b)return;window.addEventListener('scroll',function(){var s=window.scrollY,t=document.documentElement.scrollHeight-window.innerHeight;b.style.width=(t>0?(s/t)*100:0)+'%';},{passive:true});})();
    (function(){var g=document.getElementById('cursor-glow');if(!g||window.matchMedia('(pointer:coarse)').matches)return;var cx=0,cy=0,tx=0,ty=0;document.addEventListener('mousemove',function(e){tx=e.clientX;ty=e.clientY;g.style.opacity='1';});document.addEventListener('mouseleave',function(){g.style.opacity='0';});function lerp(a,b,t){return a+(b-a)*t;}(function loop(){cx=lerp(cx,tx,0.07);cy=lerp(cy,ty,0.07);g.style.left=cx+'px';g.style.top=cy+'px';requestAnimationFrame(loop);})();})();
    (function(){var els=document.querySelectorAll('.rv');var obs=new IntersectionObserver(function(e){e.forEach(function(x){if(x.isIntersecting){x.target.classList.add('is-visible');obs.unobserve(x.target);}});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});els.forEach(function(el){obs.observe(el);});})();
  </script>
</body>
</html>
