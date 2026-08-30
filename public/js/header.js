/**
 *  ヘッダーのjs
 */

/**
 * ハンバーガーメニューのjs
 * 
 * ハンバーガーメニューのクリックにより開き、
 * 閉じるボタンで仕舞われる
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

/**ブログのドロップダウン */
document.addEventListener('DOMContentLoaded', () => {
  const dropdownBtn = document.getElementById('js-blog-dropdown-btn');
  const dropdownMenu = document.getElementById('js-blog-dropdown-menu');

  if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener('click', () => {
      dropdownBtn.classList.toggle('is-open');
      dropdownMenu.classList.toggle('is-open');
    });
  }
});

/**ゲームのドロップダウン */
document.addEventListener('DOMContentLoaded', () => {
  const dropdownBtn = document.getElementById('js-game-dropdown-btn');
  const dropdownMenu = document.getElementById('js-game-dropdown-menu');

  if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener('click', () => {
      dropdownBtn.classList.toggle('is-open');
      dropdownMenu.classList.toggle('is-open');
    });
  }
});

/**ギャラリーのドロップダウン */
document.addEventListener('DOMContentLoaded', () => {
  const dropdownBtn = document.getElementById('js-gallery-dropdown-btn');
  const dropdownMenu = document.getElementById('js-gallery-dropdown-menu');

  if (dropdownBtn && dropdownMenu) {
    dropdownBtn.addEventListener('click', () => {
      dropdownBtn.classList.toggle('is-open');
      dropdownMenu.classList.toggle('is-open');
    });
  }
});