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
    <h2><a href="/">トップページ </a></h2>
    管理人のプロフィールがあります。SNS / LINEスタンプ / ソースコードへのリンクはこちらから。
    <h2><a href="/gameList">ゲーム</a></h2>
    管理人が制作したゲームを遊ぶことができます。
    <h2><a href="/blogList">ブログ</a></h2>
    管理人のブログです。当サイトに変更があった場合、その告知もこちらで行います。
    <h2><a href="/galleryList">ギャラリー</a></h2>
    うーちゃんの写真を掲載しています。うさぎをお求めの方はこちらへどうぞ。<br>
    古いものから投稿を進める予定です。
  </div>
</main>

<?php showFooter(); ?>