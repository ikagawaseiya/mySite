<?php
/**
 * ブログ記事を動的に管理・表示するコントローラー
 */
class blogController {
    /**
     * @param string $articleName 記事のファイル名（拡張子なし）
     */
    public function show(string $articleName) {
        // 安全対策: 不正なパス（../../など）が含まれている場合は404
        if (preg_match('/\.\./', $articleName)) {
            $this->show404();
        }

        // 表示させたいブログファイルの絶対パス
        $viewFile = __DIR__ . '/../View/blog/' . $articleName . '.php';

        if (file_exists($viewFile)) {
            // 共通ヘッダーを表示（必要に応じて）
            if (function_exists('showHeader')) {
                showHeader('ブログ');
            }

            // ブログ本文（Hello, World!など）を読み込んで表示
            require_once $viewFile;
            exit;
        } else {
            $this->show404();
        }
    }

    private function show404() {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>指定されたブログ記事が見つかりません。";
        exit;
    }
}