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
require('session_validation.php');
require('db_configuration.php');

$sql = 'SELECT * FROM users;';
$result = run_sql($sql);
?>

<body>
<?PHP
session_start();
echo getTopNav();

echo '<div>
    <table class="table table-condensed main-tables" style="margin-left: 5%">
        <thead>
        <tr>
            <th>Username</th>
            <th>Password</th>
            <th>Edit/Delete</th>
        </tr>
        </thead>
        <tbody>';

        while($user_list = mysqli_fetch_assoc($result)){
        echo '<tr>
            <td>' . $user_list['username'] . '</td>
            <td>' . $user_list['user_password'] . '</td>
            <td>
                <a href="#">
                    <img class="table_image" src="pic/edit.jpg" alt="Edit">
                </a>
                <a href="#">
                    <img class="table_image" src="pic/delete.jpg" alt="deleteWord">
                </a>
            </td>
            </tr>';
        }
    echo'</table>';


?>
</body>
</html>
