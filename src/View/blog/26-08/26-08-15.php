<?php
$title = 'トップページにQRコードを追加しました';
$date = '2026-08-15';
$displayTitle = Common::getTitleInHtml($title);
?>
<!DOCTYPE html>
<html lang="ja">

<?php $this->displayBlogHead($displayTitle) ?>

<body>
  <div>
    <main class="main-content">
      <div>
        <?php echo Common::h($date); ?>
      </div>
      <h1><?php echo Common::h($title); ?></h1>
      <p>トップページにQRコードを載せてみました。<br>
        chromeでQRコードを作成すると、真ん中に恐竜がついてくるんですね<br>
        <img src="/../images/topPage/qrcode.jpg" alt="QRコード" class="blog-image">
        かわいらしいです。<br>
        明日はファイル周りを整理した後、うさぎの写真をたくさん載せたギャラリーページの作成を計画しています。<br>
        自己満足のサイトを卒業して、需要が生まれるかもしれません。<br>
      </p>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>