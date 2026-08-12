<?php
function generateHeader(): array
{
  $blogFilePass = __DIR__ . '/../View/blog';
  $targetFiles = Common::getPhpFilesFromDir($blogFilePass);
  $blogPosts = Common::createArrayNewestPageFirst($targetFiles);
  return $blogPosts;
}
