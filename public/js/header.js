/**
 *  ヘッダーのjs
 */

/**
 * ハンバーガーメニューのjs
 */
document.addEventListener('DOMContentLoaded', () => {
  const menuBtn = document.getElementById('js-menu-btn');
  const navContent = document.getElementById('js-nav-content');
  const closeBtn = document.getElementById('js-close-btn');

  if (menuBtn && navContent) {
    menuBtn.addEventListener('click', () => {
      menuBtn.classList.toggle('is-active');
      navContent.classList.toggle('is-open');
    });
  }

  if (menuBtn && navContent && closeBtn) {
    closeBtn.addEventListener('click', () => {
      menuBtn.classList.toggle('is-active');
      navContent.classList.toggle('is-open');
    });
  }
});

/**ハンバーガーメニュー内にある、ドロップダウンのjs */
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