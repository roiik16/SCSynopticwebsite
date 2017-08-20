<?php
    header ('Access-Control-Allow-Origin: *');

    include '../functions.php';
    
    $result = all_users ();
    $array = array ();
    
    while ($user = mysqli_fetch_assoc ($result)) {
        $array[] = array (
            'id'        => $user['user_id'],
            'username'  => $user['user_username'],
            'real-name' => "{$user['user_fname']} {$user['user_lname']}"
        );
    }
    
    echo json_encode ($array);
?>