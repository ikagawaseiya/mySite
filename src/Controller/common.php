<?php

/**
 * 共通で使う関数をまとめたクラス
 */
class Common
{
    /**
     * サイト名を返す
     *
     * @return string サイト名
     */
    public static function getSiteName(): string
    {
        $siteName = SITE_NAME;
        return $siteName;
    }

    /**
     * htmlspecialcharsにより、文字列を変換する
     * それを返す
     * 
     * @param string $str 変換する文字列
     * @return string 変換後の文字列
     */
    public static function h(String $str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    /**
     * 404ページを表示する
     */
    public static function show404()
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>ページが見つかりません。";
        exit;
    }

    /**
     * ページタイトルと作成日時を受け取り、
     * 繋げたものを返す
     * 
     * ヘッダーに用いる
     * 
     * @param string $title ページタイトル
     * @param string $date 日時
     * @return string タイトルと作成日時を繋げた文字列　"ページタイトル 作成日時"
     */
    public static function generateDisplayTitleAndDate(String $title, String $date)
    {
        return $title . "   "  . $date;
    }

    /**
     * タイトルを、HTMLのタイトルで表示する書式とする
     * ページタイトルを受け取り、サイト名を付けて返す
     * 
     * ブラウザで表示されるページに用いる
     */
    public static function getHtmlPageTitle(string $title)
    {
        return Common::getSiteName() . "-" . $title;
    }

    /**
     * ページのpathを格納した配列を受け取り、
     * そのすべてのページからタイトルと作成日時を取得する。
     * その後、それを新着順にした配列を作成する。
     * それを返す。
     * 書式例:($files = __DIR__ . '/../View/blog';)
     * 
     * @param array $files ページ種別の保存されたフォルダ
     * @return  array 受け取った種別のページを新着順に格納したリスト
     */
    public static function createArrayNewestPageFirst(array $files): array
    {
        // 自動収集したページを格納する配列
        $posts = [];
        foreach ($files as $file) {
            $content = file_get_contents($file, false, null, 0, 1024);

            $titleMatch = [];
            $dateMatch  = [];
            preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $content, $titleMatch);
            preg_match('/\$date\s*=\s*[\'"](.+?)[\'"]\s*;/', $content, $dateMatch);

            if (!empty($titleMatch[1]) && !empty($dateMatch[1])) {
                $slug = pathinfo($file, PATHINFO_FILENAME);

                $posts[] = [
                    'title' => trim($titleMatch[1]),
                    'date'  => trim($dateMatch[1]),
                    'url'   => '/blog/' . $slug
                ];
            }
        }

        $posts = Common::sortByDateDesc($posts);
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
        $targetFiles = Common::getPhpFilesFromDir($filePass);
        $blogPosts = Common::createArrayNewestPageFirst($targetFiles);
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
            // 日付をタイムスタンプに変換して比較（<=> は宇宙船演算子）
            return strtotime($b['date']) <=> strtotime($a['date']);
        });
        return $posts;
    }

    /**
     * 指定されたフォルダ内のすべてのPHPファイルパスを取得する
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

        // 末尾のシャッシュの有無を考慮してパスを結合
        $pattern = rtrim($dirPath, '/') . '/*.php';
        $files = glob($pattern);

        // globが失敗（false）した場合は空配列を返す
        return $files === false ? [] : $files;
    }

    /**
     * Controllerの位置から見た、ブログファイルへのpathを返す
     *
     * @return String Controllerの位置から見た、ブログファイルへのpath
     */
    public static function getBlogFilePathFromController()
    {
        return __DIR__ . '/../View/blog';
    }
}
