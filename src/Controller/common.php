<?php

/**
 * 共通で使う関数をまとめたクラス
 */
class Common
{

    /**
     * htmlspecialcharsにより、文字列を変換する
     * それを返す
     * 
     * @param string $str 変換する文字列
     * @return string 変換後の文字列
     */
    public static function h(string $str)
    {
        return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
    }

    /**
     * 404ページを表示する。
     */
    public static function show404()
    {
        header("HTTP/1.0 404 Not Found");
        echo "<h1>404 Not Found</h1>ページが見つかりません。";
        exit;
    }
}
