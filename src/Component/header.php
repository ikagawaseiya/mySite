<?php
  require_once __DIR__ . '/headerGenerator.php';
/**
 * 共通ヘッダーを表示する関数
 * @param string $activePage 現在のページ名（色を変えたい場合などに使用）
 */
function showHeader(string $activePage = ''): void {
  $title  = "かわいいうさぎ"; 
  if($activePage) {
    $title .= ":" . $activePage;
  }
  $blogPosts = generateHeader();
?>

<header class="site-header">
  <div class="header-text">
    <?php echo common::h($title); ?>
  </div>

  <!-- ハンバーガーボタン -->
  <button class="menu-btn" id="js-menu-btn" aria-label="メニューを開く">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <!-- ナビゲーションメニュー(順次追加) -->
  <nav class="nav-content" id="js-nav-content">
    <ul class="nav-list">
      <li><a href="/public/">トップページ</a></li>

      <!-- 自動収集・ソートされたブログリンクを出力 -->
      <?php foreach ($blogPosts as $post): ?>
      <li>
        <a href="<?php echo common::h($post['url']); ?>">
          <?php echo common::h($post['title']); ?>
        </a>
      </li>
      <?php endforeach; ?>
      <!-- 修正ポイント：ループの閉じタグを追加 -->
    </ul>
  </nav>
</header>
<?php
} 
?>