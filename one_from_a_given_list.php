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

    <style>

        .flex-row {
            flex-direction: row;
            align-items: center;
            justify-content: center;
        }

        .flex-row > div {
            padding: 5px;
        }

        .center {
            text-align: center;
        }

        p {
            font-size: 22px;
        }
        
        .warning {
            color: red;
        }

        input:first-child,
        textarea {
            padding: 10px; 
            border: 2px solid black;
            border-radius: 10px;
            width: 100%;
            font-size: 24px;
        }
    
    </style>

</head>
<title>Rebus One From a Given List</title>
<body>
<?php
    session_start();
    require('session_validation.php');
    require_once('language_processor_functions.php');
    echo getTopNav();
    require('common_sql_functions.php');
    require('utility_functions.php');
    require('create_puzzle.php');
?>


<div class="divTitle" align="center">
    <font class="font">One From a Given List</font>
</div>
<br>

<div>
    <form method="post" action="">
        <div class="container flex-row">

            <div>
                <input type="text" name="puzzle_word" value="" placeholder="Puzzle Word" onfocus="this.placeholder=''" onblur="this.placeholder='Puzzle Word'">
            </div>

            <div>
                <textarea name="solution_words" id="solutionWords" rows="5" placeholder="Solution Words... minimum words needed is the length of the puzzle word" onfocus="this.placeholder=''" onblur="this.placeholder='Solution Words... minimum words needed is the length of the puzzle word'"></textarea>
            </div>

            <div class="center">
                <button class="main-buttons" type="submit" name="query_images">Show me...</button>
            </div>
            
               <?php

                    // Check that form was submitted
                    if(!empty($_POST['solution_words'])):

                        $puzzleWord = validate_input($_POST['puzzle_word']);
                        $puzzleWordChars = getWordChars($puzzleWord);
                        $solutionWords = preg_replace("/\r\n/", ",", validate_input($_POST['solution_words']));
             
                        $solutionWords = explode(",", trim($solutionWords));

                        if(count($solutionWords) < count($puzzleWordChars)):
                            echo '<p class="warning">Not enough solution words used!</p>';
                        else:

                            // display preferences
                            include ('includes/display_preferences.php');
                ?>

                            <h1>Puzzle Word:</h1>
                            <p><?php echo $puzzleWord; ?></p>

                            <h1>Solution Words:</h1>
                            <p><?php  echo implode(", ", $solutionWords); ?>

                            <h1>Solution:</h1>

                 <?php
                            $generate = true;
                            
                            while($generate){

                                $wordArray = [];
                                $imageArray = [];
                                $usedWordList = [];
                                
                                foreach($solutionWords as $solutionWord){

                                    for($i = 0; $i < count($puzzleWordChars); $i++){ // loop through each character in the puzzleWord

                                        for($j = 0; $j < count($solutionWords); $j++){ // loop through the solutionWords looking for a word that has the current char
                                            $intersectionFound = false;
                                            $candidateWord = $solutionWords[$j];

                                            $key = array_search($candidateWord, $usedWordList);
                                            if($key !== false){
                                                continue;
                                            }

                                            $candidateChars = getWordChars($candidateWord);
                                            // echo '<pre>';
                                            //     var_dump($candidateChars[$j]);
                                            // echo '</pre>';
                                            
                                            // send to common_sql_functions.php
                                            $word = getCandidateWordImg($candidateChars[$i], $usedWordList);

                                            
                                            
                                            $key = array_search($puzzleWordChars[$i], $candidateChars, true);
                                            // echo ('zz: '.$puzzleWordChars[$i].'|'.$puzzleWord.'|'.$candidateWord.'|'.$key.'|'.PHP_EOL);

                                            if($key !== false){
                                                $intersectionFound = true;
                                                break;
                                            }
                                        }

                                        if(!$intersectionFound){
                                            array_push($wordArray, 'INTERSECTION_NOT_FOUND');
                                        }

                                        if(!empty($candidateWord)){
                                          array_push($wordArray, $candidateWord);
                                          array_push($imageArray, $word['image']);
                                          array_push($usedWordList, $candidateWord);
                                      } else {
                                          array_push($wordArray, $candidateChars[$i]);
                                          // array_push($imageArray, "");
                                      }
                                    }
                                
                                }
                                $allAnswers = '';
                                $allAnswers .="<h2 style='color: green;'> Answer for Puzzle: \"".$puzzleWord."\"</h2>";

                                $snippet = '<table class="table" id="print_table" border="0" style="width: auto"><tr>';

                                //  Spin thru the characters of the puzzleWord and figure out where the Candidate words intersect
                                for($k = 0; $k < count($puzzleWordChars); $k++){
                                    if($wordArray[$k] === 'INTERSECTION_NOT_FOUND'){
                                        $snippet .= '?? (not enough words to generate)';
                                        break;
                                    }

                                    $word = $wordArray[$k];

                                    $wordChars = getWordChars($wordArray[$k]);
                                    
                                    $pos = array_search($puzzleWordChars[$k], $wordChars) + 1; // position -- see if 
                                    $len = count($wordChars); // length of candidate word
                                    $word = $wordArray[$k];

                                    // from create_puzzle.php
                                    $image = getImageIfExists($imageArray[$k]);
                                    // $image = getImage($wordArray[$k]);
                                    // echo $word;
                                    // print_r($imageArray);
                                    // var_dump($image);
                                    

                                    // if(empty($image)){
                                    //   $snippet .= null;
                                    // } else {
                                      $snippet .= "<td align='center' style='border-top: 0; vertical-align: bottom;'>
                                      <h1 class='letters' style='display:none'> $puzzleWordChars[$k] </h1>
                                      <div class='maskImage'><img class='print-img' src=\"$image\" alt =\"$image\"></div>
                                      <figcaption class=\"print-figCaption\">" . $pos . '/' . $len . "</figcaption>
                                      <div align='center' class='answerDiv'><h3>" . $word . "</h3></div></td>";

                                    // }

                                    // $allAnswers .= "<h5>".$word."</h5>";
                             
                                }

                                $generate = false;

                            }

                            echo $snippet . '</tr></table>';

                            echo '<div name="allAnswers" style="display:none"><h3>'.$allAnswers.'</h3></div>';

                        endif;
                ?>

            <?php endif; ?> <!-- end if form submitted -->

  
        </div>
    </form>
</div>

<script src="javascript/main.js"></script>

<script>
//   document.getElementById("solutionWords").value = "brothers\norange\ntea";
</script>

</body>
</html>
