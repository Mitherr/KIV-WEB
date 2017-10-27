<?php 

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 1){
     header("Location: index.php");
}

$articles = new articles();
$articles -> Connect();
$articles_data = $articles -> loadAllArticlesAdmin($_SESSION['user']['id'],$_SESSION['user']['rights']);

$users = new users();
$users -> Connect();

$template_params['heading'] = "Vaše články";
$template_params['sloupce'] = " <th>Článek</th>
                                <th>Recenze</th>
                                <th>Změny</th>";


foreach($articles_data as $article){
    
    $reviewBTN = "<a href='index.php?n=postreviews&id=".$article['id_articles']."' class='btn btn-info btn-sm btn-my ' role='button'>Zobrazit Recenze</a>";
    
    $rmvBTN = "<a href='index.php?n=rmvarticle&id=".$article['id_articles']."' class='btn btn-danger btn-sm' role='button'>Smazat</a>";
    
    echo "
    <tr>
    <td>".$article['article_title']."</td>
    <td>".$reviewBTN."</td>
    <td>".$rmvBTN."</td>
    </tr>";   
    
}

$articles -> Disconnect();
$users -> Disconnect();