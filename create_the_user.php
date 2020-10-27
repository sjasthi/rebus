<?php

include_once ('db_configuration.php');

 
    $first_name = mysqli_real_escape_string($db, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($db,$_POST['last_name']);
    $username = mysqli_real_escape_string($db,$_POST['username']);
    $email = mysqli_real_escape_string($db,$_POST['user_email']);
    $password = mysqli_real_escape_string($db,$_POST['password']);

    $validate = true;
    if($validate){
        $activation_token = md5(uniqid());
        $activation_token = substr($activation_token,0,10);
        $sql = "INSERT INTO `users` (`first_name`, `last_name`, `username`, `user_email`, `user_password`, `id_verified`, `activation_token`, `role`)
        VALUES ('$first_name', '$last_name', '$username', '$email', '$password', 1, '$activation_token', 1)";
        mysqli_query($db, $sql);
        header('location: admin_manage_users.php?create_user=success');
    }

?>
