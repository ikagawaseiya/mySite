<?php

/**
 * ゲーム記事の全ページにおけるコントローラー
 * ヘッダーの表示の後、ページを表示する
 * TODO ヘッダーは不要かも
 */
class GamePageController
{
  /**
   * @param string $gamePageName 記事のファイル名（拡張子なし）
   */
  public function show(string $gamePageName)
  {
    if (preg_match('/\.\./', $gamePageName)) {
      Common::show404();
    }

    $viewFile = PathGetter::getBlogFilePath() . '/' . $gamePageName . '.php';
    if (file_exists($viewFile)) {
      $this->showHeaderGetTitleFromThePage($viewFile);
      require_once $viewFile;
      exit;
    } else {
      Common::show404();
    }
  }

  /**
   *ページからタイトルを取得し、
   *それによるヘッダーを表示する
   *
   * @param  mixed $viewFile
   * @return void
   */
  private function showHeaderGetTitleFromThePage(string $viewFile)
  {
    $content = file_get_contents($viewFile, false, null, 0, 1024);
    if (preg_match('/\$title\s*=\s*[\'"](.+?)[\'"]\s*;/', $content, $matches)) {
      $title = trim($matches[1]);
    } else {
      $title = ' '; // デフォルトの名前　※通常は取得しない
    }
    if (function_exists('showHeader')) {
      showHeader($title);
    }
  }
}
