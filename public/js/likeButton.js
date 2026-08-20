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

    LIKE_BUTTON.classList.toggle('liked');
    LIKE_BUTTON.classList.remove('is-popping');
    requestAnimationFrame(function () {
      LIKE_BUTTON.classList.add('is-popping');
    });
  });
  LIKE_BUTTON.addEventListener('animationend', function () {
    LIKE_BUTTON.classList.remove('is-popping');
  });
});

/**
 * いいねの数を増やす
 * いいね済みなら、数を減らす
 * 
 * TODO いいねのDBへの登録、または削除処理を行う予定
 * 
 * @param {*} LIKE_BUTTON 
 * @param {*} LIKE_COUNT 
 */
function setLikeCount(LIKE_BUTTON, LIKE_COUNT) {
  let currentCount = Number(LIKE_COUNT.textContent);
  const isLiked = LIKE_BUTTON.classList.contains('liked');
  if (isLiked) {
    LIKE_COUNT.textContent = currentCount - 1;
    if (currentCount < 0) {
      currentCount = 0;
    }
  } else {
    LIKE_COUNT.textContent = currentCount + 1;
  }
}