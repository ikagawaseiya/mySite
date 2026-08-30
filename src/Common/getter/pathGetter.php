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
  public static function getBlogFilePathFromController()
  {
    return __DIR__ . '/../../View/blog';
  }

  /**
   * ギャラリーフォルダへのpathを返す
   *
   * @return String ギャラリーフォルダへのパス
   */
  public static function getGalleryFilePathFromController()
  {
    return __DIR__ . '/../../View/gallery';
  }

  /**
   * ゲームフォルダへのpathを返す
   *
   * @return String ギャラリーフォルダへのパス
   */
  public static function getGameFilePathFromController()
  {
    return __DIR__ . '/../../View/game';
  }
}
