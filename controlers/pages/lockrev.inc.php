<?php

$id = @$_REQUEST["id"];

if (!isset($_SESSION['user'])) {
    header("Location: index.php?p=404");
}

if(!is_numeric($id )){
    header("Location: index.php?p=404");
}

$rights = $_SESSION['user']['rights'];

if ($rights != "3") {
  header("Location: index.php?p=404");
}

$reviews = new reviews();
$reviews->Connect();
$review_data = $reviews->loadReview($id);
$value = 0;
if($review_data['review_locked']== 0){
    $value = 1;
}
$reviews->upLocked($id,$value);

header("Location: index.php?n=reviewsadm")

?>