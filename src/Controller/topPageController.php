<?php
require_once __DIR__ . '/../Model/Profile.php';
/**
 * トップページのコントローラー
 */
class topPageController {
  /**
   * トップページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:ページ名
   * 
   */
    public function show() {
    $pageTitle = "トップページ";
    showHeader($pageTitle);
    require_once __DIR__ . '/../View/topPageView.php';
}
}