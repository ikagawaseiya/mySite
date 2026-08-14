<?php
//現在はブログページの最新順を返すのみ実装
function getArrayNewestBlogPageFirst(): array
{
  $blogFilePass = __DIR__ . '/../View/blog';
  $targetFiles = Common::getPhpFilesFromDir($blogFilePass);
  $blogPosts = Common::createArrayNewestPageFirst($targetFiles);
  return $blogPosts;
}
