<!DOCTYPE html>
<html>
<head>
    <?PHP
    require_once('add_puzzle_process.php');
    require_once('utility_functions.php');
    session_start();
    require('session_validation.php')
    ?>

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
<title>Final Project</title>

<body>
<?PHP echo getTopNav(); ?>
<font class="crumb">Name in Synonym <img src="./pic/arrow.png"/> Add Puzzle</font>
<?php
$input = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["puzzleWord"])) {    // User submitted a puzzle name
      echo  $input = mb_strtolower(validate_input($_POST["puzzleWord"]), 'UTF-8');
        if (strlen($input) > 0) {
            // puzzle name already exists
            echo create_puzzle_table($input);
        } else {
            echo '<script>alert("Invalid Input!");</script>' . create_word_input();
        }
    } else if (isset($_POST["words"])) {    // User submited puzzle
        $name = $size = "";
        $list = array();
        if (empty($_POST["words"]) && empty($_POST["size"])) {
            //should not happen
        } else {
            $name = mb_strtolower(validate_input($_POST["words"]), 'UTF-8');
            $size = validate_input($_POST["size"]);
            $puzzleflag = false;
            $errorflag = false;
            $chars = getWordChars($name);
            for ($j = 0; $j < $size; $j++) {
                $tempWord = "words" . $j;
                // valid input
                $words = mb_strtolower(validate_input($_POST[$tempWord]), 'UTF-8');
                //echo "words: " . $words;
                $char = $chars[$j];
                //echo "char: " . $char;
                $index = getCharacterIndex($words, $char);
                //echo "index: " . $index;
                if (empty($_POST[$tempWord])) { // failed input
                    // left one of the Synonym or Clues empty
                    // let user know of error
                    if ($errorflag == false) {
                        echo create_puzzle_table($name);
                        echo display_error("Please give every synonym and clue a value!");
                        return;
                    }
                    if ($index === FALSE) {
                        echo create_puzzle_table($name);
                        echo display_error("Char not found in words!");
                        return;
                    }
                } else {
                    if ($puzzleflag === FALSE) {
                        // add to puzzle
                        /* FIXME: Need to give identifier of user that creates the puzzle eg. insertIntoPUzzle($name, $email) */
                        $puzzleId = insertIntoPuzzle($name);
                        $puzzleflag = TRUE;
                    }
                    // add to words
                    insertIntoWords($words, $clue);

                    // add to char
                    insertIntoCharacters(getMaxWordId($words));

                    // add to puzzle words
                    insertIntoPuzzleWords($puzzleId, $j, $words);
                    //array_push($list, $words, $clue); // just for testing
                }
            }
        }
        echo createHeader(validate_input($_POST["words"]));
        echo "<div class='container'>";
        echo '<table class="table table-condensed  main-tables" id="puzzle_table"><thead><tr><th>Clue</th><th>Synonym</th></tr></thead><tbody>';
        echo puzzleAddedTable(validate_input($_POST["words"]));
        echo "</tbody></table><br><br><br><br>";
        echo createFooter();
        echo "</div>";
    }
} else {
    // first place the program goes when the user selects "add a puzzle"
    echo create_word_input();
}
?>
</body>

</html>
