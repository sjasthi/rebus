<!DOCTYPE html>
<html>
<head>
    <?PHP
    session_start();
    require('session_validation.php');
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
    <title>Rebus Puzzle List</title>
</head>
<body>
<?php
require('create_puzzle.php');
?>
<?PHP echo getTopNav(); ?>
<div class="container">
    <?php
    if (isset($_GET['puzzles'])) {
        $puzzles = $_GET['puzzles'];
        $puzzles = explode(",", trim($puzzles));
        foreach ($puzzles as $puzzleWord) {
            $wordId_array = array();
            $word_array = array();
            $clues_array = array();
            $image_array = array();
            $id = getPuzzleId($puzzleWord);
            $puzzleChars = getWordChars($puzzleWord);
            $wordList = getWordFromPuzzleWords($id);
            //var_dump($wordList);
            foreach ($wordList as $word) {
                array_push($wordId_array, $word[0]);
                array_push($word_array, $word[1]);
                array_push($clues_array, $word[2]);
                array_push($image_array, $word[3]);
            }
            echo '<div class="container"><h1 style="color:red;">Find the words for "' . $puzzleWord . '"</h1>';
            echo '<table class="table" id="print_table">';
            for ($i = 0; $i < count($puzzleChars); $i++) {
                $word_chars = getWordChars($word_array[$i]);
                $pos = array_search($puzzleChars[$i], $word_chars) + 1;
                $len = count($word_chars);
                $image = getImage($image_array[$i]);
                if ($i === 0) {
                    echo '<tr>';
                } else if ($i % 4 === 0) {
                    echo '</tr><tr>';
                }
                echo "<td><img class=\"thumbnailSize\" src=" . $image . " alt =" . $image . "><figcaption class=\"word_char\">" . $pos . '/' . $len . "</figcaption></td>";
                //echo "<tr align='center' style='vertical-align: middle;'>" . $pos . '/' . $len . "</tr></td>";
            }
            echo '</tr>';
            echo '</table>';
        }
    }
    ?>

</div>
</body>
</html>
