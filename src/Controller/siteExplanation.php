<?php

/**
 *このサイトについてページのコントローラー
 */

class siteExplanationController
{
  /**
   * このサイトについてページに渡す値を宣言し、viewを呼び出す
   *
   * 渡す値:
   * ・ページ名
   * ・ページに用いるCSSのパス
   * @return void
   */
  public function show()
  {
    $siteTitle = "このサイトについて";
    $cssPaths = ["/public/css/siteExplanation.css"];
    require_once __DIR__ . '/../View/siteExplanation/siteExplanation.php';
  }
}
