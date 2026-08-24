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
  const LIKE_USER_COOKIE = document.getElementById('like_user_cookie').value;
  const LIKE_ERROR_MESSAGE = document.querySelector('.like-error');

  LIKE_BUTTON.addEventListener('click', async function () {
    if (LIKE_BUTTON.disabled) return;
    LIKE_BUTTON.disabled = true;
    LIKE_BUTTON.classList.remove('like-button-animation');
    LIKE_BUTTON.classList.remove('liked');

    //  データ送信処理
    const responseResult = await registeredLikeInDB(CSRF_TOKEN, IP_ADDRESS, LIKE_USER_COOKIE, TODAY_DATE_YMD);
    let shouldAnimate = checkResponseReaction(responseResult, LIKE_COUNT, LIKE_ERROR_MESSAGE);

    if (shouldAnimate) {
      if (LIKE_ERROR_MESSAGE.classList.contains('is-like-error-text-hidden')) {
        LIKE_ERROR_MESSAGE.classList.add('is-like-error-text-hidden');
      }
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
 * いいねの数を1増やす
 * 
 * @param {*} likeCount  いいね数
 */
function upDisplayLikeCount(likeCount) {
  let currentCount = Number(likeCount.textContent);
  likeCount.textContent = currentCount + 1;
}


/**
 * PHPへ非同期リクエストを送信する
 * @return 送信結果のsuccessとエッセージのデータ
 */
async function registeredLikeInDB(csrfToken, ipAddress, likeUserCookie, todayDateYMD) {
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
        likeUserCookie: likeUserCookie,
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
 * データ送信の結果による処理を判定する
 * 成功していた場合、いいね数の表示をひとつ増やす
 * 失敗していた場合、場合に応じたエラーメッセージを表示する
 * 
 * その後、成否に応じて、いいね押下アニメーションの有無を返す
 * 
 * @param {Object|null} responseResult データ送信処理の結果
 * @param {HTMLElement} likeCount いいね数
 * @param {HTMLElement} likeError いいねのエラーメッセージ
 * @return {boolean} アニメーションを実行する /　実行しない
 */
function checkResponseReaction(responseResult, likeCount, likeError) {
  let shouldAnimate = false;

  if (responseResult && responseResult.status === 'success') {
    upDisplayLikeCount(likeCount);
    shouldAnimate = true;
  } else if (responseResult && responseResult.status === 'like_daily_limit') {
    if (likeError) {
      likeError.textContent = responseResult.message;
      likeError.classList.add('like-button-error-text');
      likeError.classList.remove('is-like-error-text-hidden');
    }
  } else {
    alert('いいねの登録に失敗しました。');
  }
  return shouldAnimate;
}