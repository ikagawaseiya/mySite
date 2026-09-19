<?php

/**
 * ゲーム記事の全ページにおけるコントローラー
 * ゲームのページを表示する
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

    $viewFile = PathGetter::getGameFilePath() . '/' . $gamePageName . '.php';
    if (file_exists($viewFile)) {
      require_once $viewFile;
      exit;
    } else {
      Common::show404();
    }
  }
}
