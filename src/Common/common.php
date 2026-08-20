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
  public static function getTitleInHtml(string $title)
  {
    return Common::getSiteName() . "-" . $title;
  }
}
