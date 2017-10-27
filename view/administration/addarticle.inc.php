<?php

global $template_params;

include 'view/administration/navigation.inc.php';

if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 1){
     header("Location: index.php");
}


    //nastavení akce
    if (isset($_POST['title'])) {
        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['file']['tmp_name'])) {
                //pokud přisla akce na přidání postu
                    //nastaveni proměnných 
                    $id_user = $_SESSION['user']['id'];
                    $title   = htmlspecialchars($_POST['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    $text    = htmlspecialchars($_POST['abstract'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
                    
                    $file      = rand(100, 1000) . "-" .$_SESSION['user']['id'] . "-" . $_POST['title'].".pdf";
                    $file_loc  = $_FILES['file']['tmp_name'];
                    $file_size = $_FILES['file']['size'];
                    $file_type = $_FILES['file']['type'];
                
                    $rest = substr($file_type, -3, 3);
                
                    if($rest != "pdf"){
                        $errormsg = "Dokument není PDF";
                        echo $rest;
                    }
                    else{
                    $folder    = "uploads/";
                    //přesun
                    move_uploaded_file($file_loc, $folder . $file);
                    
                    //nastaveni db
                    $articles = new articles();
                    $articles->Connect();
                    $post_data = $articles->addArticle($id_user, $title, $text, $file);
                    //kontrola provedení
                    if (isset($post_data)) {
                        $articles->Disconnect();
                        header("Location: index.php?n=myarticles");
                    } else {
                        $errormsg = "Nepovedlo se přidat článek";
                    }
                    }
                }
            }
        }
    //zobrazení erroru
    if (isset($errormsg)) {
        echo "<div class='text-center'><span class='text-danger'>";
        echo $errormsg;
        echo "</span></div>";
    }

?>