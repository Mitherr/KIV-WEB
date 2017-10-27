<?php

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php?p=404");
}


echo '
<div class="container text-center">
<t1 class="head">Vítejte v Administraci</t1>
</div>';


if($_SESSION['user']['rights']==3){
echo'
<p class="white">Zde lze zabanovat, smazat nebo změnit práva uživateli</p>
<a class="bigger" href="index.php?n=usersadm">- Uživatele</a>
<p class="white">Zde lze publikovat, smazat nebo si prohlédnout příspěvky</p>
<a class="bigger" href="index.php?n=articlesadm">- Příspěvky</a>
<p class="white">Zde lze uzamykat, smazat nebo si prohlédnout receneze</p>
<a class="bigger" href="index.php?n=reviewsadm">- Recenze</a>
';
}
elseif($_SESSION['user']['rights']==2){
echo'
<p class="white">Slouží ke správě recenzí</p>
<a class="bigger" href="index.php?n=myreviews">- Moje recenze</a>
';
}
else{
echo'
<p class="white">Zde si lze prohlédnout vaše články a recenze na ně</p>
<a class="bigger" href="index.php?n=myarticles">- Moje články</a>
<p class="white">Zde lze přidávat vlastní články</p>
<a class="bigger" href="index.php?n=addarticle">- Přidat článek</a>
';      
}


?>