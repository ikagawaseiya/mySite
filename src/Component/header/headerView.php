  <?php
  /**
   * 共通ヘッダーを表示する
   *
   * ハンバーガーメニューによって、以下のボタンを表示する
   * ・トップページ
   * ・ゲーム（TODO　追加予定）
   * ・ブログ
   * ・ギャラリー
   *
   * @var string $displayHeaderTitle 表示するタイトル
   * @var array $blogPosts 新着順のブログ配列
   * @var array $galleryPosts 新着順のギャラリー配列
   */
  ?>
  <link rel="stylesheet" href="/public/css/header.css">
  <header class="site-header">
    <div class="header-text">
      <?php echo Common::h($displayHeaderTitle); ?>
    </div>

    <!-- ハンバーガーボタン -->
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

          <li>
            <?php echo displayDropdownLinksHtml($blogPosts); ?>
          </li>

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

          <li>
            <?php echo displayDropdownLinksHtml($galleryPosts); ?>
          </li>

          <li><a href="/galleryList"><span class="arrow-icon">▶</span>ギャラリー一覧</a></li>
        </ul>
      </li>
    </ul>
  </nav>