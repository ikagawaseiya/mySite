<!-- View/profile_view.php -->
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($data['name']); ?>のポートフォリオ</title>
  <link rel="stylesheet" href="css/style.css">
  <link href="https://googleapis.com" rel="stylesheet">
</head>

<body>
  <div class="profile-card">
    <header>
      <!-- コントローラーから渡された $data を表示 -->
      <h1><?php echo htmlspecialchars($data['name']); ?></h1>
      <p class="job-title">test</p>
    </header>
    <main>
      <p class="bio">test</p>
    </main>
    <footer>
      <a href="#contact" class="btn">お問い合わせはこちら</a>
    </footer>
  </div>
</body>

</html>