<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Veritas Social — Jake Barton</title>
    <link rel="icon" type="image/svg+xml" href="../../../assets/images/favicon.svg?v=20260325">
    <link rel="stylesheet" href="../../../assets/css/base.css">
    <link rel="stylesheet" href="../../../assets/css/animations.css">
    <link rel="stylesheet" href="../../../assets/css/components.css">
    <style>
        .vs-gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 1.5rem;
        }
        .vs-item {
            background: #0f0f0f;
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 16px;
            overflow: hidden;
            cursor: pointer;
            text-decoration: none;
            display: block;
            transition: transform 0.35s cubic-bezier(0.16,1,0.3,1), border-color 0.3s;
        }
        .vs-item:hover { transform: translateY(-6px); border-color: rgba(255,255,255,0.25); }
        .vs-item img {
            width: 100%;
            aspect-ratio: 4/5;
            object-fit: cover;
            display: block;
            transition: transform 0.6s cubic-bezier(0.16,1,0.3,1);
        }
        .vs-item:hover img { transform: scale(1.03); }
        .vs-item-info { padding: 1.1rem 1.25rem; }
        .vs-item-eyebrow {
            font-size: 0.65rem;
            font-weight: 700;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--text-faint);
            margin-bottom: 0.3rem;
        }
        .vs-item-title {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 800;
            letter-spacing: -0.02em;
            color: var(--text);
        }

        /* Lightbox */
        .lb { display:none; position:fixed; inset:0; background:rgba(0,0,0,0.92); z-index:9999; align-items:center; justify-content:center; }
        .lb.open { display:flex; }
        .lb-inner { position:relative; max-width:min(540px, 92vw); width:100%; }
        .lb-img { width:100%; border-radius:12px; display:block; }
        .lb-close { position:fixed; top:1.25rem; right:1.5rem; font-size:2rem; color:rgba(255,255,255,0.6); cursor:pointer; line-height:1; background:none; border:none; }
        .lb-close:hover { color:#fff; }
        .lb-nav { position:fixed; top:50%; transform:translateY(-50%); font-size:1.8rem; color:rgba(255,255,255,0.5); cursor:pointer; padding:0.75rem; background:rgba(0,0,0,0.5); border-radius:50%; border:none; transition:color 0.2s; }
        .lb-nav:hover { color:#fff; }
        .lb-prev { left:1rem; }
        .lb-next { right:1rem; }
    </style>
</head>
<body>
  <div id="scroll-progress" style="position:fixed;top:0;left:0;height:2px;width:0%;background:var(--accent);z-index:100001;transition:width 0.1s linear;pointer-events:none"></div>
  <div id="cursor-glow" style="position:fixed;top:0;left:0;width:420px;height:420px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.05) 0%,transparent 70%);pointer-events:none;z-index:0;transform:translate(-50%,-50%);transition:opacity 0.3s ease;opacity:0"></div>

  <header class="site-nav" id="site-nav">
    <a href="../../../index.php" class="nav-logo">
      <img src="../../../assets/images/jb-logo.png" alt="JB" class="nav-logo-img">
      <span class="nav-logo-text">JB</span>
    </a>
    <nav class="nav-links">
      <a href="../../../index.php#about">About</a>
      <a href="../../../index.php#skills">Skills</a>
      <a href="../../">Portfolio</a>
      <a href="../../../assets/Jake%20Barton%20-%20Resume.pdf" class="btn btn-secondary btn-sm" download>Resume</a>
      <a href="../../../index.php#contact">Contact</a>
    </nav>
  </header>

  <main class="site-content">

    <!-- Hero -->
    <div style="max-width:1200px;margin:0 auto;padding:clamp(7rem,13vw,10rem) var(--spacing-md) 3rem;">
      <p class="rv" style="font-size:0.7rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;color:var(--text-faint);margin-bottom:1rem">
        <a href="../../" style="color:inherit;text-decoration:none">Portfolio</a>
        &rsaquo; <a href="../" style="color:inherit;text-decoration:none">Professional Works</a>
        &rsaquo; Veritas Social
      </p>
      <div style="display:flex;align-items:center;gap:1.5rem;flex-wrap:wrap;margin-bottom:1.5rem">
        <img src="images/veritas-logo.svg" alt="Veritas Social" class="rv" style="height:48px;opacity:0.9;transition-delay:0.04s">
      </div>
      <h1 class="rv" style="font-family:var(--font-display);font-size:clamp(3rem,7vw,5.5rem);font-weight:800;letter-spacing:-0.04em;line-height:0.95;color:var(--text);margin:0 0 1.5rem;transition-delay:0.06s">
        Veritas<br><em style="font-style:italic;font-family:'Playfair Display',Georgia,serif;font-weight:400;color:var(--text-muted)">Social.</em>
      </h1>
      <p class="rv" style="font-size:1rem;color:var(--text-muted);max-width:600px;line-height:1.7;transition-delay:0.12s">
        Event poster and promotional graphics created as a <strong style="color:var(--text)">Graphic Design Intern</strong> at Veritas Social &mdash; a Birmingham-based talent &amp; event production company with 20,000+ attendees across 13 cities. Designed for Soulja Boy, LUCO, and Neeks N Brandt shows in Auburn, Alabama.
      </p>

      <!-- Meta row -->
      <div class="rv" style="display:flex;flex-wrap:wrap;gap:0.75rem;margin-top:2rem;transition-delay:0.16s">
        <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.75rem 1.1rem">
          <strong style="display:block;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-faint);margin-bottom:3px">Role</strong>
          <span style="font-size:0.9rem;color:var(--text)">Graphic Design Intern</span>
        </div>
        <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.75rem 1.1rem">
          <strong style="display:block;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-faint);margin-bottom:3px">Client</strong>
          <span style="font-size:0.9rem;color:var(--text)">Veritas Social</span>
        </div>
        <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.75rem 1.1rem">
          <strong style="display:block;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-faint);margin-bottom:3px">Year</strong>
          <span style="font-size:0.9rem;color:var(--text)">2025 &ndash; Present</span>
        </div>
        <div style="background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:0.75rem 1.1rem">
          <strong style="display:block;font-size:0.65rem;text-transform:uppercase;letter-spacing:0.1em;color:var(--text-faint);margin-bottom:3px">Tools</strong>
          <span style="font-size:0.9rem;color:var(--text)">Photoshop &middot; Illustrator</span>
        </div>
      </div>
    </div>

    <!-- Gallery -->
    <div style="max-width:1200px;margin:0 auto;padding:0 var(--spacing-md) clamp(4rem,8vw,8rem);">

      <div class="vs-gallery">

        <div class="vs-item rv" data-img="images/soulja-boy.png" style="transition-delay:0.04s">
          <img src="images/soulja-boy.png" alt="Soulja Boy — Veritas Social">
          <div class="vs-item-info">
            <p class="vs-item-eyebrow">Event Poster &middot; Auburn, AL</p>
            <p class="vs-item-title">Soulja Boy</p>
          </div>
        </div>

        <div class="vs-item rv" data-img="images/neeks-n-brandt.png" style="transition-delay:0.08s">
          <img src="images/neeks-n-brandt.png" alt="Neeks N Brandt — Veritas Social">
          <div class="vs-item-info">
            <p class="vs-item-eyebrow">Event Poster &middot; Auburn, AL</p>
            <p class="vs-item-title">Neeks N Brandt</p>
          </div>
        </div>

        <div class="vs-item rv" data-img="images/luco.jpg" style="transition-delay:0.12s">
          <img src="images/luco.jpg" alt="LUCO — Veritas Social">
          <div class="vs-item-info">
            <p class="vs-item-eyebrow">Event Poster &middot; Auburn, AL</p>
            <p class="vs-item-title">LUCO</p>
          </div>
        </div>

      </div>

      <p class="rv" style="color:var(--text-faint);font-size:0.8rem;text-align:center;margin-top:2rem;transition-delay:0.16s">
        More work on <a href="https://www.instagram.com/veritassocial" target="_blank" style="color:var(--text-muted);text-decoration:underline;text-underline-offset:3px">@veritassocial</a> &middot; <a href="https://www.veritassocial.co" target="_blank" style="color:var(--text-muted);text-decoration:underline;text-underline-offset:3px">veritassocial.co</a>
      </p>

      <div style="text-align:center;margin-top:3rem;">
        <a href="../" class="btn-secondary magnetic rv">&#8592; Back to Professional Works</a>
      </div>
    </div>

  </main>

  <!-- Lightbox -->
  <div class="lb" id="lb">
    <button class="lb-close" id="lb-close">&times;</button>
    <button class="lb-nav lb-prev" id="lb-prev">&#8249;</button>
    <button class="lb-nav lb-next" id="lb-next">&#8250;</button>
    <div class="lb-inner">
      <img class="lb-img" id="lb-img" src="" alt="">
    </div>
  </div>

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
  <script src="../../../assets/js/beams-bg.js"></script>
  <script src="../../../assets/js/cursor-ribbons.js"></script>
  <script src="../../../assets/js/fuzzy-text.js"></script>
  <script src="../../../assets/js/effects-stylekit.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
  <script src="../../../assets/js/staggered-menu.js"></script>
  <script>
    (function(){var b=document.getElementById('scroll-progress');if(!b)return;window.addEventListener('scroll',function(){var s=window.scrollY,t=document.documentElement.scrollHeight-window.innerHeight;b.style.width=(t>0?(s/t)*100:0)+'%';},{passive:true});})();
    (function(){var g=document.getElementById('cursor-glow');if(!g||window.matchMedia('(pointer:coarse)').matches)return;var cx=0,cy=0,tx=0,ty=0;document.addEventListener('mousemove',function(e){tx=e.clientX;ty=e.clientY;g.style.opacity='1';});document.addEventListener('mouseleave',function(){g.style.opacity='0';});function lerp(a,b,t){return a+(b-a)*t;}(function loop(){cx=lerp(cx,tx,0.07);cy=lerp(cy,ty,0.07);g.style.left=cx+'px';g.style.top=cy+'px';requestAnimationFrame(loop);})();})();
    (function(){var els=document.querySelectorAll('.rv');var obs=new IntersectionObserver(function(e){e.forEach(function(x){if(x.isIntersecting){x.target.classList.add('is-visible');obs.unobserve(x.target);}});},{threshold:0.1,rootMargin:'0px 0px -40px 0px'});els.forEach(function(el){obs.observe(el);});})();

    // Lightbox
    (function(){
      var items = document.querySelectorAll('.vs-item[data-img]');
      var lb = document.getElementById('lb');
      var lbImg = document.getElementById('lb-img');
      var lbClose = document.getElementById('lb-close');
      var lbPrev = document.getElementById('lb-prev');
      var lbNext = document.getElementById('lb-next');
      var imgs = [];
      var cur = 0;

      items.forEach(function(el, i){
        imgs.push(el.getAttribute('data-img'));
        el.addEventListener('click', function(){ open(i); });
      });

      function open(i){ cur=i; lbImg.src=imgs[cur]; lb.classList.add('open'); document.body.style.overflow='hidden'; }
      function close(){ lb.classList.remove('open'); document.body.style.overflow=''; }

      lbClose.addEventListener('click', close);
      lb.addEventListener('click', function(e){ if(e.target===lb) close(); });
      lbPrev.addEventListener('click', function(){ cur=(cur-1+imgs.length)%imgs.length; lbImg.src=imgs[cur]; });
      lbNext.addEventListener('click', function(){ cur=(cur+1)%imgs.length; lbImg.src=imgs[cur]; });
      document.addEventListener('keydown', function(e){ if(!lb.classList.contains('open'))return; if(e.key==='Escape')close(); if(e.key==='ArrowLeft')lbPrev.click(); if(e.key==='ArrowRight')lbNext.click(); });
    })();
  </script>
</body>
</html>
