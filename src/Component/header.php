<?php
require_once __DIR__ . '/headerGenerator.php';
/**
 * 共通ヘッダーを表示する関数
 * @param string $activePage 現在のページ名（色を変えたい場合などに使用）
 */
function showHeader(string $activePage = ''): void
{
  $siteTitle  = "かわいいうさぎ";
  if ($activePage) {
    $siteTitle .= ":" . $activePage;
  }
  $blogPosts = generateHeader();
?>
<link rel="stylesheet" href="/public/css/header.css">
<header class="site-header">
  <div class="header-text">
    <?php echo common::h($siteTitle); ?>
  </div>

  <!-- ハンバーガーボタン -->
  <button class="menu-btn" id="js-menu-btn" aria-label="メニューを開く">
    <span></span>
    <span></span>
    <span></span>
  </button>
</header>
<!-- ナビゲーションメニュー(順次追加) -->
<nav class="nav-content" id="js-nav-content">
  <div class="nav-overlay"></div>
  <ul class="nav-list">
    <li><a href="/">トップページ</a></li>

    <!-- ブログ一覧の親メニュー（クリックで開閉） -->
    <li class="nav-item-dropdown">
      <button type="button" class="dropdown-btn" id="js-dropdown-btn">
        ブログ
        <span class="arrow"></span>
      </button>

      <!-- 子メニュー（ブログ記事のリスト） -->
      <ul class="dropdown-menu" id="js-dropdown-menu">
        <?php
          $maxCount = min(5, count($blogPosts));
          for ($i = 0; $i < $maxCount; $i++):
            $post = $blogPosts[$i];
          ?>
        <li>
          <a href="<?php echo common::h($post['url']); ?>">
            <?php echo common::h($post['title']); ?>
          </a>
        </li>
        <?php endfor; ?>
      </ul>
    </li>
  </ul>
</nav>

<?php
}
?>