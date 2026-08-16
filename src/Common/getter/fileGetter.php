<?php
class FileGetter
{
  /**
   * ページのpathを格納した配列を受け取り、
   * そのすべてのページからタイトル、作成日時、URLを取得する。
   * その後、それを新着順にした配列を作成する。
   * それを返す。
   * 引数例:($files = __DIR__ . '/../View/blog';)
   * 
   * ※現在はブログのみ対応
   * ※ループ処理を上で行いたいので、後に直す
   * 
   * @param array $files ページ種別の保存されたフォルダ
   * @return  array 受け取った種別のページを新着順に格納したリスト
   */
  public static function createArrayNewestPageFirst(array $files): array
  {
    // 自動収集したページを格納する配列
    $posts = [];
    foreach ($files as $file) {
      $pageContent = file_get_contents($file, false, null, 0, 1024);

      $titleMatch = [];
      $dateMatch  = [];
      preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $pageContent, $titleMatch);
      preg_match('/\$date\s*=\s*[\'"](.+?)[\'"]\s*;/', $pageContent, $dateMatch);

      if (!empty($titleMatch[1]) && !empty($dateMatch[1])) {

        $normalizedPath = str_replace('\\', '/', $file);
        $afterBlogPath = strstr($normalizedPath, '/View/blog/');
        $blogFileName = str_replace(['/View/blog/', '.php'], '', $afterBlogPath);

        $posts[] = [
          'title' => trim($titleMatch[1]),
          'date'  => trim($dateMatch[1]),
          'url'   => '/blog/' . $blogFileName  // 書式: "/blog/26-07/ファイル名"
        ];
      }
    }

    $posts = FileGetter::sortByDateDesc($posts);
    return $posts;
  }


  /**
   * 対象フォルダへのpathを受け取り、
   * そのフォルダ内の記事のpathを新着順に並べた配列を返す
   * passの書式例:"__DIR__ . '/../View/blog';"
   *
   * @param  mixed $filePass フォルダへのパス 書式例:"__DIR__ . '/../View/blog';"
   * @return array フォルダ内のページへのパスを新着順に並べたもの
   */
  public static function getArrayNewestPageFirst($filePass): array
  {
    $targetFiles = FileGetter::getPhpFilesFromDir($filePass);
    $blogPosts = FileGetter::createArrayNewestPageFirst($targetFiles);
    return $blogPosts;
  }


  /**
   * 記事の配列を日付の新しい順（降順）にソートする
   *
   * @param array $posts ソート前のブログ記事配列
   * @return array ソート後のブログ記事配列
   */
  public static function sortByDateDesc(array $posts): array
  {
    usort($posts, function ($a, $b) {
      return strtotime($b['date']) <=> strtotime($a['date']);
    });
    return $posts;
  }


  /**
   * フォルダのパスを受け取り、そのファイル及び、一つ下の階層のPHPファイルを全て配列に格納する
   * それを返す
   *
   * @param string $dirPath 対象のフォルダパス
   * @return string[] ファイルパスの配列（失敗または存在しない場合は空配列）
   */
  public static function getPhpFilesFromDir(string $dirPath): array
  {
    // フォルダが存在しない、またはフォルダではない場合は空配列を返す
    if (!is_dir($dirPath)) {
      return [];
    }

    $basePath = rtrim($dirPath, '/');

    $directFiles = glob($basePath . '/*.php');
    if ($directFiles === false) {
      $directFiles = [];
    }

    /**一つ下 */
    $subFiles = glob($basePath . '/*/*.php');
    if ($subFiles === false) {
      $subFiles = [];
    }

    return array_merge($directFiles, $subFiles);
  }
}
