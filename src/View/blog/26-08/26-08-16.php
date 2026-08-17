<?php
$title = 'ギャラリーページを新設しました';
$date = '2026-08-16';
$displayTitle = Common::getTitleInHtml($title);
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Common::h($displayTitle); ?></title>
  <link rel="stylesheet" href="/public/css/blog.css">
  <script src="/public/js/header.js" defer></script>
</head>

<body>
  <div>
    <main class="main-content">
      <div>
        <?php echo Common::h($date); ?>
      </div>
      <h1><?php echo Common::h($title); ?></h1>
      <p>新たにギャラリーページを新設しました。<br>
        その１は、ずっと昔のうさぎの写真です</p>
      <img src="/../images\gallery\gallery_1\2019.10.16 050.JPG" alt="うさぎ" class="blog-image">
      <p>昔から変わらず、愛らしいです。<br></p>
      <div>
        本日はページの新設もそこそこ大変でしたが、それ以上にソースコードの整理で疲れてしまいました。<br>
        ディレクトリを見やすく分けたり、関数を切り分けて汎用性を持たせたり。
        大変ですが、根本的な機能の改修は作り始めのうちに済ませておきたいです。要素が増えてからではより難しくなるので。<br>
      </div>
      <div class="top-space"> 来週はフッターの実装を目標とします。</div>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>