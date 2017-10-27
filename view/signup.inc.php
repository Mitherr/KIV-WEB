<?php

//registrace akce z formuláře
if (isset($_POST['first_name'])) {
     //získání z formuláře a připojení do db
    
        $name = $_POST['first_name']." ".$_POST['surname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_val = $_POST['password_confirmation'];
    
        $name = htmlspecialchars($name, ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $email = htmlspecialchars($email, ENT_QUOTES | ENT_HTML5 , 'UTF-8');
        $password = htmlspecialchars($password, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    
        if($password != $password_val){
            $errormsg = "Hesla se neshoduji";
        }
        else{
        $login = new users();
        $login->Connect();
        $reg_check = $login->check($email);
        //kontrola zda již neexistuje
        if ($reg_check) {
            $errormsg = "Uzivatel již existuje";
            //registruj
        } else {
            $reg_data = $login->addUser($name, $email, $password);
            //provedení error/success
            if ($reg_data) {
                $successmsg = "Registrace proběhla v pořadku, prosím přihlašte se.";
            } else {
                $errormsg = "Nepovedlo se zaregistrovat";
            }
        }
        $login->Disconnect();
        }
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