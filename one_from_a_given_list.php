<?PHP
session_start();
require('session_validation.php');
?>
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
<title>Rebus One From A Given List</title>
<body>
<?PHP echo getTopNav(); ?>
<div class="divTitle" align="center">
    <font class="font">Rebus Puzzle (One From A Given List)</font>
</div>
<br>
<br>
<div>
    <form method="post" action="generate_puzzle_from_list.php">
        <div class="container">
            <!-- <div align="center" style="font-size: 30px;">Puzzle Word</div> -->
            <!-- <div class="inputDiv"><input type="textbox" name="puzzleWord" id="name-textbox"
                                         placeholder="Enter a word to create a puzzle"
                                         onclick="this.placeholder = ''"/> -->
            <label style="font-size: 30px;">Puzzle Word</label>
            <textarea style=width:400px class="form-control" name="puzzleWord" cols="55" rows="2" placeholder="Enter a word to create a puzzle"
            onclick="this.placeholder = ''"></textarea>
            <!-- </div> -->
            <br>
            <br>
            <!-- <div align="center" style="font-size: 30px;">Solution Words</div>
            <div class="inputDiv"><input type="textbox" name="solutionWords" id="name-textbox"
                                         placeholder="Enter words to be used to solve the puzzle"
                                         onclick="this.placeholder = ''"/>
            </div> -->
            
            <label style="font-size: 30px;">Solution Words</label>
            <textarea style=width:400px class="form-control" name="solutionWords" cols="55" rows="5" placeholder="Enter words to be used to solve the puzzle"
            onclick="this.placeholder = ''"></textarea>
            <div style="text-align:center">
                <input class="main-buttons" type="submit" value="Show me.."/>
            </div>
        </div>
    </form>
</div>
</body>
</html>
