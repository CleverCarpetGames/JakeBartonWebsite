(function () {
  'use strict';

  var curtain = document.getElementById('jbSubpageCurtain');
  var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  var navigating = false;

  function isHome(url) {
    return url.pathname === '/' || url.pathname === '/index.php' || url.pathname === '/home' || url.pathname === '/home.php';
  }

  function navigate(href) {
    var url = new URL(href, window.location.href);
    if (navigating) return;

    if (!curtain || reduceMotion || url.origin !== window.location.origin || isHome(url)) {
      window.location.href = url.href;
      return;
    }

    navigating = true;
    curtain.classList.add('is-animating');
    window.setTimeout(function () { window.location.href = url.href; }, 1050);
  }

  window.jbNavigateWithCurtain = navigate;

  document.addEventListener('click', function (event) {
    var link = event.target.closest('a[href]');
    if (!link || event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) return;
    if (link.target === '_blank' || link.hasAttribute('download')) return;

    var href = link.getAttribute('href');
    if (!href || href.charAt(0) === '#' || /^(mailto:|tel:|javascript:)/i.test(href)) return;

    var url = new URL(link.href, window.location.href);
    if (url.origin !== window.location.origin || isHome(url)) return;

    event.preventDefault();
    navigate(url.href);
  });

  window.addEventListener('pageshow', function () {
    navigating = false;
    if (curtain) curtain.classList.remove('is-animating');
  });
})();
