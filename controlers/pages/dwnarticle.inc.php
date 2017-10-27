<?php


$id = @$_REQUEST["id"];

$articles = new articles();
$articles->Connect();
$articles_data = $articles->loadArticle($id);
$articles->Disconnect();


$pdf   = $articles_data['article_pdf_name'];
$id    = $articles_data['id_articles'];
$title = $articles_data['article_title'];


//vytvoření fake cesty k souboru   
header("Content-Transfer-Encoding: binary");
header('Content-type: application/pdf');
header("Content-Disposition: attachment; filename='{$title}-{$id}.pdf'");
        
// The PDF source is in original.pdf
readfile("uploads/{$pdf}");





?>