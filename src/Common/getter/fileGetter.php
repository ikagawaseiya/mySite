<?php

/**
 * ファイル取得に関係する関数を扱うクラス
 * 
 * ファイルまたは、
 * そのファイルに設定されたデータ（タイトル、日時、URL）を取得する
 */
class FileGetter
{
  /**
   * 対象フォルダへのパスを受け取り、
   * そのフォルダ内の記事のデータ（パス、タイトル、日時）を最新順に並べた配列を返す
   * passの書式例:"__DIR__ . '/../View/blog';"
   *
   * @param  mixed $filePath フォルダへのパス 書式例:"__DIR__ . '/../View/blog';"
   * @return array フォルダ内のページのdate(パス、タイトル、日時)を最新順に並べたもの
   */
  public static function getArrayNewestPageFirst($filePath): array
  {
    $targetFiles = FileGetter::getPhpFilesFromDir($filePath);
    $NewestPageFirstPosts = FileGetter::createArrayNewestPageFirst($targetFiles);
    return $NewestPageFirstPosts;
  }

  /**
   * ページのパスを格納した配列を受け取り、
   * そのすべてのページからタイトル、作成日時、URLを取得する。
   * その後、それを新着順にした配列を作成する。
   * それを返す。
   * 
   * @param array $files ページのパスが格納された配列
   * @return  array 受け取った配列のページの内容（タイトル、日時、URL）を新着順に格納した配列
   */
  public static function createArrayNewestPageFirst(array $files): array
  {
    $returnPosts = [];
    foreach ($files as $file) {
      $postData = FileGetter::getFileTitleDateUrl($file);
      if ($postData !== null) {
        $returnPosts[] = $postData;
      }
    }

    $returnPosts = FileGetter::sortByDateDesc($returnPosts);
    return $returnPosts;
  }

  /**
   * 単一のファイルのパスからタイトル、日時、URLを取得する
   * それを返す
   *
   * @param string $file ファイルの絶対パス
   * @return array 連想配列 タイトル 日時 URL
   */
  public static function getFileTitleDateUrl(string $file): ?array
  {
    $pageContent = file_get_contents($file, false, null, 0, 1024);

    $titleMatch = [];
    $dateMatch  = [];
    preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $pageContent, $titleMatch);
    preg_match('/\$date\s*=\s*[\'"](.+?)[\'"]\s*;/', $pageContent, $dateMatch);

    if (!empty($titleMatch[1]) && !empty($dateMatch[1])) {
      $normalizedPath = str_replace('\\', '/', $file);

      $afterViewPath = strstr($normalizedPath, '/View/');
      $relativePath = str_replace('/View/', '', $afterViewPath);

      $urlPath = str_replace('.php', '', $relativePath);
      return [
        'title' => trim($titleMatch[1]),
        'date'  => trim($dateMatch[1]),
        'url'   => '/' . $urlPath
      ];
    }

    echo "エラー：getFileTitleDateUrl";
    return null;
  }

  /**
   * 記事の配列を日付の新しい順（降順）にソートする
   *
   * @param array $posts ソート前のブログ記事配列
   * @return array ソート後のブログ記事配列
   */
  public static function sortByDateDesc(array $posts): array
  {
    usort($posts, function ($i, $j) {
      return strtotime($j['date']) <=> strtotime($i['date']);
    });
    return $posts;
  }

  /**
   * フォルダのパスを受け取り、そのファイル及び、二つ下までの階層のPHPファイルを全て配列に格納する
   * それを返す
   *
   * @param string $dirPath 対象のフォルダパス
   * @return string[] ファイルパスの配列（失敗または存在しない場合は空配列）
   */
  public static function getPhpFilesFromDir(string $dirPath): array
  {
    if (!is_dir($dirPath)) {
      echo "エラー：getPhpFilesFromDir";
      return [];
    }

    $basePath = rtrim($dirPath, '/');

    $directFiles = glob($basePath . '/*.php');
    if ($directFiles === false) {
      $directFiles = [];
    }

    /**一つ下 */
    $oneDownFiles = glob($basePath . '/*/*.php');
    if ($oneDownFiles === false) {
      $oneDownFiles = [];
    }

    /**二つ下 */
    $twoDownFiles = glob($basePath . '/*/*/*.php');
    if ($twoDownFiles === false) {
      $twoDownFiles = [];
    }

    return array_merge($directFiles, $oneDownFiles, $twoDownFiles);
  }

  /**
   * 指定されたフォルダ内の画像ファイルパスをすべて取得する
   *
   * @param string $dirPath 収集対象のフォルダ名
   * @return array フォルダ内の画像パスの配列
   */
  public static function getImageFilePathsFromDir(string $dirPath): array
  {
    $dirPath = rtrim($dirPath, '/') . '/';
    $images = glob($dirPath . '*.{jpg,jpeg,png,gif,JPG,JPEG,PNG,GIF}', GLOB_BRACE);
    return $images ? $images : [];
  }
}
