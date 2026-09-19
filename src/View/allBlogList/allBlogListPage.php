<?php

/**
 * @var string $titleInHtml HTMLのtitleに入れるタイトル
 * @var string $pageTitle 
 * @var array $blogPosts 新着順のブログページ一覧
 */
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo Common::h($titleInHtml); ?></title>
  <link rel="stylesheet" href="/public/css/topPage.css">
</head>

<body>
  <div>
    <main class="main-content">
      <h1><?php echo Common::h($pageTitle); ?></h1>
      <?php
      $DisplayingMonth = '';
      $isDisplayed = false;
      foreach ($blogPosts as $post):
        $isDisplayed = $DisplayingMonth !== '';
        $postMonth = date('Y年m月', strtotime($post['date']));
        $isDisplayingUpdate = $DisplayingMonth !== $postMonth;

        if ($isDisplayingUpdate):

          if ($isDisplayed): ?>
            </ul>
          <?php endif; ?>

          <h2><?php echo Common::h($postMonth); ?></h2>
          <ul>
          <?php
          $DisplayingMonth = $postMonth;
        endif;

          ?>
          <li>
            <a href="<?php echo Common::h($post['url']); ?>">
              <?php echo Common::h($post['title']); ?>
            </a>
          </li>

        <?php endforeach; ?>

        <?php if ($isDisplayed): ?>
          </ul>
        <?php endif; ?>
    </main>
  </div>
  <?php showFooter(); ?>