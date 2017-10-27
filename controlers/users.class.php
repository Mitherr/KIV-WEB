<?php

class users extends db_pdo
{
    //metoda na přihlášení uživatele
    public function loadUser($email, $password)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "user_email",
            "value" => $email,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        
        $passwordcrypt = md5($password);
        
        if (!empty($user) && $passwordcrypt == $user['user_password']) {
            return $user;
        }
    }
    
    // získání uživatele podle id
    public function loadUserid($id)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => $id,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        return $user;
    }
    
    //smazání uživatele podle id
    public function removeUser($id)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => $id,
            "symbol" => "="
        );
        
        $u = $this->DBDelete($table_name, $where);
        return $u;
    }
    
    //příkaz na prohledání db zda uživatel existuje
    public function check($email)
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "user_email",
            "value" => $email,
            "symbol" => "="
        );
        
        $user = $this->DBSelectOne($table_name, $columns, $where);
        
        return $user;
    }
    
    //přidání uživatele
    public function addUser($name, $email, $password)
    {
        
        $passwordcrypt = md5($password);
        
        $table_name           = "users";
        $item                 = array();
        $item['user_name']        = $name;
        $item['user_email']        = $email;
        $item['user_password']     = $passwordcrypt;
        $item['access_rights_id_access_rights']      = "1";
        
        $user = $this->DBInsert($table_name, $item);
        return $user;
    }
    
    //načtení všech uživatelů
    public function loadAllUsersAdmin()
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_user",
            "value" => "null",
            "symbol" => "!="
        );
        
        
        $user = $this->DBSelectAll($table_name, $columns, $where);
        return $user;
    }
    
    //načtení všech recenzovatelů
    public function loadAllReviewers()
    {
        $table_name = "users";
        $columns    = "*";
        $where[]    = array(
            "column" => "access_rights_id_access_rights",
            "value" => "2",
            "symbol" => "="
        );
        
        
        $user = $this->DBSelectAll($table_name, $columns, $where);
        return $user;
    }
    
    //update banned
    public function upBanned($userid, $value)
    {
        $table_name = "users";
        $column[]   = array(
            "column" => "user_banned",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_user",
            "value" => $userid,
            "symbol" => "="
        );
        
        $user = $this->DBUpdate($table_name, $column, $where);
        return $user;
    }
    
    //update role
    public function upRights($userid, $value){
     
        $table_name = "users";
        $column[]   = array(
            "column" => "access_rights_id_access_rights",
            "value" => $value
        );
        $where[]    = array(
            "column" => "id_user",
            "value" => $userid,
            "symbol" => "="
        );
        
        $up = $this->DBUpdate($table_name, $column, $where);
        return $up;
    }
    
}