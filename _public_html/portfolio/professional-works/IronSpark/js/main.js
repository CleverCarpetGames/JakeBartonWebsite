/* ================================================================
   IRONSPARK STUDIOS — main.js v2
   GSAP + ScrollTrigger · Cursor · Split panels · Floating preview
   Horizontal pin · Word reveals · Work filter · Contact form
   ================================================================ */

(function () {
  'use strict';

  /* ── utils ────────────────────────────────────────────────── */
  const qs  = (s, c = document) => c.querySelector(s);
  const qsa = (s, c = document) => [...c.querySelectorAll(s)];
  const lerp = (a, b, n) => (1 - n) * a + n * b;

  /* ── cursor ───────────────────────────────────────────────── */
  function initCursor() {
    const dot  = qs('#cursorDot');
    const ring = qs('#cursorRing');
    if (!dot || !ring || window.matchMedia('(pointer:coarse)').matches) {
      if (dot)  dot.style.display = 'none';
      if (ring) ring.style.display = 'none';
      return;
    }

    const DOT_R = 4;
    let mx = -200, my = -200;
    let rx = -200, ry = -200;

    document.addEventListener('mousemove', e => {
      mx = e.clientX;
      my = e.clientY;
      dot.style.transform = `translate(${mx - DOT_R}px, ${my - DOT_R}px)`;
    });

    (function tick() {
      rx = lerp(rx, mx, 0.13);
      ry = lerp(ry, my, 0.13);
      const rr = ring.offsetWidth / 2;
      ring.style.transform = `translate(${rx - rr}px, ${ry - rr}px)`;
      requestAnimationFrame(tick);
    })();

    // Hover expand
    const sel = 'a, button, [role="button"], .work-row, .division, .filter-btn, [data-hover], input, textarea, select, label';
    document.addEventListener('mouseover', e => {
      if (e.target.closest(sel)) document.body.classList.add('ch');

      /* ── Cursor colour: read nearest data-cursor-theme ancestor ── */
      // Walk up from target — SVG <path>/<use> nodes need parentElement fallback
      let node = e.target;
      if (node instanceof SVGElement && !node.closest) node = node.parentElement;
      const themed = node && node.closest ? node.closest('[data-cursor-theme]') : null;
      document.body.dataset.cursorTheme = themed
        ? themed.dataset.cursorTheme
        : (document.body.classList.contains('has-hero') ? 'light' : 'dark');
    });
    document.addEventListener('mouseout', e => {
      if (e.target.closest(sel)) document.body.classList.remove('ch');
    });

    // Set initial theme so cursor is correct before first mouseover
    document.body.dataset.cursorTheme =
      document.body.classList.contains('has-hero') ? 'light' : 'dark';

    document.addEventListener('mousedown', () => document.body.classList.add('clicking'));
    document.addEventListener('mouseup',   () => document.body.classList.remove('clicking'));

    document.addEventListener('mouseleave', () => {
      dot.style.opacity  = '0';
      ring.style.opacity = '0';
    });
    document.addEventListener('mouseenter', () => {
      dot.style.opacity  = '1';
      ring.style.opacity = '';
    });
  }

  /* ── divisions: play/pause video on hover ─────────────────── */
  function initDivisions() {
    qsa('.division').forEach(card => {
      const video = card.querySelector('.division__video');
      if (!video) return;

      card.addEventListener('mouseenter', () => { video.play().catch(() => {}); });
      card.addEventListener('mouseleave', () => { video.pause(); video.currentTime = 0; });
    });
  }

  /* ── nav scroll + mobile ──────────────────────────────────── */
  function initNav() {
    const nav    = qs('#mainNav');
    const toggle = qs('#navToggle');
    const menu   = qs('#navMenu');
    if (!nav) return;

    window.addEventListener('scroll', () => {
      nav.classList.toggle('scrolled', window.scrollY > 50);
    }, { passive: true });

    if (!toggle || !menu) return;
    toggle.addEventListener('click', () => {
      const open = menu.classList.toggle('mobile-open');
      toggle.classList.toggle('open', open);
      document.body.classList.toggle('locked', open);
    });
    qsa('.nav__link', menu).forEach(a => {
      a.addEventListener('click', () => {
        menu.classList.remove('mobile-open');
        toggle.classList.remove('open');
        document.body.classList.remove('locked');
      });
    });
  }

  /* ── hero logo wipe reveal + perspective parallax ────────────── */
  function initHero() {
    if (typeof gsap === 'undefined') return;

    const nav        = qs('#mainNav');
    const logoMask   = qs('#heroLogoMask');
    const sub        = qs('.hero__sub');
    const viewWork   = qs('.hero__view-work');
    const bgScene    = qs('#heroBgScene');
    const bgVideo    = qs('#heroBgVideo');
    const heroCenter = qs('.hero__center');
    const heroFooter = qs('.hero__footer');
    const reelEl     = qs('.hero__reel');
    const tcEl       = qs('#heroTimecode');

    if (!logoMask) return;

    const tl = gsap.timeline({ delay: 0.2 });

    /* Nav slides down */
    if (nav) {
      gsap.set(nav, { y: '-100%' });
      tl.to(nav, { y: 0, duration: 0.75, ease: 'expo.out' }, 0);
    }

    /* Video breathes in — scale only, curtain handled opacity */
    if (bgVideo) {
      gsap.set(bgVideo, { scale: 1.08 });
      tl.to(bgVideo, { scale: 1, duration: 2.8, ease: 'power2.out' }, 0);
    }

    /* ── Logo: film-title slam ──────────────────────────────────
       Wipes left→right AND scales down from a slightly larger state.
       expo.inOut gives the sharp-then-settle feel of a film cut.    */
    gsap.set(logoMask, { scale: 1.06, transformOrigin: 'center center' });
    tl.fromTo(logoMask,
      { clipPath: 'inset(0 100% 0 0)', scale: 1.06 },
      { clipPath: 'inset(0 0% 0 0)', scale: 1, duration: 1.3, ease: 'expo.inOut' },
      0.25
    );

    /* ── Subtitle: letter-spacing opens like film credits ────── */
    if (sub) {
      tl.fromTo(sub,
        { opacity: 0, y: 8, letterSpacing: '0.55em' },
        { opacity: 1, y: 0, letterSpacing: '0.15em', duration: 1.1, ease: 'expo.out' },
        '-=0.45'
      );
    }

    /* ── View Our Work: slides up with intent ────────────────── */
    if (viewWork) {
      gsap.set(viewWork, { opacity: 0, y: 14 });
      tl.to(viewWork, { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' }, '-=0.5');
    }

    /* ── Reel timecode fades in last ─────────────────────────── */
    if (reelEl) {
      gsap.set(reelEl, { opacity: 0 });
      tl.to(reelEl, { opacity: 1, duration: 0.6, ease: 'power2.out' }, '-=0.3');
    }

    /* ── Mouse scrub + scroll parallax + timecode ────────────── */
    if (bgScene && bgVideo) {
      const SCRUB_FRAC = 0.7;

      let mx = 0.5, lx = 0.5;
      let scrollY = 0, lastScrollY = -1;
      let hasMoused = false;
      let lastSeekAt = 0;

      /* ── Blob-preload for lag-free reverse scrubbing ─────────
         Fetch the full video into memory as a Blob URL so the
         browser can seek backwards without re-decoding/buffering. */
      const videoSrc = bgVideo.src || bgVideo.currentSrc;
      if (videoSrc) {
        fetch(videoSrc)
          .then(r => r.blob())
          .then(blob => {
            const blobUrl = URL.createObjectURL(blob);
            const prevTime = bgVideo.currentTime;
            bgVideo.src = blobUrl;
            bgVideo.load();
            bgVideo.addEventListener('loadedmetadata', () => {
              bgVideo.currentTime = prevTime;
              bgVideo.pause();
            }, { once: true });
          })
          .catch(() => {
            /* Fallback: just pause normally if fetch fails */
            bgVideo.addEventListener('loadedmetadata', () => { bgVideo.pause(); });
            if (bgVideo.readyState >= 1) bgVideo.pause();
          });
      } else {
        bgVideo.addEventListener('loadedmetadata', () => { bgVideo.pause(); });
        if (bgVideo.readyState >= 1) bgVideo.pause();
      }

      if (window.matchMedia('(pointer: coarse)').matches) {
        bgVideo.setAttribute('loop', '');
        bgVideo.play().catch(() => {});
      }

      document.addEventListener('mousemove', e => {
        mx = e.clientX / window.innerWidth;
        hasMoused = true;
      });

      window.addEventListener('scroll', () => { scrollY = window.scrollY; }, { passive: true });

      (function scrubTick() {
        lx = lerp(lx, mx, 0.05);

        if (scrollY !== lastScrollY) {
          bgScene.style.transform = `translateY(${scrollY * 0.18}px)`;
          lastScrollY = scrollY;
        }

        if (hasMoused && bgVideo.duration) {
          const now = performance.now();
          if (now - lastSeekAt >= 33) {
            const target = bgVideo.duration * lx * SCRUB_FRAC +
                           bgVideo.duration * (1 - SCRUB_FRAC) * 0.5;
            bgVideo.currentTime = Math.max(0, Math.min(bgVideo.duration, target));
            lastSeekAt = now;
          }
        }

        /* Reel timecode — mirrors currentTime in MM:SS:FF format */
        if (tcEl && bgVideo.duration) {
          const t = bgVideo.currentTime;
          const mm = Math.floor(t / 60).toString().padStart(2, '0');
          const ss = Math.floor(t % 60).toString().padStart(2, '0');
          const ff = Math.floor((t % 1) * 24).toString().padStart(2, '0');
          tcEl.textContent = `${mm}:${ss}:${ff}`;
        }

        requestAnimationFrame(scrubTick);
      })();
    }

    /* ── Layered scroll parallax ─────────────────────────────── */
    if (typeof ScrollTrigger !== 'undefined') {
      const heroEl = qs('.hero');
      if (heroCenter) {
        gsap.to(heroCenter, {
          yPercent: -18, ease: 'none',
          scrollTrigger: { trigger: heroEl, start: 'top top', end: 'bottom top', scrub: true }
        });
      }
      if (heroFooter) {
        gsap.to(heroFooter, {
          opacity: 0, yPercent: 15, ease: 'none',
          scrollTrigger: { trigger: heroEl, start: 'top top', end: '35% top', scrub: true }
        });
      }
    }
  }

  /* ── manifesto word-by-word reveal ───────────────────────── */
  function initManifesto() {
    const para = qs('#manifestoText');
    if (!para || typeof ScrollTrigger === 'undefined') return;

    // Split text into individual word spans
    const raw = para.textContent.trim();
    para.innerHTML = raw.split(/\s+/).map(w =>
      `<span class="m-word" style="display:inline-block;overflow:hidden;vertical-align:bottom">` +
      `<span class="m-word__inner" style="display:inline-block">${w}</span></span>`
    ).join(' ');

    const inners = qsa('.m-word__inner', para);
    gsap.set(inners, { yPercent: 110 });

    ScrollTrigger.create({
      trigger: para,
      start: 'top 78%',
      once: true,
      onEnter: () => {
        gsap.to(inners, {
          yPercent: 0,
          duration: 0.9,
          ease: 'power3.out',
          stagger: 0.035
        });
      }
    });

    // Link fades in after words
    const link = qs('.manifesto__link');
    if (link) {
      gsap.set(link, { opacity: 0, y: 14 });
      ScrollTrigger.create({
        trigger: link, start: 'top 85%', once: true,
        onEnter: () => gsap.to(link, { opacity: 1, y: 0, duration: .7, ease: 'power3.out', delay: .3 })
      });
    }
  }

  /* ── CTA / manifesto-cta action reveal ───────────────────── */
  function initCTA() {
    const action = qs('.manifesto-cta__action');
    if (!action || typeof ScrollTrigger === 'undefined') return;

    gsap.set(action, { opacity: 0, y: 22 });

    ScrollTrigger.create({
      trigger: '.manifesto-cta',
      start: 'top 72%',
      once: true,
      onEnter: () => {
        gsap.to(action, {
          opacity: 1, y: 0, duration: .8, ease: 'power3.out', delay: .3
        });
      }
    });
  }

  /* ── extra scroll atmosphere effects ─────────────────────── */
  function initScrollAtmosphere() {
    if (typeof ScrollTrigger === 'undefined' || typeof gsap === 'undefined') return;

    /* Orange bar wipes in from the left — like a film cut */
    const bar = qs('.orange-bar');
    if (bar) {
      gsap.from(bar, {
        clipPath: 'inset(0 100% 0 0)',
        duration: 1.1, ease: 'expo.inOut',
        scrollTrigger: { trigger: bar, start: 'top 95%', once: true }
      });
    }

    /* Horizontal rule / divider lines wipe in */
    qsa('hr, .divider').forEach(line => {
      gsap.from(line, {
        scaleX: 0, transformOrigin: 'left center',
        duration: 1, ease: 'power3.inOut',
        scrollTrigger: { trigger: line, start: 'top 90%', once: true }
      });
    });

    /* Section headings: clip-path slide-up reveal */
    qsa('.section-title, .eyebrow').forEach((el, i) => {
      gsap.from(el, {
        clipPath: 'inset(0 0 100% 0)',
        y: 24, opacity: 0,
        duration: 0.85, ease: 'power3.out',
        delay: i * 0.08,
        scrollTrigger: { trigger: el, start: 'top 88%', once: true }
      });
    });

    /* Stats / numbers pop in */
    qsa('[data-count]').forEach(el => {
      gsap.from(el, {
        scale: 0.7, opacity: 0,
        duration: 0.6, ease: 'back.out(1.7)',
        scrollTrigger: { trigger: el, start: 'top 82%', once: true }
      });
    });
  }

  /* ── divisions section title entrance ────────────────────── */
  function addDivisionsSectionReveal() {
    const cards = qsa('.division');
    if (!cards.length || typeof ScrollTrigger === 'undefined') return;

    /* Set starting states */
    gsap.set(cards, { clipPath: 'inset(0 0 100% 0)' });
    gsap.set(qsa('.division__inner'), { opacity: 0, y: 28 });

    /* Header title wipes in */
    const title = qs('.divisions__title');
    if (title) {
      gsap.set(title, { opacity: 0, y: 20 });
      ScrollTrigger.create({
        trigger: '.divisions', start: 'top 85%', once: true,
        onEnter: () => gsap.to(title, { opacity: 1, y: 0, duration: 0.8, ease: 'power3.out' })
      });
    }

    ScrollTrigger.create({
      trigger: '.divisions__cards', start: 'top 85%', once: true,
      onEnter: () => {
        /* Cards curtain-rise like a stage reveal */
        gsap.to(cards, {
          clipPath: 'inset(0 0 0% 0)',
          duration: 1.4, ease: 'expo.inOut', stagger: 0.14
        });
        /* Inner content staggers in after the curtain is mostly up */
        gsap.to(qsa('.division__inner'), {
          opacity: 1, y: 0,
          duration: 0.85, ease: 'power3.out', stagger: 0.12, delay: 0.75
        });
      }
    });
  }

  /* ── GSAP scroll reveals ──────────────────────────────────── */
  function initReveals() {
    if (typeof ScrollTrigger === 'undefined') return;

    ScrollTrigger.batch('[data-reveal]', {
      onEnter: els => gsap.from(els, {
        opacity: 0, y: 40, duration: .95, ease: 'power3.out', stagger: .08
      }),
      start: 'top 88%',
      once: true,
    });

    // Stagger work rows
    const rows = qsa('.work-row');
    if (rows.length) {
      gsap.from(rows, {
        opacity: 0, y: 22, duration: .75, ease: 'power3.out', stagger: .055,
        scrollTrigger: { trigger: '.work-table', start: 'top 82%', once: true }
      });
    }

    // Stat counters
    qsa('[data-count]').forEach(el => {
      const end = parseInt(el.dataset.count, 10);
      const suffix = el.dataset.suffix || '';
      ScrollTrigger.create({
        trigger: el, start: 'top 80%', once: true,
        onEnter: () => {
          const st = performance.now();
          const dur = 1800;
          (function step(now) {
            const p = Math.min((now - st) / dur, 1);
            const ease = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(ease * end) + suffix;
            if (p < 1) requestAnimationFrame(step);
          })(performance.now());
        }
      });
    });
  }

  /* ── horizontal capabilities scroll (GSAP pin) ───────────── */
  function initHorizScroll() {
    const section = qs('#capabilities');
    const track   = qs('.cap-track');
    if (!section || !track || typeof ScrollTrigger === 'undefined') return;
    if (window.innerWidth < 900) return; // mobile: plain overflow scroll

    const dist = track.scrollWidth - window.innerWidth;

    gsap.to(track, {
      x: -dist,
      ease: 'none',
      scrollTrigger: {
        trigger: section,
        start: 'top top',
        end: () => '+=' + (dist * 1.25),
        pin: true,
        scrub: 1.1,
        anticipatePin: 1,
        invalidateOnRefresh: true,
      }
    });
  }

  /* ── floating work preview ────────────────────────────────── */
  function initWorkPreview() {
    const preview = qs('#workPreview');
    const img     = qs('#workPreviewImg');
    if (!preview || !img) return;

    let tx = 0, ty = 0, cx = 0, cy = 0;

    qsa('.work-row[data-preview]').forEach(row => {
      row.addEventListener('mouseenter', () => {
        const src = row.dataset.preview;
        if (!src) return;
        img.src = src;
        preview.classList.add('show');
      });
      row.addEventListener('mouseleave', () => {
        preview.classList.remove('show');
      });
    });

    document.addEventListener('mousemove', e => {
      tx = e.clientX + 22;
      ty = e.clientY - 80;
    });

    (function animPreview() {
      cx = lerp(cx, tx, 0.1);
      cy = lerp(cy, ty, 0.1);
      preview.style.left = cx + 'px';
      preview.style.top  = cy + 'px';
      requestAnimationFrame(animPreview);
    })();
  }

  /* ── work filter ──────────────────────────────────────────── */
  function initFilter() {
    const btns = qsa('.filter-btn');
    const rows = qsa('.work-row[data-cat]');
    if (!btns.length) return;

    btns.forEach(btn => {
      btn.addEventListener('click', () => {
        btns.forEach(b => b.classList.remove('on'));
        btn.classList.add('on');
        const f = btn.dataset.filter;
        rows.forEach(r => {
          const show = f === 'all' || r.dataset.cat === f;
          r.style.opacity       = show ? '1' : '0.15';
          r.style.pointerEvents = show ? 'auto' : 'none';
        });
      });
    });
  }

  /* ── contact form ─────────────────────────────────────────── */
  function initForm() {
    const form = qs('#contact-form');
    if (!form) return;

    form.addEventListener('submit', async e => {
      e.preventDefault();
      const btn    = form.querySelector('[type="submit"]');
      const status = qs('#form-status');
      btn.textContent = 'Sending…';
      btn.disabled = true;

      try {
        const res  = await fetch('/send-mail.php', { method: 'POST', body: new FormData(form) });
        const data = await res.json();
        if (data.success) {
          status.className = 'form__msg ok';
          status.textContent = "Message sent. We'll be in touch.";
          form.reset();
        } else throw new Error(data.message);
      } catch {
        status.className = 'form__msg err';
        status.textContent = 'Something went wrong — email us at hello@ironsparkstudios.com';
      }
      btn.textContent = 'Send Message';
      btn.disabled = false;
    });
  }

  /* ── external links ───────────────────────────────────────── */
  function initLinks() {
    qsa('a[href^="http"]').forEach(a => {
      if (!a.target) { a.target = '_blank'; a.rel = 'noopener noreferrer'; }
    });
  }

  /* ── page transitions ─────────────────────────────────────── */
  /*
   * Strategy: pure multi-page. The curtain ALWAYS covers on load
   * (set via CSS default transform:translateY(0)). JS reveals it.
   * On link click: animate curtain down, then do a real navigation.
   * No fetch. No DOM swap. No complexity. Bulletproof.
   */
  function initPageTransitions() {
    const curtainEl = qs('#curtain__inner');
    if (!curtainEl || typeof gsap === 'undefined') return;

    let busy = false;

    /* Pull curtain off-screen upward — page becomes visible */
    function reveal() {
      return new Promise(resolve => {
        gsap.to(curtainEl, {
          yPercent: -100,
          duration: 0.85,
          ease: 'power3.inOut',
          onComplete: resolve
        });
      });
    }

    /* Push curtain down to cover screen, then navigate for real */
    function coverThenGo(href) {
      if (busy) return;
      busy = true;
      document.body.classList.add('is-leaving');
      gsap.to(curtainEl, {
        yPercent: 0,
        duration: 0.65,
        ease: 'power3.inOut',
        onComplete: () => { window.location.href = href; }
      });
    }

    /* Intercept internal links */
    document.addEventListener('click', e => {
      const link = e.target.closest('a[href]');
      if (!link) return;
      const href = link.getAttribute('href');
      if (!href ||
          href.startsWith('http') || href.startsWith('//') ||
          href.startsWith('#') || href.startsWith('mailto:') ||
          href.startsWith('tel:') || link.target === '_blank') return;
      /* Same page — no transition needed */
      const dest = new URL(href, window.location.href);
      if (dest.pathname === window.location.pathname && dest.search === window.location.search) return;
      e.preventDefault();
      coverThenGo(href);
    });

    /* On every page load: curtain is covering (CSS default).
     * Reveal it, then kick off the hero entrance animation. */
    gsap.set(curtainEl, { yPercent: 0 }); // reinforce CSS default (GSAP may override)
    reveal().then(() => initHero());
  }

  /* ── GSAP + ScrollTrigger registration ───────────────────── */
  /* ── film grain ───────────────────────────────────────────── */
  function initGrain() {
    // Generate a 256×256 noise tile with ~9% opacity so it
    // blends as a background layer rather than a floating overlay.
    const size = 256;
    const c   = document.createElement('canvas');
    c.width   = c.height = size;
    const ctx = c.getContext('2d');
    const img = ctx.createImageData(size, size);
    const d32 = new Uint32Array(img.data.buffer);
    for (let i = 0; i < d32.length; i++) {
      const v = (Math.random() * 255) | 0;
      // alpha ≈ 22/255 = ~8.6% — semi-transparent grain
      d32[i] = (22 << 24) | (v << 16) | (v << 8) | v;
    }
    ctx.putImageData(img, 0, 0);
    const url = c.toDataURL('image/png');

    // Bake grain directly into each surface as a background-image layer.
    // Because CSS background-image is always rendered BELOW the element's
    // child content, images and videos naturally paint on top — no grain
    // touches them regardless of stacking context or GSAP transforms.
    const style = document.createElement('style');
    style.textContent = `
      body,
      .hero,
      .divisions,
      .orange-bar,
      .manifesto-cta {
        background-image: url("${url}");
        background-size: 256px 256px;
        background-repeat: repeat;
      }
    `;
    document.head.appendChild(style);
  }

  /* ── button arrow animations ─────────────────────────────── */
  function initButtonAnimations() {
    // For every .btn and .division__cta with an SVG arrow:
    // wrap the SVG in a clip container, clone it below-left,
    // then GSAP-animate exit upper-right / enter from lower-left
    // on hover — a cinematic "launch" that matches the page's expo easing.
    const targets = qsa('.btn, .division__cta');
    targets.forEach(el => {
      const svg = el.querySelector('svg');
      if (!svg) return;

      const wrap = document.createElement('span');
      wrap.className = 'btn__icon-wrap';
      svg.parentNode.insertBefore(wrap, svg);
      wrap.appendChild(svg);

      const clone = svg.cloneNode(true);
      wrap.appendChild(clone);
      gsap.set(clone, { position: 'absolute', top: 0, left: 0, xPercent: 130, yPercent: 130 });

      el.addEventListener('mouseenter', () => {
        gsap.to(svg,   { xPercent: -130, yPercent: -130, duration: .38, ease: 'power2.in',  overwrite: true });
        gsap.fromTo(clone,
          { xPercent: 130, yPercent: 130 },
          { xPercent: 0,   yPercent: 0,   duration: .38, ease: 'power2.out', delay: .04, overwrite: true }
        );
      });
      el.addEventListener('mouseleave', () => {
        gsap.to(svg,   { xPercent: 0,   yPercent: 0,   duration: .38, ease: 'power2.out', overwrite: true });
        gsap.to(clone, { xPercent: 130, yPercent: 130,  duration: .38, ease: 'power2.in',  overwrite: true });
      });
    });
  }

  /* ── mobile nav ───────────────────────────────────────────── */
  function initMobileNav() {
    const burger = qs('.nav__burger');
    const panel  = qs('.nav__mobile');
    if (!burger || !panel) return;

    const links = qsa('a', panel);
    let isOpen  = false;

    function open() {
      isOpen = true;
      burger.setAttribute('aria-expanded', 'true');
      burger.setAttribute('aria-label', 'Close navigation');
      panel.setAttribute('aria-hidden', 'false');
      panel.classList.add('is-open');
      document.body.style.overflow = 'hidden';
    }

    function close() {
      isOpen = false;
      burger.setAttribute('aria-expanded', 'false');
      burger.setAttribute('aria-label', 'Open navigation');
      panel.setAttribute('aria-hidden', 'true');
      panel.classList.remove('is-open');
      document.body.style.overflow = '';
    }

    burger.addEventListener('click', () => isOpen ? close() : open());

    // Close when any nav link is tapped
    links.forEach(a => a.addEventListener('click', close));

    // Close on Escape
    document.addEventListener('keydown', e => {
      if (e.key === 'Escape' && isOpen) close();
    });
  }

  function boot() {
    if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
      gsap.registerPlugin(ScrollTrigger);
    }
    initGrain();
    initMobileNav();
    initButtonAnimations();
    initCursor();
    initNav();
    initDivisions();
    addDivisionsSectionReveal();
    initReveals();
    initManifesto();
    initCTA();
    initScrollAtmosphere();
    initHorizScroll();
    initWorkPreview();
    initFilter();
    initForm();
    initLinks();
    initPageTransitions();
  }

  document.readyState === 'loading'
    ? document.addEventListener('DOMContentLoaded', boot)
    : boot();

})();
