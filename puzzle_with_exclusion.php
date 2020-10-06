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
<title>Rebus Puzzle With Exclusion</title>
<body>
<?PHP
session_start();
require('session_validation.php');
?>
<?PHP echo getTopNav(); ?>
<div class="divTitle" align="center">
    <font class="font">Rebus Puzzle (One With Exclusion List)</font>
</div>
<br>
<br>
<div>
    <form method="post" action="generate_puzzle_with_exclusion_list.php">
        <div class="container">
            <div align="center" style="font-size: 30px;">Puzzle Word</div>
            <div class="inputDiv"><input type="textbox" name="puzzleWord" id="name-textbox"
                                         placeholder="Enter a word to create a puzzle"
                                         onclick="this.placeholder = ''"/>
            </div>
            <br>
            <br>
            <div align="center" style="font-size: 30px;">Exclusion Words</div>
            <div class="inputDiv"><input type="textbox" name="exclusionList" id="name-textbox"
                                         placeholder="Enter words to be excluded from the puzzle"
                                         onclick="this.placeholder = ''"/>
            </div>
            <div style="text-align:center">
                <input class="main-buttons" type="submit" value="Show me.."/>
            </div>
        </div>
    </form>
</div>
</body>
</html>
