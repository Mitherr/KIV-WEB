<?php
global $template_params;

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

$user = $users->loadUserid($id);
$template_params["user_name"] = $user["user_name"];


if (isset($_POST['right'])) {
    
    $right = $_POST['right'];
    
    if($rights == "Autor"){
        $rightsid = 1;
    }
    else if($right == "Recenzent"){
        $rightsid = 2;
    }
    else{
        $rightsid = 3;
    }
    
    $users->upRights($id,$rightsid);
    header("Location: index.php?n=usersadm");
    
}

if (isset($errormsg)) {
    echo "<div class='text-center'><span class='text-danger'>";
    echo $errormsg;
    echo "</span></div>";
}

if (isset($successmsg)) {
    echo "<div class='text-center'><span class='text-success'>";
    echo $successmsg;
    echo "</span></div>";
}



?>