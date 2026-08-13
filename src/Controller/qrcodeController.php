<?php

/**
 * QRコードページのコントローラー
 */
class QrcodePageController
{
  /**
   * Qrcodeページに渡す値を宣言し、viewを呼び出す
   * 
   * 渡す値:ページ名
   */
  public function show()
  {
    $pageTitle = "QRコード";
    showHeader($pageTitle);
    $htmlTitle = Common::getHtmlPageTitle($pageTitle);
    require_once __DIR__ . '/../View/qrcodePage.php';
  }
}
