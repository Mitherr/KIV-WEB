<?php

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 3){
     header("Location: index.php");
}

$id = $_SESSION['user']['id'];
$rights = $_SESSION['user'] ['rights'];    

$articles = new articles();
$articles -> Connect();
$articles_data = $articles -> loadAllArticlesAdmin($id,$rights);

$users = new users();
$users -> Connect();
$user_data = $users -> loadAllReviewers();

$select1 = "";

foreach($articles_data as $article){
    $select1 .= "<option value ='".$article['id_articles']."'>".$article['article_title']."</option>";
}

$select2 = "";

foreach($user_data as $user){
    $select2 .= "<option value='".$user['id_user']."'>".$user['user_name']."</option>";
}



$template_params["select1"] = $select1;
$template_params["select2"] = $select2;

$users -> Disconnect();
$articles -> Disconnect();
    

if(isset($_POST['article'])){  
                
$reviews = new reviews();
$reviews -> Connect();

$article = $_POST['article'];
$reviewers  = $_POST['reviewers'];
foreach ($reviewers as $reviewer) {
$rev_data = $reviews -> addReview($reviewer, $article);
if (!isset($rev_data)) {
$errormsg = "Nepovedlo se přidat recenzi";
}
}
if (!isset($errormsg)) {
    header("Location: index.php?n=reviewsadm");
 }
$reviews -> Disconnect();
}
            

?>