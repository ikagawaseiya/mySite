<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $pageTitle; ?></title>
  <link rel="stylesheet" href="/public/css/style.css">
  <link rel="stylesheet" href="/public/css/header.css">
  <script src="/public/js/header.js" defer></script>
</head>

<body>
  <div class="profile-card">
    <?php showHeader($pageTitle); ?>
    <h1>Hello, World!</h1>
    <p>HP:かわいいうさぎ へようこそ。</p>
    <main>

      <p class="bio">test</p>
    </main>
    <footer>
      <a href="#contact" class="btn">お問い合わせはこちら</a>
    </footer>
  </div>
</body>

</html>