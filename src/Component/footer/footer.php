<?php

/**
 * @var string $PreviousPageButton 前の記事へボタン
 * @var string $homeButton ホームへ戻るボタン
 * @var string $nextPageButton 次の記事へボタン
 */
?>
<!--いいねボタンをここに実装-->
<div class="like-section"">
  <button type=" button" class="like-btn"></button>
</div>
<footer class="footer">
  <div class="footer-button">
    <?php
    echo $PreviousPageButton;
    ?>
    <?php
    echo $homeButton;
    ?>
    <?php
    echo $nextPageButton;
    ?>
  </div>
</footer>
</body>


</html>