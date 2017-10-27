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
$users->removeUser($id);

header("Location: index.php?n=usersadm");