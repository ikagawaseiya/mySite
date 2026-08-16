<?php
$title = 'ブログ一覧のページを作成しました';
$date = '2026-08-14';
$displayTitle = Common::getHtmlPageTitle($title);
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
      <h1><?php echo Common::h($title); ?></h1>
      <p>ブログ一覧のページを作成しました。<br>
        今後ページが増えた場合、ヘッダーのメニューには収まりきらなくなる可能性があるためです。<br>
        コードの事などもっと記したいのですが、週末間際の勤務後なので疲れてしまいました。<br>
        凝った機能の実装や、有意義なブログページも増やしていきたいですが、しばらくは機能の最適化や拡張で時間がかかりそうです。</p>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>