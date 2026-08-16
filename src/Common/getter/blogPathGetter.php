<?php
class BlogPathGetter
{
  /**
   * ブログファイルへのpathを返す
   *
   * @return String ブログファイルへのpath
   */
  public static function getBlogFilePathFromController()
  {
    return __DIR__ . '/../../View/blog';
  }
}
