<?php

class rights extends db_pdo
{
    // k načtení role podle id
    public function loadRight($id)
    {
        $table_name = "access_rights";
        $columns    = "*";
        $where[]    = array(
            "column" => "id_access_rights",
            "value" => $id,
            "symbol" => "="
        );
        
        $postd = $this->DBSelectOne($table_name, $columns, $where);
        
        return $postd;
    }
    
    //načtení všech práv
    public function loadallRights()
    {
        $table_name = "access_rights";
        $columns    = "*";
        $where[]    = array(
            "column" => "access_right",
            "value" => "null",
            "symbol" => "!="
        );
        
        $role = $this->DBSelectAll($table_name, $columns, $where);
        
        return $role;
    }
    
}