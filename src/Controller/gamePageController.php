<?php

/**
 * ゲーム記事の全ページにおけるコントローラー
 * ヘッダーの表示の後、ページを表示する
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
      require_once $viewFile;
      exit;
    } else {
      Common::show404();
    }
  }
}
