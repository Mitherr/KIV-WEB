<?php 

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 3){
     header("Location: index.php");
}

$articles = new articles();
$articles -> Connect();
$articles_data = $articles -> loadAllArticlesAdmin($_SESSION['user']['id'],$_SESSION['user']['rights']);

$users = new users();
$users -> Connect();

$template_params['heading'] = "Všechny články";
$template_params['sloupce'] = " <th>id</th>
                                <th>Článek</th>
                                <th>Autor</th>
                                <th>Recenze</th>
                                <th>Změny</th>";

foreach($articles_data as $article){
    
    $user = $users->loadUserid($article['users_id_user']);
    $username = $user["user_name"];
    
    if($article['article_published']){
        
    $publishBTN ="<a href='index.php?n=publish&id=".$article['id_articles']."' class='btn btn-danger btn-sm' role='button'>Skrýt</a>";
        
    }
    
    else{
        
    $publishBTN = "<a href='index.php?n=publish&id=".$article['id_articles']."' class='btn btn-success btn-sm' role='button'>Publikovat</a> ";
        
    }
    
    $reviewsBTN = "<a href='index.php?n=postreviews&id=".$article['id_articles']."' class='btn btn-info btn-sm btn-my ' role='button'>Zobrazit Recenze</a>";
    
    $showBTN = "<a href='index.php?n=article&id=".$article['id_articles']."' class='btn btn-info btn-sm btn-my' role='button'>Zobrazit</a>";
    
    $deleteBTN = "<a href='index.php?n=rmvarticle&id=".$article['id_articles']."' class='btn btn-danger btn-sm' role='button'>Smazat</a>";
    
    echo "
    <tr>
    <td>".$article['id_articles']."</td>
    <td>".$article['article_title']."</td>
    <td>".$username."</td>
    <td>".$reviewsBTN."</td>
    <td>".$publishBTN."</td>
    <td>".$showBTN."</td>  
    <td>".$deleteBTN."</td>
    </tr>";   
    
}
  
$articles -> Disconnect();
$users -> Disconnect();

?>