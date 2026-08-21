/**
 * いいねボタンのjs
 */

/*
*ボタンが押された時の表示変更処理 
*
* アニメーションのクラスは外してから付け直す処理としている
* これにより、二度目以降も動作するようにする
* */
document.addEventListener('DOMContentLoaded', function () {
  const LIKE_BUTTON = document.querySelector('.like-button');
  const LIKE_COUNT = document.querySelector('.like_count');
  if (!LIKE_BUTTON) return;

  LIKE_BUTTON.addEventListener('click', function () {

    setLikeCount(LIKE_BUTTON, LIKE_COUNT);

    LIKE_BUTTON.classList.add('liked');
    LIKE_BUTTON.classList.remove('like-button-animation');
    requestAnimationFrame(function () {
      LIKE_BUTTON.classList.add('like-button-animation');
    });
  });
  LIKE_BUTTON.addEventListener('animationend', function () {
    LIKE_BUTTON.classList.remove('like-button-animation');
    LIKE_BUTTON.classList.remove('liked');
  });
});

/**
 * いいねの数を増やす
 * 
 * TODO いいねのDBへの登録処理を行う予定
 * 
 * @param {*} LIKE_BUTTON 
 * @param {*} LIKE_COUNT 
 */
function setLikeCount(LIKE_BUTTON, LIKE_COUNT) {
  let currentCount = Number(LIKE_COUNT.textContent);
    LIKE_COUNT.textContent = currentCount + 1;
}