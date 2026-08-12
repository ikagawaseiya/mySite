<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Common::h($htmlTitle); ?></title>
  <link rel="stylesheet" href="/public/css/style.css">
  <link rel="stylesheet" href="/public/css/header.css">
  <script src="/public/js/header.js" defer></script>
</head>

<body>
  <div>
    <main class="main-content center-text">
      <h1 class="center-text">Hello, World!</h1>
      <p class="center-text">かわいいうさぎの世界にようこそ</p>
      <div>
        <div class="profile-image-wrap">
          <img src="/../images/profile.jpg" alt="プロフィール写真" class="profile-image">
        </div>
        <span class="profile-card">
          <span class="bold-text">五十川誠也</span><br>
          うさぎと暮らすエンジニア。<br>
          現在求職活動中。<br>
          使用言語はPHP、JavaScript、Java。<br>
        </span>
      </div>
      <div>
        <h2>新着記事</h2>
        <span class="new-articles-box">
          <?php $this->renderNewestPostsList($blogPosts, $newestPageLoopLimit); ?>
        </span>
      </div>
      <div>
        <span class="cute-advertise-text"><br>かわいいうさぎが見放題！</span>
        <a href="https://x.com/itoshi_u_tyan" class="link-button">
          <span class="link-button-text">X（旧Twitter）</span>
        </a>
      </div>
      <div>
        <span class="cute-advertise-text"><br>かわいいうさぎで会話を盛り上げよう！</span>
        <a href="https://store.line.me/stickershop/product/32439561/ja" class="link-button">
          <span class="link-button-text">LINEスタンプ</span>
        </a>
      </div>
      <div class="center-text contact-area ">
        <div class="cute-advertise-text"> お問い合わせ</div>
        <span class="min-text">ikagawa.office@gmail.com</span>
      </div>
    </main>
    <footer>
    </footer>
  </div>
</body>

</html>