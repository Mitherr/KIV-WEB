<?php 

global $template_params;

include 'view/administration/navigation.inc.php';


if (!isset($_SESSION['user'])) {
    header("Location: index.php");
}

if($_SESSION['user']['rights'] != 3){
     header("Location: index.php");
}
    

$users  = new users();
$users -> Connect();
$users_data = $users->LoadAllUsersAdmin();

$rights  = new rights();
$rights -> Connect();


$template_params['heading'] = "Uživatelé";
$template_params['sloupce'] = " <th>id</th>
                                <th>Jméno</th>
                                <th>Email</th>
                                <th>Datum registrace</th>
                                <th>Zablokován</th>
                                <th>Práva</th>
                                <th>Změny</th>";



foreach($users_data as $user){

     $right = $rights -> loadRight($user['access_rights_id_access_rights']);
    
    if($user['user_banned'] == 0){
       $banned = "NE"; 
       $banBTN = "<td><a href='index.php?n=banuser&id=".$user['id_user']."' class='btn btn-danger btn-sm' role='button'>Zablokovat</a></td>";
    }
    else{
        $banned = "ANO";
        $banBTN = "<td><a href='index.php?n=banuser&id=".$user['id_user']."' class='btn btn-success btn-sm' role='button'>Odblokovat</a></td>";
        
    }
    
    $chngBTN = "<a href='index.php?n=chngrights&id=".$user['id_user']."' class='btn btn-info btn-sm btn-my' role='button'>Změnit práva</a>";
    
    $rmvBTN = "<a href='index.php?n=rmvuser&id=".$user['id_user']."' class='btn btn-danger btn-sm' role='button'>Smazat</a>";
    
    echo "<tr>
          <td>".$user['id_user']."</td>
          <td>".$user['user_name']."</td>
          <td>".$user['user_email']."</td>
          <td>".$user['user_registration_date']."</td>
          <td>".$banned."</td>
          <td>".$right['access_right']."</td>
          <td>".$chngBTN."</td>
              ".$banBTN."
          <td>".$rmvBTN."<td>
          </tr>";         
    
}

$users -> Disconnect();
$rights -> Disconnect();
    
?>