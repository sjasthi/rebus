<!DOCTYPE html>
<html>
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
        <title>Rebus Users</title>
    </head>
<?PHP
//session_start();
require('session_validation.php');
include('admin_manage_users_helper.php')
?>
    <body>
    <?PHP echo getTopNav(); ?>
    <!-- NOTE: How do we want to handle edit and delete? Should we do an a link and put info in url or should it be private and wrap form around table? -->
    <!-- TODO: Need option to edit and delete user. Should admin be able to see/change user_password and activation_token -->
        <table class="userTable" align="center">
        <div align="center"><a href="#"><h3>Create a User</h3></a></div>
            <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Verified</th>
                <th>Admin Status</th>
                <th>Edit/Delete</th>
            </tr>
            </thead>
            <tbody>
            <?PHP echo create_user_table(); ?>
            </tbody>
        </table>
    </body>
</html>
