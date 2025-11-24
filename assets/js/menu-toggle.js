document.addEventListener("DOMContentLoaded", function() {
  const burger = document.querySelector('.menu a.fa-bars');
  const body = document.body;

  if (burger) {
    burger.addEventListener('click', function(e) {
      e.preventDefault();
      body.classList.toggle('is-menu-visible');
    });
  }

  // Close menu when clicking outside or pressing ESC
  document.addEventListener('click', function(e) {
    const menu = document.querySelector('#menu');
    if (
      body.classList.contains('is-menu-visible') &&
      !menu.contains(e.target) &&
      !burger.contains(e.target)
    ) {
      body.classList.remove('is-menu-visible');
    }
  });

  document.addEventListener('keydown', function(e) {
    if (e.key === "Escape") {
      body.classList.remove('is-menu-visible');
    }
  });
});
