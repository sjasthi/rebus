<?php
session_start();
require('session_validation.php');
// $status = session_status();
// if ($status == PHP_SESSION_NONE) {
//     session_start();
// }

//require 'bin/functions.php';
require 'db_configuration.php';
//include('header.php');

$page_title = 'User > Create A User';
$page = "create_user.php";
//verifyLogin($page);

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/main_style.css" type="text/css">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
</head>
<div class="container">
    <style>
        #title {
            text-align: center;
            color: darkgoldenrod;
        }

        #guidance {
            color: grey;
            font-size: 10px;
        }
    </style>
 <?php
 echo getTopNav(); ?>
    <form action="create_the_user.php" method="POST" enctype="multipart/form-data">
        <br>
        <h3 id="title">Create A User</h3> <br>

        <div>
            <label>First Name</label> <br>
            <input style=width:400px class="form-control" type="text" name="first_name" maxlength="100" size="50" required title="Please enter the first name"></input>
        </div>

        <div>
            <label>Last Name</label> <br>
            <input style=width:400px class="form-control" name="last_name" maxlength="100" size="50" required title="Please enter the last name"></input>
        </div>

        <div>
            <label>Username</label> <br>
            <input style=width:400px class="form-control" name="username" maxlength="100" size="50" required title="Please enter the username"></input>
        </div>

        <div>
            <label>Email</label> <br>
            <input style=width:400px class="form-control" type="text" name="user_email" maxlength="100" size="50"></input>
        </div>

        <div>
            <label>Password</label> <br>
            <input style=width:400px class="form-control" type="text" name="password" maxlength="100" size="50"></input>
        </div>

        <br><br>
        <div align="center" class="text-left">
            <button type="submit" name="submit" class="btn btn-primary btn-md align-items-center">Create User</button>
        </div>
        <br> <br>

    </form>
</div>

