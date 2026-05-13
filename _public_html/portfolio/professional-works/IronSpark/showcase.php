<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IronSpark Studios — Jake Barton</title>
    <link rel="icon" type="image/svg+xml" href="../../../assets/images/favicon.svg?v=20260325">
    <link rel="stylesheet" href="../../../assets/css/base.css">
    <link rel="stylesheet" href="../../../assets/css/animations.css">
    <link rel="stylesheet" href="../../../assets/css/components.css">
    <style>
        .is-hero-img {
            width: 100%;
            max-height: 520px;
            object-fit: cover;
            border-radius: 16px;
            border: 1px solid rgba(255,255,255,0.08);
            display: block;
        }
        .is-logo {
            height: 52px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            display: block;
        }
        .is-meta-row {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 2rem;
        }
        .is-meta-item {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 8px;
            padding: 10px 18px;
        }
        .is-meta-item strong {
            display: block;
            font-size: 0.72rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            margin-bottom: 4px;
        }
        .is-meta-item span {
            font-size: 0.95rem;
            color: var(--text);
        }
        .is-pages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            margin-top: 2rem;
        }
        .is-page-card {
            background: var(--bg-card);
            border: 1px solid rgba(255,255,255,0.08);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .is-page-card:hover {
            transform: translateY(-4px);
            border-color: var(--accent);
            box-shadow: 0 10px 30px rgba(255,255,255,0.06);
        }
        .is-page-card-label {
            padding: 14px 18px;
            font-size: 0.9rem;
            color: var(--text-muted);
            font-weight: 500;
        }
        .is-page-preview {
            width: 100%;
            height: 180px;
            object-fit: cover;
            object-position: top;
            display: block;
            background: #111;
        }
        .is-cta-row {
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
            margin-top: 2.5rem;
        }
    </style>
</head>
<body>

  <div id="scroll-progress" style="position:fixed;top:0;left:0;height:2px;width:0%;background:var(--accent);z-index:100001;transition:width 0.1s linear;pointer-events:none"></div>
  <div id="cursor-glow" style="position:fixed;top:0;left:0;width:420px;height:420px;border-radius:50%;background:radial-gradient(circle,rgba(255,255,255,0.05) 0%,transparent 70%);pointer-events:none;z-index:0;transform:translate(-50%,-50%);transition:opacity 0.3s ease;opacity:0"></div>

    <header class="site-nav" id="site-nav">
        <a href="../../../index.php" class="nav-logo"><img src="../../../assets/images/jb-logo.png" alt="JB" class="nav-logo-img"><span class="nav-logo-text">JB</span></a>
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
        <section class="section" style="padding-top: 140px; padding-bottom: 60px; text-align: center;">
            <div style="max-width: 800px; margin: 0 auto; padding: 0 var(--container-pad);">
                <p class="eyebrow hero-eyebrow reveal">Portfolio → Professional Works</p>
                <h1 class="reveal" style="font-family:var(--font-display);font-size:clamp(2.5rem,6vw,4.5rem);font-weight:700;letter-spacing:-0.02em;line-height:1.1;color:var(--text);margin-bottom:1rem">IronSpark Studios</h1>
                <div class="divider reveal" style="margin:1.5rem auto;max-width:80px"></div>
                <p class="reveal" style="color: var(--text-muted); font-size: 1.1rem; margin-top: 0.5rem; line-height:1.75;transition-delay:0.12s">
                    Full website redesign for a Birmingham-based animation &amp; media studio — built as an IronSpark Fellow.
                </p>
            </div>
        </section>

        <!-- Hero image -->
        <section style="padding: 0 0 60px;">
            <div style="max-width: 1100px; margin: 0 auto; padding: 0 var(--container-pad);">
                <img
                    src="Assets/Birmingham-Aerial.jpg"
                    alt="IronSpark Studios — Birmingham"
                    class="is-hero-img reveal"
                    style="object-position: center 40%;"
                >
            </div>
        </section>

        <!-- Project overview -->
        <section class="section-sm">
            <div style="max-width: 1100px; margin: 0 auto; padding: 0 var(--container-pad);">
                <div style="display: grid; grid-template-columns: 1fr 360px; gap: 60px; align-items: start;">

                    <!-- Left: description -->
                    <div>
                        <img src="Assets/IronsparkLogo.webp" alt="IronSpark Studios" class="is-logo reveal" style="filter: brightness(0) saturate(100%) invert(56%) sepia(75%) saturate(1200%) hue-rotate(360deg) brightness(100%)">
                        <h2 class="reveal" style="font-size: clamp(1.6rem,3vw,2.4rem); margin-bottom: 1.25rem;">About the Project</h2>
                        <p class="reveal" style="color: var(--text-muted); line-height: 1.8; margin-bottom: 1.25rem;">
                            IronSpark Studios is a Birmingham-based animation and media studio working across entertainment and healthcare —
                            creating original animated content, visual development, and patient education experiences.
                        </p>
                        <p class="reveal" style="color: var(--text-muted); line-height: 1.8; margin-bottom: 1.25rem;">
                            As an <strong style="color: var(--text);">IronSpark Fellow</strong>, I was tasked with a complete ground-up redesign of their web presence.
                            The goal was to move away from their legacy GoDaddy site and build a fast, modern, fully custom PHP site that better
                            reflects the studio's cinematic brand and storytelling identity.
                        </p>
                        <p class="reveal" style="color: var(--text-muted); line-height: 1.8;">
                            The redesign covers the full site — homepage, about, services, work showcase, and contact — with a custom
                            contact API, responsive layout, and smooth JavaScript interactions throughout.
                        </p>

                        <div class="is-cta-row reveal">
                            <a href="index.php" class="btn-primary" target="_blank">View Redesigned Site →</a>
                            <a href="https://ironsparkstudios.com" class="btn-secondary" target="_blank">View Original Site →</a>
                        </div>
                    </div>

                    <!-- Right: meta -->
                    <div class="reveal">
                        <div class="is-meta-row" style="flex-direction: column;">
                            <div class="is-meta-item">
                                <strong>Role</strong>
                                <span>IronSpark Fellow — Web Design &amp; Development</span>
                            </div>
                            <div class="is-meta-item">
                                <strong>Client</strong>
                                <span>IronSpark Studios, Birmingham AL</span>
                            </div>
                            <div class="is-meta-item">
                                <strong>Year</strong>
                                <span>2026</span>
                            </div>
                            <div class="is-meta-item">
                                <strong>Stack</strong>
                                <span>PHP · HTML/CSS · JavaScript · Custom Contact API</span>
                            </div>
                            <div class="is-meta-item">
                                <strong>Pages</strong>
                                <span>Home · About · Services · Work · Contact · Privacy · Terms</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Pages preview -->
        <section class="section-sm">
            <div style="max-width: 1100px; margin: 0 auto; padding: 0 var(--container-pad);">
                <div class="section-header reveal" style="margin-bottom: 1rem;">
                    <span class="eyebrow">Deliverables</span>
                    <h2>Site Pages</h2>
                </div>
                <p class="reveal" style="color: var(--text-muted); margin-bottom: 0.5rem;">A fully multi-page PHP site replacing the original GoDaddy builder.</p>

                <div class="is-pages-grid stagger-children">
                    <a href="index.php" target="_blank" class="is-page-card">
                        <div class="is-page-preview" style="background: linear-gradient(135deg,#0a0a0a,#1a1a2e); display:flex; align-items:center; justify-content:center;">
                            <img src="Assets/IronsparkLogo.webp" alt="" style="height:48px; opacity:0.8; object-fit:contain;">
                        </div>
                        <div class="is-page-card-label">Home</div>
                    </a>
                    <a href="about.php" target="_blank" class="is-page-card">
                        <div class="is-page-preview" style="background: linear-gradient(135deg,#0f0f1a,#1a1a30); display:flex; align-items:center; justify-content:center;">
                            <span style="color:rgba(255,255,255,0.15); font-size:3rem; font-weight:700;">About</span>
                        </div>
                        <div class="is-page-card-label">About</div>
                    </a>
                    <a href="services.php" target="_blank" class="is-page-card">
                        <div class="is-page-preview" style="background: linear-gradient(135deg,#0a1020,#1a2040); display:flex; align-items:center; justify-content:center;">
                            <span style="color:rgba(255,255,255,0.15); font-size:3rem; font-weight:700;">Services</span>
                        </div>
                        <div class="is-page-card-label">Services</div>
                    </a>
                    <a href="work.php" target="_blank" class="is-page-card">
                        <div class="is-page-preview" style="background: linear-gradient(135deg,#100a1a,#201030); display:flex; align-items:center; justify-content:center;">
                            <span style="color:rgba(255,255,255,0.15); font-size:3rem; font-weight:700;">Work</span>
                        </div>
                        <div class="is-page-card-label">Work</div>
                    </a>
                    <a href="contact.php" target="_blank" class="is-page-card">
                        <div class="is-page-preview" style="background: linear-gradient(135deg,#0a1a10,#103020); display:flex; align-items:center; justify-content:center;">
                            <span style="color:rgba(255,255,255,0.15); font-size:3rem; font-weight:700;">Contact</span>
                        </div>
                        <div class="is-page-card-label">Contact</div>
                    </a>
                </div>
            </div>
        </section>

        <!-- Back nav -->
        <section class="section-sm" style="text-align: center;">
            <a href="../" class="btn-secondary magnetic reveal">← Back to Professional Works</a>
        </section>

    </main>

    <footer class="site-footer">
        <div class="container">
            <div class="footer-inner">
                <span class="footer-copy">&copy; <?php echo date('Y'); ?> Jake Barton. All rights reserved.</span>
                <div class="footer-socials">
                    <a href="https://www.linkedin.com/in/jakebartoncreative" target="_blank" class="btn-icon" aria-label="LinkedIn">in</a>
                    <a href="https://instagram.com/jakebarton13" target="_blank" class="btn-icon" aria-label="Instagram">IG</a>
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
    </script>

</body>
</html>
