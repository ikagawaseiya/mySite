/**
 * ローディング完了時にloadedクラスを付与するjs
 * TODO　読み込みに時間がかかる、ギャラリーページやゲームに付与する
*/
window.addEventListener('load', function () {
  const DISPLAY_AFTER_LOADING = document.querySelector('.display-after-loading');
  document.body.classList.add('loaded');
});