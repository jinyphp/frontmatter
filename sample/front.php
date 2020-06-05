<?php
// 컴포저 로드
require "../../../autoload.php";
$content = file_get_contents("test.php.html");
echo $content;

$body = \jiny\frontMatter($content);
var_dump($body);