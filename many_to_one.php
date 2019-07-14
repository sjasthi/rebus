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
</head>
<title>Rebus Many-To-One</title>
<body>
<?PHP
session_start();
require('session_validation.php');
?>
<?PHP echo getTopNav(); ?>
<div class="divTitle" align="center">
    <font class="font">Rebus Puzzle (Many To One)</font>
</div>
<br>
<div>
    <form method="post" action="generate_multiple_puzzles.php">
        <div class="container">
            <div align="center">Enter MANY_TO_ONE_MAXCOUNT : <input type="textbox" name="max" placeholder="100"
                                                                    value="100" onclick="this.placeholder = ''"/>
            </div>
            <div class="inputDiv"><textarea name="puzzles" id="name-textbox" cols="40" rows="100"
                                            placeholder="Enter list of words to generate multiple puzzles"
                                            onclick="this.placeholder = ''"></textarea>
            </div>
            <br>
            <div style="text-align:center">
                <input class="main-buttons" type="submit" value="Show me.."/>
            </div>
        </div>
    </form>
</div>
</body>
</html>
