<?php
$title = 'いいねボタン制作中';
$date = '2026-08-20';
$this->displayBlogHead($title);
?>
<main class="main-content">
  <div>
    <?php echo Common::h($date); ?>
  </div>
  <h1><?php echo Common::h($title); ?></h1>
  <p>
    いいねボタンを設置しました。ですが押せるだけで、DBへの登録処理を行ってないので保存されません。。<br>
    DBへの理解はまだ浅いので、結構頑張らないといけなさそうです。<br>

    <link rel="stylesheet" href="/public/css/likeButton.css">

    <!--
　　　ブログ内のいいねボタン
　　　サンプルを置くのは一度きりの予定なので雑に貼っています、手抜き勘弁
　　　-->
    <style>
      /*いいねボタン全体*/
      .like-button2 {
        color: #888;
        font-size: 1em;
        border: 0.1em solid;
        border-radius: 1em;
        padding: 0.333em 1em 0.25em;
        line-height: 1.2em;
        cursor: pointer;
        transition: color 150ms ease-in-out, background-color 150ms ease-in-out, transform 150ms ease-in-out;
        outline: 0;
        background-color: white;
        margin-top: 10;
      }

      /*中のハートマーク*/

      .like-button-icon2 {
        display: inline-block;
        fill: currentColor;
        width: 0.8em;
        height: 0.8em;
        margin-right: 0.2em;
      }

      /*カーソルを合わせた時*/
      .like-button2:hover {
        color: #e5348c;
      }

      /*ボタンが押された場合*/
      .like-button2.liked {
        color: #ffffff;
        background-color: #e5348c;
        border-color: #e5348c;
      }

      /*中央に配置する*/
      .center-element2 {
        display: flex;
        justify-content: center;
        align-items: center;
      }

      /* 押した場合のアニメーション表示 */
      @keyframes pop-animation {
        0% {
          transform: scale(1);
        }

        50% {
          transform: scale(1.3);
        }

        100% {
          transform: scale(1);
        }
      }

      /* 押した場合のアニメーション実行*/
      .like-button2.is-popping {
        animation: pop-animation 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }
    </style>
  <div class="center-element">
    <button type="button" class="like-button2" id="link-button">
      <!--ハートマークをSVGで表示-->
      <svg class="like-button-icon2" viewBox="0 0 100 100">
        <path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z" />
      </svg>
      <!--いいねボタンのテキスト-->
      いいね！<?php echo '<span class = "like_count2" id="link_count2">' . 999 . '<span>' ?>
    </button>

  </div>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const LIKE_BUTTON = document.querySelector('.like-button2');
      const LIKE_COUNT = document.querySelector('.like_count2');
      if (!LIKE_BUTTON) return;

      LIKE_BUTTON.addEventListener('click', function() {

        setLikeCount(LIKE_BUTTON, LIKE_COUNT);

        LIKE_BUTTON.classList.toggle('liked');
        LIKE_BUTTON.classList.remove('is-popping');
        requestAnimationFrame(function() {
          LIKE_BUTTON.classList.add('is-popping');
        });
      });
      LIKE_BUTTON.addEventListener('animationend', function() {
        LIKE_BUTTON.classList.remove('is-popping');
      });
    });

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
  </script>

  <div>
    いいねボタンのデザインは、こちらを参考にさせていただきました。偶然見つけたものです。
    <a href="https://www.geo-brain.com/blog/?p=11075">
      <br>株式会社ジオブレイン　公式ブログ</a>
  </div>
  <div>
    <br>とてもいいデザインです。<br>
    今はAIが便利な時代ですが、自分で探す心意気も大切ですね。
  </div>

  </p>
</main>
<?php showFooter(); ?>