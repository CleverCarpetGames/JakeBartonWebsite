(function () {
  'use strict';

  var word = document.querySelector('.jb-footer-word');
  var videos = Array.prototype.slice.call(document.querySelectorAll('[data-footer-video]'));
  if (!word || !videos.length) return;

  var activeIndex = 0;
  var timer = null;

  function activate(index) {
    activeIndex = index % videos.length;
    videos.forEach(function (video, videoIndex) {
      var active = videoIndex === activeIndex;
      video.classList.toggle('is-active', active);
      if (active) video.play().catch(function () {});
      else if (!video.paused) video.pause();
    });
  }

  function start() {
    if (timer) return;
    activate(activeIndex);
    timer = window.setInterval(function () { activate(activeIndex + 1); }, 1000);
  }

  function stop() {
    window.clearInterval(timer);
    timer = null;
    videos.forEach(function (video) { if (!video.paused) video.pause(); });
  }

  activate(0);
  word.addEventListener('mouseenter', start);
  word.addEventListener('focus', start);
  word.addEventListener('mouseleave', stop);
  word.addEventListener('blur', stop);
})();
