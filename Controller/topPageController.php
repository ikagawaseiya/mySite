<?php
require_once 'Model/Profile.php';
/**
 * トップページのコントローラー
 */
class topPageController {
  /**
   * トップページに渡す値を宣言し、
   * トップページを表示する
   */
    public function show() {
        $profileModel = new Profile();
        $data = $profileModel->getName();
        require_once 'View/topPageView.php';
    }
}