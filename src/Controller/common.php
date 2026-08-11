<?php
/**
 * 共通で使う関数をまとめたクラス
 */
class Common{

/**
 * htmlspecialcharsにより、文字列を変換する
 * それを返す
 * 
 * @param string $str 変換する文字列
 * @return string 変換後の文字列
 */
public static function h(string $str){
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}
}
?>