<?php

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

$id = @$_REQUEST["id"];

$articles = new articles();
$articles->Connect();
$users = new users();
$users->Connect();

$article_data = $articles->loadArticle($id);
$user_data = $users -> loadUserid($article_data["users_id_user"]); 

$users -> Disconnect();
$articles -> Disconnect();

if($user_data['id_user'] != $_SESSION['user']['id'] && $_SESSION['user']['rights'] != 3){
    header("Location: index.php");
}
    

echo'

<div class="containter">
<div class="panel panel-default">

<div class="panel-heading">
<div class="row text-center">
<div class="col-md-12">
<header>
<h1 >'.$article_data["article_title"].'</h1>
<h2><small>Autor: '.$user_data["user_name"].'</small></h2>
</header>
</div>
</div>
</div>

<div class="panel-body text-center">
<h3>ABSTRACT:</h3>
<p>'.$article_data["article_abstract"].'</p>
</div>


<div class="panel-footer text-center">
<p><a href="index.php?n=dwnarticle&id='.$id.' "class="btn btn-primary btn-my" role="button">Stáhnout PDF</a></p>
</div>

</div>
</div>

'

?>