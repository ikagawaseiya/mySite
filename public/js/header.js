/**
 *  ヘッダーのJavaScript
 */
document.addEventListener('DOMContentLoaded', () => {
  const menuBtn = document.getElementById('js-menu-btn');
  const navContent = document.getElementById('js-nav-content');

  if (menuBtn && navContent) {
    menuBtn.addEventListener('click', () => {
      menuBtn.classList.toggle('is-active');
      navContent.classList.toggle('is-open');
    });
  }
});