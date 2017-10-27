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

$users = new users();
$users->Connect();
$user_data = $users->loadUserid($id);
$value = 0;
if($user_data['user_banned'] == 0){
    $value = 1;
}
$users -> upBanned($id,$value);

header("Location: index.php?n=usersadm")




?>