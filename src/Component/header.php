<?php
define("MAX_PAGE_COUNT_IN_DROPDOWN", 5);
/**
 * 共通ヘッダーを表示する関数
 * @param string $activePage 現在のページ名
 */
function showHeader(string $activePage = ''): void
{
  $displayHeaderTitle = SITE_NAME . ":" . $activePage;
  $blogPosts =  FileGetter::getArrayNewestPageFirst(PathGetter::getBlogFilePathFromController());
  $galleryPosts = FileGetter::getArrayNewestPageFirst(PathGetter::getGalleryFilePathFromController());
?>
  <link rel="stylesheet" href="/public/css/header.css">
  <header class="site-header">
    <div class="header-text">
      <?php echo Common::h($displayHeaderTitle); ?>
    </div>

    <!-- ハンバーガーボタン -->
    <!-- クリックでメニューが開閉 -->
    <button class="menu-open-btn" id="js-menu-btn" aria-label="メニューを開く">
      <span></span>
      <span></span>
      <span></span>
    </button>
  </header>
  <!-- ナビゲーションメニュー(順次追加) -->
  <nav class="nav-content" id="js-nav-content">
    <button class="menu-close-btn" id="js-close-btn" aria-label="メニューを閉じる">
      <span>×</span>
    </button>
    <div class="nav-overlay"></div>
    <ul class="nav-list">
      <li><a href="/">トップページ</a></li>

      <!-- ブログ一覧の親メニュー（クリックで開閉） -->
      <li class="nav-item-dropdown">
        <button type="button" class="dropdown-btn" id="js-blog-dropdown-btn">
          ブログ
          <span class="arrow"></span>
        </button>

        <!-- ブログの子メニュー -->
        <ul class="dropdown-menu" id="js-blog-dropdown-menu">
          <?php
          $maxCount = min(MAX_PAGE_COUNT_IN_DROPDOWN, count($blogPosts));
          for ($i = 0; $i < $maxCount; $i++):
            $blogPost = $blogPosts[$i];
          ?>
            <li>
              <a href="<?php echo Common::h($blogPost['url']); ?>">
                <?php echo Common::h($blogPost['title']); ?>
              </a>
            </li>
          <?php endfor; ?>
          <li><a href="/blogList"><span class="arrow-icon">▶</span>ブログ一覧</a></li>
        </ul>
      </li>

      <!-- ギャラリー一覧の親メニュー（クリックで開閉） -->
      <li class="nav-item-dropdown">
        <button type="button" class="dropdown-btn" id="js-gallery-dropdown-btn">
          ギャラリー
          <span class="arrow"></span>
        </button>

        <!-- ギャラリーの子メニュー -->
        <ul class="dropdown-menu" id="js-gallery-dropdown-menu">
          <?php
          $maxCount = min(MAX_PAGE_COUNT_IN_DROPDOWN, count($galleryPosts));
          for ($i = 0; $i < $maxCount; $i++):
            $post = $galleryPosts[$i];
          ?>
            <li>
              <a href="<?php echo Common::h($post['url']); ?>">
                <?php echo Common::h($post['title']); ?>
              </a>
            </li>
          <?php endfor; ?>
          <li><a href="/galleryList"><span class="arrow-icon">▶</span>ギャラリー一覧</a></li>
        </ul>
      </li>
    </ul>
  </nav>

<?php
}
?>