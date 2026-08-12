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

  <!-- ナビゲーションメニュー(順次追加) -->
  <nav class="nav-content" id="js-nav-content">
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
          <?php foreach ($blogPosts as $post): ?>
          <li>
            <a href="<?php echo common::h($post['url']); ?>">
              <?php echo common::h($post['title']); ?>
            </a>
          </li>
          <?php endforeach; ?>
        </ul>
      </li>
    </ul>
  </nav>
</header>
<?php
}
?>