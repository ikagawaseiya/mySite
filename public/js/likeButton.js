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
* 
* ERROR処理を後で直す
* */
document.addEventListener('DOMContentLoaded', function () {
  const LIKE_BUTTON = document.querySelector('.like-button');
  const LIKE_COUNT = document.querySelector('.like_count');
  const CSRF_TOKEN = document.getElementById('csrf-token').value;
  const IP_ADDRESS = document.getElementById('ip-address').value;
  const TODAY_DATE_YMD = document.getElementById('today-date-ymd').value;
  const LIKE_ERROR_MESSAGE = document.querySelector('.like-error');

  LIKE_BUTTON.addEventListener('click', async function () {
    if (LIKE_BUTTON.disabled) return;
    LIKE_BUTTON.disabled = true;
    LIKE_BUTTON.classList.remove('like-button-animation');
    LIKE_BUTTON.classList.remove('liked');

    //  データ送信処理
    const responseResult = await registeredLikeInDB(CSRF_TOKEN, IP_ADDRESS, TODAY_DATE_YMD);
    let shouldAnimate = getLikeResponse(responseResult, LIKE_COUNT, LIKE_ERROR_MESSAGE);

    // アニメーション
    if (shouldAnimate) {
      LIKE_BUTTON.classList.add('liked');
      requestAnimationFrame(function () {
        LIKE_BUTTON.classList.add('like-button-animation');
      });
    }

    LIKE_BUTTON.disabled = false;
  });

  /**
   * アニメーション終了時の処理
   */
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
 * @param {*} LIKE_COUNT  いいね数
 */
function upDisplayLikeCount(LIKE_COUNT) {
  let currentCount = Number(LIKE_COUNT.textContent);
  LIKE_COUNT.textContent = currentCount + 1;
}


/**
 * PHPへ非同期リクエストを送信する
 * @return true 成功 / false 失敗
 */
async function registeredLikeInDB(csrfToken, ipAddress, todayDateYMD) {
  try {
    const IS_LIKE_INSERT = await fetch('/src/Model/likeButton/insertLikeData.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
      },
      body: JSON.stringify({
        uri: encodeURIComponent(window.location.pathname),
        csrfToken: csrfToken,
        ipAddress: ipAddress,
        todayDateYMD: todayDateYMD
      })
    });

    if (!IS_LIKE_INSERT.ok) {
      throw new Error('エラー：clickLikeButton');
    }
    const data = await IS_LIKE_INSERT.json();
    return data;
  } catch (error) {
    return null;
  }
}

/**
 * PHPからのレスポンスに応じて、画面の表示を切り替える
 * @param {Object|null} responseResult PHPからのレスポンス
 * @param {HTMLElement} likeCountElement いいね数
 * @param {HTMLElement} errorElement 表示されるエラーメッセージ
 * @return {boolean} アニメーションを実行するかどうか
 */
function getLikeResponse(responseResult, likeCountElement, errorElement) {
  let shouldAnimate = false;

  if (responseResult && responseResult.status === 'success') {
    upDisplayLikeCount(likeCountElement);
    shouldAnimate = true;
  } else if (responseResult && responseResult.status === 'like_daily_limit') {
    if (errorElement) {
      errorElement.textContent = responseResult.message;
      errorElement.classList.add('like-button-error-text');
      errorElement.classList.remove('hidden');
    }
  } else {
    alert('いいねの登録に失敗しました。');
  }

  return shouldAnimate;
}