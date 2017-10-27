<?php

$id = @$_REQUEST["id"];

if (!isset($_SESSION['user'])) {
    header("Location: index.php?p=404");
}

if(!is_numeric($id )){
    header("Location: index.php?p=404");
}

$rights = $_SESSION['user']['rights'];


$reviews = new reviews();
$reviews->Connect();
$review_data = $reviews->loadreview($id);
if ($review_data["users_user_id"] != $_SESSION["user"]["id"] || $rights != 3  ) {
  header("Location: index.php?p=404");
}
$reviews->removeReview($id);

if($rights != 3){
header("Location: index.php?n=myreviews");
}
else{
header("Location: index.php?n=reviewsadm");
}