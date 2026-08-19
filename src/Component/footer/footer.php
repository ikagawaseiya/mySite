<?php

/**
 * @var string $PreviousPageButton 前の記事ボタン
 * @var string $homeButton ホームへ戻るボタン
 * @var string $nextPageButton 次の記事ボタン
 */
?>
<footer class="footer">
  <div class="footer-button">
    <span>
      <?php
      echo $PreviousPageButton;
      ?>
    </span>
    <span <?php echo $checkHomeButtonHidden ?>>
      <?php
      echo $homeButton;
      ?>
    </span>
    <span>
      <?php
      echo $nextPageButton;
      ?>
    </span>
  </div>
</footer>
</body>


</html>