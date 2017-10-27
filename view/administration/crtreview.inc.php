<?php

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php?p=404");
}

$id = @$_REQUEST["id"];

$reviews = new reviews();
$reviews -> Connect();
$rev_data = $reviews -> loadReview($id);

if ($rev_data['users_id_user'] != $_SESSION['user']['id']) {
    header("Location: index.php?p=404");
}

if ($rev_data['review_locked'] == 1) {
    header("Location: index.php?p=404");
}

$articles = new articles();
$articles -> Connect();
$article_data = $articles -> loadArticle($rev_data['articles_id_articles']);


$review = "".$article_data['article_title'];

$reviewBTN = "<a href='index.php?n=article&id=".$article_data['id_articles']."' class='btn btn-info btn-my btn-sm' role='button'>Zobrazit</a>";

$template_params['review'] = $review;
$template_params['reviewBTN'] = $reviewBTN;

$articles -> Disconnect();
    
if (isset($_POST['review'])){
     

 $review = htmlspecialchars($_POST['review'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
    
$reviews -> upText($id,$review);   
$reviews -> upOriginality($id,$_POST['originality']);
$reviews -> upTheme($id,$_POST['theme']);
$reviews -> upQuality($id,$_POST['quality']);
    
header("Location: index.php?n=myreviews");
    
}


$reviews -> Disconnect();

?>