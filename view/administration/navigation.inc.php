<?php

global $template_params;

$template_params['menu_left'] = "";

if($_SESSION['user']['rights'] == 1 ){
    $template_params['menu_left'] .= "<li><a href='index.php?n=myarticles'>Moje články</a></li>";  
    $template_params['menu_left'] .= "<li><a href='index.php?n=addarticle'>Přidat Článek</a></li>";  
}
else if($_SESSION['user']['rights'] == 2 ){
    $template_params['menu_left'] .= "<li><a href='index.php?n=myreviews'>Moje recenze</a></li>";  
}
else if($_SESSION['user']['rights'] == 3 ){
    $template_params['menu_left'] .= "<li><a href='index.php?n=usersadm'>Uživatelé</a></li>";
    $template_params['menu_left'] .= "<li><a href='index.php?n=articlesadm'>Články</a></li>";
    $template_params['menu_left'] .=  "<li><a href='index.php?n=reviewsadm'>Recenze</a></li>";
    $template_params['menu_left'] .=  "<li><a href='index.php?n=setreviews'>Přidělit recenze</a></li>";
}



?>