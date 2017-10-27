
<?php

$articles = new articles();
$articles->Connect();
$users = new users();
$users->Connect();

$article_data = $articles->loadAllArticles();

echo "<h1 class = text-center style='color:white;' >Publikované příspěvky</h1>";

if(empty($article_data)){
    echo '
    
    <div class="container text-center">
    <h2 style="color:white;">Bohužel momentálně nejsou žádné publikované příspěvky</h2>
    </div>
    
    ';
}


foreach($article_data as $article){
    
$user_data = $users -> loadUserid($article["users_id_user"]); 
    

echo'

<div class="container-fluid">
<div class="panel panel-default">

<div class="panel-heading">
<div class="row text-center">
<div class="col-md-12">
<header>
<h1 >'.$article["article_title"].'</h1>
<h2><small>Autor: '.$user_data["user_name"].'</small></h2>
</header>
</div>
</div>
</div>

<div class="panel-body text-center">
<h3>ABSTRACT:</h3>
<p>'.$article["article_abstract"].'</p>
</div>


<div class="panel-footer text-center">
<p><a href="index.php?n=dwnarticle&id='.$article['id_articles'].' "class="btn btn-primary btn-my" role="button">Stáhnout PDF</a></p>
</div>
</div>
</div>

';

}
    
$users -> Disconnect();
$articles -> Disconnect();
    

?>