(function () {
  'use strict';

  var body = document.body;
  var rail = document.getElementById('jbRail');
  var button = document.getElementById('jbMenuButton');

  function setMenu(open) {
    if (!rail || !button) return;
    rail.classList.toggle('is-open', open);
    body.classList.toggle('menu-open', open);
    button.setAttribute('aria-expanded', open ? 'true' : 'false');
  }

  if (button) {
    button.addEventListener('click', function () {
      setMenu(!rail.classList.contains('is-open'));
    });
  }

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') setMenu(false);
  });

  if (rail) {
    rail.querySelectorAll('a').forEach(function (link) {
      link.addEventListener('click', function () { setMenu(false); });
    });
  }

})();
