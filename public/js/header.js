/**
 *  ヘッダーのJavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
  const menuBtn = document.getElementById('js-menu-btn');
  const navContent = document.getElementById('js-nav-content');
  const body = document.body;

  if (menuBtn && navContent) {
    menuBtn.addEventListener('click', () => {
      menuBtn.classList.toggle('is-active');
      navContent.classList.toggle('is-open');
      body.classList.toggle("is-nav-open");
    });
  }
});

document.addEventListener('DOMContentLoaded', () => {
  const dropdownBtn = document.getElementById('js-dropdown-btn');
  const dropdownMenu = document.getElementById('js-dropdown-menu');

  if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener('click', () => {
      dropdownBtn.classList.toggle('is-open');
      dropdownMenu.classList.toggle('is-open');
    });
  }
});