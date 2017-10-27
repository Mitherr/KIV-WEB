<?php 

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 3){
     header("Location: index.php");
}

$reviews = new reviews();
$reviews -> Connect();
$rev_data = $reviews -> loadAllReviewsAdmin($_SESSION['user']['id'],$_SESSION['user']['rights']);

$users = new users();
$users -> Connect();

$articles = new articles();
$articles -> Connect();

$template_params['heading'] = "Všechny recenze";
$template_params['sloupce'] = " <th>id</th>
                                <th>Autor recenze</th>
                                <th>Článek</th>
                                <th>Obsah</th>
                                <th>Originalita</th>
                                <th>Téma</th>
                                <th>Kvalita</th>
                                <th>Poslední úprava</th>
                                <th>Změny</th>";

foreach($rev_data as $review){
    
    $reviewer = $users -> loadUserid($review["users_id_user"]);
    $article = $articles -> loadArticle($review["articles_id_articles"]);
    
    if($review['review_locked'] == 0){
       $lockBTN = "<a href='index.php?n=lockrev&id=".$review["id_review"]."' class='btn btn-danger btn-sm' role='button'>Uzamknout</a>";
    }
    else{
        $lockBTN = "<a href='index.php?n=lockrev&id=".$review["id_review"]."' class='btn btn-success btn-sm' role='button'>Odemknout</a>";
    }
        
    
    $deleteBTN = "<a href='index.php?n=rmvreview&id=".$review["id_review"]."' class='btn btn-danger btn-sm' role='button'>Smazat</a>";
    
    
    echo "
    <tr>
    <td>".$review["id_review"]."</td>
    <td>".$reviewer["user_name"]."</td>
    <td><small>".$article["article_title"]."</small></td>
    <td><small>".$review["review_text"]."</small></td>
    <td>".$review["review_originality"]."</td>
    <td>".$review["review_theme"]."</td>
    <td>".$review["review_quality"]."</td>
    <td>".$review["review_date"]."</td>
    <td>".$lockBTN."</td>
    <td>".$deleteBTN."</td>  
    </tr>
        ";
}

$users -> Disconnect();
$articles -> Disconnect();
$reviews -> Disconnect();