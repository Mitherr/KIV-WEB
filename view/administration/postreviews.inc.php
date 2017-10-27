<?php 

global $template_params;

include 'view/administration/navigation.inc.php';


if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

$id = @$_REQUEST["id"];

if(!is_numeric($id )){
    header("Location: index.php?p=404");
}



$reviews = new reviews();
$reviews -> Connect();

$users = new users();
$users -> Connect();


$articles = new articles();
$articles -> Connect();

$test_article = $articles -> loadArticle($id);
$test_author = $users -> loadUserid($test_article["users_id_user"]);


if($test_author['id_user'] != $_SESSION['user']['id'] && $_SESSION['user']['rights'] != 3){
    header("Location: index.php");
}


$reviews_data = $reviews -> loadAllReviews($id);

$template_params['heading'] = "Recenze";
$template_params['sloupce'] = " <th>Autor recenze</th>
                                <th>Článek</th>
                                <th>Obsah</th>
                                <th>Originalita</th>
                                <th>Téma</th>
                                <th>Kvalita</th>
                                <th>Poslední úprava</th>";

foreach($reviews_data as $review){
    
    $reviewer = $users -> loadUserid($review["users_id_user"]);
    $article = $articles -> loadArticle($review["articles_id_articles"]);
    
    
    echo "
    <tr>
    <td>".$reviewer["user_name"]."</td>
    <td><small>".$article["article_title"]."</small></td>
    <td><small>".$review["review_text"]."</small></td>
    <td>".$review["review_originality"]."</td>
    <td>".$review["review_theme"]."</td>
    <td>".$review["review_quality"]."</td>
    <td>".$review["review_date"]."</td>  
    </tr>
    
    
    ";
        
    
}

$reviews -> Disconnect();
$articles -> Disconnect();
$users -> Disconnect();