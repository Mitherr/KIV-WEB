<?php

$id = @$_REQUEST["id"];

if (!isset($_SESSION['user'])) {
    header("Location: index.php?p=404");
}

if(!is_numeric($id )){
    header("Location: index.php?p=404");
}

$rights = $_SESSION['user']['rights'];

if ($rights != "3") {
  header("Location: index.php?p=404");
}

$articles = new articles();
$articles->Connect();
$article_data = $articles->loadArticle($id);
$value = 0;
if($article_data['article_published']== 0){
    $value = 1;
}
$articles -> upPublished($id,$value);

header("Location: index.php?n=articlesadm")




?>