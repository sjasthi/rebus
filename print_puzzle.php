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
    <title>Rebus Print Puzzle</title>
</head>
<body>
<?php
require('create_puzzle.php');
//require_once('dompdf/autoload.inc.php');
//use Dompdf\Dompdf;
?>
<div style="width: 100%; background-color: #92d050; text-align: center;"><img src="./pic/SILClogo.jpg" style="height: 190px; width:auto; cursor: pointer;" onclick="showHideOptions()"> </div>
<div class="container">
    <?php
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $wordId_array = array();
        $word_array = array();
        $clues_array = array();
        $image_array = array();
        $puzzleWord = getPuzzleName($id);
        $puzzleChars = getWordChars($puzzleWord);
        $wordList = getWordFromPuzzleWords($id);
        //var_dump($wordList);
        foreach ($wordList as $word) {
            array_push($wordId_array, $word[0]);
            array_push($word_array, $word[1]);
            array_push($clues_array, $word[2]);
            array_push($image_array, $word[3]);
        }

        $html = "";


        $html .= '<div class="container"><h1 style="color:red;">Find the words for "' . $puzzleWord . '"</h1>';
        $html .= '<div id="optionContainer"><h3 style="color:green;"><input type="checkbox" name="answer" onclick="toggleAnswer()">Show Answer</h3></div><br>';

        $html .= '<table class="table" id="print_table" border="0">';
        for ($i = 0; $i < count($puzzleChars); $i++) {
            $word_chars = getWordChars($word_array[$i]);
            $pos = array_search($puzzleChars[$i], $word_chars) + 1;
            $len = count($word_chars);
            $image = getImage($image_array[$i]);
            $word = $word_array[$i];
            if ($i === 0) {
                $html .= '<tr>';
            } else if ($i % 4 === 0) {
                $html .= '</tr border="0"><tr>';
            }
            $html .= "<td align='center' style='vertical-align:bottom; border-top: none;'><img class=\"print-img\" src=\"$image\" alt =\"$image\"><br>
            <figcaption class=\"print-figCaption\">" . $pos . '/' . $len . "</figcaption>
            <div align='center' class='answerDiv'><h3>". $word ."</h3></div></td>";
            //echo "<tr align='center' style='vertical-align: middle;'>" . $pos . '/' . $len . "</tr></td>";
        }
        $html .= '</tr>';
    } else {
        echo "Puzzle id not provided!!!";
    }
    $html .= '</table>';
//    echo '<form method="post" action="export_pdf.php">
//              <input class="btn btn-primary" type="submit" name="PDF" value="Export to PDF" />
//              <input type="hidden" name="html" value="" />
//          </form>';
    echo $html;



//    if (isset($_POST["PDF"])) {
//
//        echo "etf";
//
//        // echo $content = $html;
//        if (get_magic_quotes_gpc())
//            $content = stripslashes($html);  // remove unwanted characters
//
//        $dompdf = new DOMPDF(); // creating dompdf object
//        $dompdf->loadHtml($html); // load html data from above form
//        $dompdf->setPaper('A4'); // set print page type
//        $dompdf->render(); // generate pdf file
//
//        $f;
//        $l;
//        if (headers_sent($f, $l)) {
//            echo $f, '<br/>', $l, '<br/>';
//            die('now detect line');
//        }
//        //$dompdf->stream("mypage.pdf", array("Attachment" => false)); // save pdf file.I named it "mypage.pdf".
//        $dompdf->stream();
//        echo "End of file";
//
//        exit();
//    }
    ?>

    <script>
        //Use a for loop to iterate through all the element with the same id.
        function toggleAnswer() {
            var x = document.getElementsByClassName('answerDiv');
            for(i = 0; i < x.length; i++ ){
                if (x[i].style.display === 'block') {
                    x[i].style.display = 'none';
                } else {
                    x[i].style.display = 'block';
                }
            }
        }

        function showHideOptions(){
            var options = document.getElementById('optionContainer');
            if(options.style.display === 'none'){
                options.style.display = 'block';
            }
            else{
                options.style.display = 'none';
            }
        }
    </script>


</div>
</body>
</html>
