<?php

/**
 * 対象フォルダへのパスを返すクラス
 */
class PathGetter
{
  /**
   * ブログフォルダへのパスを返す
   *
   * @return String ブログフォルダへのパス
   */
  public static function getBlogFilePath()
  {
    return __DIR__ . '/../../View/blog';
  }

  /**
   * ギャラリーフォルダへのpathを返す
   *
   * @return String ギャラリーフォルダへのパス
   */
  public static function getGalleryFilePath()
  {
    return __DIR__ . '/../../View/gallery';
  }

  /**
   * ゲームフォルダへのpathを返す
   *
   * @return String ギャラリーフォルダへのパス
   */
  public static function getGameFilePath()
  {
    return __DIR__ . '/../../View/game';
  }
}
