<?php

/**
 * いいねボタンの画面表示
 */
/**
 * @var int $likeCount いいね数
 * @var string $ipAddress IPアドレス 
 */
?>
<link rel="stylesheet" href="/public/css/likeButton.css">

<div class="center-element">
  <button type="button" class="like-button">
    <!--ハートマークをSVGで表示-->
    <svg class="like-button-icon" viewBox="0 0 100 100">
      <path d="M91.6 13A28.7 28.7 0 0 0 51 13l-1 1-1-1A28.7 28.7 0 0 0 8.4 53.8l1 1L50 95.3l40.5-40.6 1-1a28.6 28.6 0 0 0 0-40.6z" />
    </svg>
    <!--いいねボタンのテキスト-->
    いいね！<?php echo '<span class = "like_count">' . $likeCount . '<span>' ?>
  </button>
  <div class="like-error hidden"></div>
</div>
<input type="hidden" id="ip-address" value=<?php echo $ipAddress ?>>
<input type="hidden" id="today-date-ymd" value=<?php echo Common::getDateTodayYMD() ?>>
<input type="hidden" id="csrf-token" value=<?php echo $_SESSION['csrf_token'] ?>>
<script src="/public/js/likeButton.js" defer></script>