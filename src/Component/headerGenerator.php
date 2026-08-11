<?php 
function generateHeader() : array {
  // 自動収集したブログ記事を格納する配列
  $blogPosts = [];

  // ブログファイルが保存されているフォルダ
  $blogDir = __DIR__ . '/../View/blog'; 

  // フォルダが存在する場合のみ処理
  if (is_dir($blogDir)) {
    // フォルダ内の .php ファイルをすべて取得
    $files = glob($blogDir . '/*.php');
    if ($files === false) {
      return [];
    }
    
    foreach ($files as $file) {
      // ファイルの中身を最初の1024バイトだけ読み込む
      $content = file_get_contents($file, false, null, 0, 1024);
      
      // コメント欄から タイトル と 日時 を正規表現で抽出
      preg_match('/@title\s+(.+)/', $content, $titleMatch);
      preg_match('/@date\s+(.+)/', $content, $dateMatch);
      
        if (!empty($titleMatch[1]) && !empty($dateMatch[1])) {
        // 拡張子を取り除いたファイル名を取得（firstPage.php -> firstPage）
        $slug = pathinfo($file, PATHINFO_FILENAME);

        $blogPosts[] = [
          'title' => trim($titleMatch[1]),
          'date'  => trim($dateMatch[1]),
          'url'   => '/public/blog/' . $slug 
        ];
      }
    }

    // 日付の新しい順に並び替える処理
    usort($blogPosts, function($a, $b) {
      return strtotime($b['date']) <=> strtotime($a['date']);
    });
  } 
  return $blogPosts;
}
?>