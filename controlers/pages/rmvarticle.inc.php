<?php

$id = @$_REQUEST["id"];

if (!isset($_SESSION['user'])) {
    header("Location: index.php?p=404");
}

if(!is_numeric($id)){
    header("Location: index.php?p=404");
}

$rights = $_SESSION['user']['rights'];

$articles = new articles();
$articles -> Connect();
$artlice_data = $articles -> loadArticle($id);
if ($article_data["users_user_id"] != $_SESSION["user"]["id"] || $rights != 3  ) {
  header("Location: index.php?p=404");
}
$articles->removeArticle($id);

if($rights != 3){
header("Location: index.php?n=myarticles");
}
else{
header("Location: index.php?n=articlesadm");
}