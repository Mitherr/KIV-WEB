<?php
//uživatel je již přihlášen
if (isset($_SESSION['user']) != "") {
    header("Location: index.php");
}
    

//registrace akce z formuláře
if (isset($_POST['email'])) {
     //získání z formuláře a připojení do db
        $username = $_POST['email'];
        $password = $_POST['password'];
        $login    = new users();
        $login->Connect();
        $login_data = $login->loadUser($username, $password);
        //pokud se schoduje heslo s db
        if ($login_data != null) {
            //pokud není ban
            if ($login_data['user_banned']=="0") {
                //přihlášení
                $_SESSION['user']          = array();
                $_SESSION['user']['id']    = $login_data['id_user'];
                $_SESSION['user']['name'] = $login_data['user_name'];
                $_SESSION['user']['email'] = $login_data['user_email'];
                $_SESSION['user']['rights']  = $login_data['access_rights_id_access_rights'];
                header("Location: index.php");
                //error při zabanování
            } else {
                $errormsg = "JSI ZABANOVÁN !!!";
            }
            //error při nesprávném hesle / uživateli
        } else {
            $errormsg = "Nesprávné uživatelské jméno, nebo heslo!!!";
        }
        $login->Disconnect();
    }

//vypis hlášek
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