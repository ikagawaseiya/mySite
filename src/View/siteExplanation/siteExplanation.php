<?php

/**
 * @var string $pageTitle ページ名
 * @var array $cssPaths ページごとに付与する、CSSの配列
 */

?>

<?php showHeader($pageTitle, $cssPaths) ?>

<main>
  <div class="main-content">
    <h1>このサイトについて</h1>
    当サイトは、我が家のうさぎ「うーちゃん」の記録、及び管理人の創作物置き場として設立されました。<br>
    以下の項目が存在します。
    <a href="/gameList">
      <h2>ゲーム</h2>
    </a>
    管理人が制作したゲームを遊ぶことができます。
    <a href="/blogList">
      <h2>ブログ</h2>
    </a>
    管理人のブログです。当サイトに変更があった場合、その告知もこちらで行います。
    <a href="/galleryList">
      <h2>ギャラリー</h2>
    </a>
    うーちゃんの写真を掲載しています。うさぎをお求めの方はこちらへどうぞ。<br>
    古いものから投稿を進める予定です。
  </div>

</main>

<?php showFooter(); ?>