<?php 

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 2){
     header("Location: index.php");
}

$reviews = new reviews();
$reviews -> Connect();
$rev_data = $reviews -> loadAllReviewsAdmin($_SESSION['user']['id'],$_SESSION['user']['rights']);

$users = new users();
$users -> Connect();

$articles = new articles();
$articles -> Connect();

$template_params['heading'] = "Vaše renzenze";
$template_params['sloupce'] = " <th>Článek</th>
                                <th>Obsah</th>
                                <th>Originalita</th>
                                <th>Téma</th>
                                <th>Kvalita</th>
                                <th>Poslední úprava</th>
                                <th>Uzamčeno</th>  
                                <th>Změny</th>";

foreach($rev_data as $review){
    
    $reviewer = $users->loadUserid($review["users_id_user"]);
    $article = $articles->loadArticle($review["articles_id_articles"]);
    
    $changeBTN = "";
    
    if($review['review_locked'] == 0){
        
       $locked = "NE";
        
       $changeBTN .= "<td><a href='index.php?n=crtreview&id=".$review["id_review"]."' class='btn btn-info btn-sm btn-my' role='button'>Změnit</a></td>";       
    }
    else{
        
        $locked = "ANO";
        
    }
    
    $deleteBTN = "<a href='index.php?n=rmvreview&id=".$review["id_review"]."' class='btn btn-danger btn-sm' role='button'>Smazat</a>";
    
    
    echo "
    
    <tr>
    <td><small>".$article["article_title"]."</small></td>
    <td><small>".$review["review_text"]."</small></td>
    <td>".$review["review_originality"]."</td>
    <td>".$review["review_theme"]."</td>
    <td>".$review["review_quality"]."</td>
    <td>".$review["review_date"]."</td>
    <td>".$locked."</td>
        ".$changeBTN."
    <td>". $deleteBTN."</td>
    </tr>
    
    
    ";    
    
}

$reviews -> Disconnect();
$users -> Disconnect();
$articles -> Disconnect();