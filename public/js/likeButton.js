/**
 * いいねボタンのjs
 */

/*
*いいねボタンが押された時の処理 
*
*登録処理が終わるまでは再度クリックできないものとする
*
* アニメーションのクラスは外してから付け直す処理としている
* これにより、二度目以降も動作するようにする
* */
document.addEventListener('DOMContentLoaded', function () {
  const LIKE_BUTTON = document.querySelector('.like-button');
  const LIKE_COUNT = document.querySelector('.like_count');
  if (!LIKE_BUTTON) return;

  LIKE_BUTTON.addEventListener('click', async function () {
    if (LIKE_BUTTON.disabled) return;
    LIKE_BUTTON.disabled = true;
    LIKE_BUTTON.classList.remove('like-button-animation');
    LIKE_BUTTON.classList.remove('liked');

    //  データ送信処理
    const IS_SUCCESS = await clickLikeButton();

    if (IS_SUCCESS) {
      upDisplayLikeCount(LIKE_BUTTON, LIKE_COUNT);
    } else {
      alert('いいねの登録に失敗しました。');
    }

    // アニメーション
    LIKE_BUTTON.classList.add('liked');
    requestAnimationFrame(function () {
      LIKE_BUTTON.classList.add('like-button-animation');
    });

    LIKE_BUTTON.disabled = false;
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
function upDisplayLikeCount(LIKE_BUTTON, LIKE_COUNT) {
  let currentCount = Number(LIKE_COUNT.textContent);
  LIKE_COUNT.textContent = currentCount + 1;
}


/**
 * PHPへ非同期リクエストを送信する
 * @return true 成功 / false 失敗
 */
async function clickLikeButton() {
  try {

    const IS_LIKE_INSERT = await fetch('/src/Model/likeButton/insertLikeData.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ uri: window.location.pathname })
    });

    if (!IS_LIKE_INSERT.ok) {
      throw new Error('エラー：clickLikeButton');
    }
    return true;
  } catch (error) {
    return false;
  }
}