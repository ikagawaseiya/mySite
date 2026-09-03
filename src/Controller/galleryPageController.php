<?php

/**
 * ギャラリー記事の全ページにおけるコントローラー
 * ヘッダーの表示の後、ページを表示する
 */
class GalleryPageController
{
  /**
   * @param string $galleryPageName 記事のファイル名（拡張子なし）
   */
  public function show(string $galleryPageName)
  {
    if (preg_match('/\.\./', $galleryPageName)) {
      $this->show404();
    }

    $viewFile = PathGetter::getGalleryFilePath() . '/' . $galleryPageName . '.php';
    if (file_exists($viewFile)) {
      $pageTitle = $this->getGalleryPageTitle($viewFile);
      if (function_exists('showHeader')) {
        showHeader($pageTitle);
      }
      require_once $viewFile;
      exit;
    } else {
      echo "error:controller";
      Common::show404();
    }
  }


  private function show404()
  {
    header("HTTP/1.0 404 Not Found");
    echo "<h1>404 Not Found</h1>指定されたギャラリー記事が見つかりません。";
    exit;
  }

  /**
   *ギャラリーのページ名を取得し、それを返す
   *
   * @param  string $viewFile 表示するファイルのパス
   * @return string ページタイトル 
   */
  private function getGalleryPageTitle(string $viewFile): string
  {
    $content = file_get_contents($viewFile, false, null, 0, 1024);
    if (preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $content, $matches)) {
      $title = trim($matches[1]);
    } else {
      $title = ' '; // デフォルトの日時 ※通常は取得しない
    }
    return $title;
  }

  /**
   * 指定したディレクトリ内にある、画像を全て表示する
   *
   * @param string $galleryDirName 画像ディレクトリの名前
   * @return void
   */
  public static function showAllGalleryFromDir(string $galleryDirName)
  {
?>
    <?php
    $galleryFilePath = "images/gallery/" . $galleryDirName;
    $images = FileGetter::getImageFilePathsFromDir($galleryFilePath);
    ?>
    <?php foreach ($images as $key => $imagePath): ?>
      <div>
        <img class="gallery-image" src="/<?php echo Common::h($imagePath); ?>" alt="<?php echo $key; ?>" loading="lazy">
      </div>
    <?php endforeach; ?>
  <?php
  }

  /**
   * ギャラリーのheadを表示する
   *
   * @param string $title ページのタイトル
   * @return void
   */
  public function displayGalleryHead(string $title)
  {
    $displayTitle = Common::getTitleInHtml($title);
  ?>
    <!DOCTYPE html>
    <html lang="ja">

    <div class="footerFixed">

      <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?php echo Common::h($displayTitle); ?></title>
        <link rel="stylesheet" href="/public/css/gallery.css">
      </head>

      <body>
    <?php
  }
}
