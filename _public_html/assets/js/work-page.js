(function () {
  'use strict';

  var filters = Array.prototype.slice.call(document.querySelectorAll('[data-work-filter]'));
  var sections = Array.prototype.slice.call(document.querySelectorAll('[data-work-section]'));
  var cards = Array.prototype.slice.call(document.querySelectorAll('[data-work-card]'));

  function applyFilter(key) {
    filters.forEach(function (button) {
      var active = button.getAttribute('data-work-filter') === key;
      button.classList.toggle('is-active', active);
      button.setAttribute('aria-pressed', active ? 'true' : 'false');
    });

    cards.forEach(function (card) {
      var categories = (card.getAttribute('data-filters') || '').split(/\s+/);
      var visible = key === 'all' || categories.indexOf(key) !== -1 || (key === 'art' && (categories.indexOf('design') !== -1 || categories.indexOf('3d') !== -1));
      card.classList.toggle('is-filtered-out', !visible);
    });
  }

  filters.forEach(function (button) {
    button.addEventListener('click', function () {
      sections.forEach(function (section) { section.classList.remove('is-active'); });
      applyFilter(button.getAttribute('data-work-filter'));
    });
  });

  sections.forEach(function (button) {
    button.addEventListener('click', function () {
      var key = button.getAttribute('data-work-section');
      sections.forEach(function (section) {
        section.classList.toggle('is-active', section === button);
      });
      applyFilter(key);
    });
  });

  cards.forEach(function (card) {
    var url = card.getAttribute('data-project-url');
    if (!url) return;

    card.setAttribute('role', 'link');
    card.addEventListener('click', function () {
      if (window.jbNavigateWithCurtain) window.jbNavigateWithCurtain(url);
      else window.location.href = url;
    });
    card.addEventListener('keydown', function (event) {
      if (event.key !== 'Enter' && event.key !== ' ') return;
      event.preventDefault();
      if (window.jbNavigateWithCurtain) window.jbNavigateWithCurtain(url);
      else window.location.href = url;
    });
  });

  var footerWord = document.querySelector('.jb-footer-word');
  var footerVideos = Array.prototype.slice.call(document.querySelectorAll('[data-footer-video]'));

  if (footerWord && footerVideos.length) {
    var activeFooterVideo = 0;
    var footerTimer = null;

    function activateFooterVideo(index) {
      activeFooterVideo = index % footerVideos.length;
      footerVideos.forEach(function (video, videoIndex) {
        var active = videoIndex === activeFooterVideo;
        video.classList.toggle('is-active', active);
        if (active) video.play().catch(function () {});
        else if (!video.paused) video.pause();
      });
    }

    function startFooterVideos() {
      if (footerTimer) return;
      activateFooterVideo(activeFooterVideo);
      footerTimer = window.setInterval(function () {
        activateFooterVideo(activeFooterVideo + 1);
      }, 1000);
    }

    function stopFooterVideos() {
      window.clearInterval(footerTimer);
      footerTimer = null;
      footerVideos.forEach(function (video) {
        if (!video.paused) video.pause();
      });
    }

    activateFooterVideo(0);
    footerWord.addEventListener('mouseenter', startFooterVideos);
    footerWord.addEventListener('focus', startFooterVideos);
    footerWord.addEventListener('mouseleave', stopFooterVideos);
    footerWord.addEventListener('blur', stopFooterVideos);
  }

})();
