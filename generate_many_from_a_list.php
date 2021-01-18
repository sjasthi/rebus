<?PHP
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
    <title>Rebus Puzzles</title>
</head>
<body>
<?php
require('create_puzzle.php');
require('utility_functions.php');
?>
<div style="width: 100%; background-color: #92d050; text-align: center;"><img src="./pic/logo.png" style="height: 190px; width:auto; cursor: pointer;" onclick="showHideOptions()"> </div><br>
<div class="container">
    <?php
	
     if (isset($_POST['max'])) { // this is for one to many puzzle which provides a MAX_COUNT
        $maxProvided = true;
        $max = $_POST['max'];
    } else { // this is for one to many
        $maxProvided = false;
    }

    if (isset($_POST['wordInput'])) {
        $input = preg_replace("/\r\n/", ",", validate_input($_POST['wordInput']));
        // Verify the input value provided meets our requirements

        if ($input == '') {
            // If input is empty, go back to one_to_many page
            echo '<script type="text/javascript">alert("You did not enter any words. Please try again!"); ';
            if ($maxProvided) {
                echo 'window.location.href = "many_from_a_list.php"</script>';
            } else {
                echo 'window.location.href = "many_from_a_list.php"</script>';
            }
        } else {

            // Display preferences
/* 			
            echo '<div id="optionContainer" class="optionDiv" style="display: block;" align="center">';
            echo '<div id="displayPreferences">';
            echo '<lable><b style="font-size: 20px;">Image Display Preference: </b></lable>';
            echo '<input type="radio" name="showImage" value="Show Images" checked onclick="toggleImage()" /><label>Show Images</label>';
            echo '<input type="radio" style="margin-left:15px;" name="showImage" value="Mask Images" onclick="toggleImage()" /><label>Mask Images</label>';
            echo '<input type="radio" style="margin-left:15px;" name="showImage" value="Show Numbers Only" onclick="toggleImage()" /><label>Show Numbers Only</label>';
            echo '<input type="radio" style="margin-left:15px;" name="showImage" value="Mask Letters Only" onclick="toggleImage()" /><label>Show Letters Only</label>';
            echo '</div>';

            echo '<div id="answerPreferences">';
            echo '<lable><b style="font-size: 20px;">Answer Display Preference: </b></lable>';
            echo '<input type="radio" name="showAnswers" value="Do Not Show Answers" checked onclick="toggleAnswer()" /><label>Do Not Show Answers</label>';
            echo '<input type="radio" style="margin-left:15px;" name="showAnswers" value="Show Answers Below the Image" onclick="toggleAnswer()" /><label>Show Answers Below the Image</label>';
            echo '<input type="radio" style="margin-left:15px;" name="showAnswers" value="Show Answers At the end of the page" onclick="toggleAnswer()" /><label>Show Answers At the end of the page</label>';
            echo '</div>';

            echo '<div id="imagePreferences">';
            echo '<lable><b style="font-size: 20px;">Image Size Preference: </b></lable>';
            echo '<input type="radio" name="imageSize" onclick="alterImageSize()" /><label>Default</label>
                    <input style="margin-left:5px;" size="2px" type="text" name="default" id="default"/>';
            echo '<input type="radio" style="margin-left:15px;" name="imageSize" onclick="alterImageSize()" /><label>Height Driven</label>
                    <input style="margin-left:5px;" size="2px" type="text" name="heightDriven" id="heightDriven"/>';
            echo '<input type="radio" style="margin-left:15px;" name="imageSize" onclick="alterImageSize()" /><label>WidthDriven</label>
                    <input style="margin-left:5px;" size="2px" type="text" name="widthDriven" id="widthDriven"/>';
            echo '</div>';
 */
//            echo '<div id="rowSizePreference">';
//            echo '<lable><b style="font-size: 20px;">Column Preference: </b></lable>';
//            echo '<label>Number of words per row: </label><input style="margin-left:5px;" type="number" name="rowSize" id="rowSize"min="3" max = "10" value="4" onchange="changeTableRow()"/>
//                  <label> (Range is from 3 to 10)</label>';
//            echo '</div>';
            echo '</div>';

            //echo '<h3 style="color:green;"><input type="checkbox" name="answer" onclick="toggleAnswer()">Show Answer</h3>';

            // Display the puzzles generated for given word
/* 			
one
two
three
four
five
six
seven
eight
nine
ten			
		
 */
//			echo ('a1: '.$input.PHP_EOL);
			$puzzles = explode(",", trim($input));
			$puzzleIndex = 0;
			echo '<div class="container">';
			echo '<div class="container"><h1>Input Word List</h1>';
			echo '<div style="font-size: 1.5em;">'.$input.'</div>';
			
			
			echo '<h1>Puzzles</h1>';
			echo '<ol style="font-size: 1.5em;">';
            foreach ($puzzles as $puzzleWord) {
				$usedWordList = array(); // we will use this to keep track of words being used so no repetition occurs
                $puzzleChars = getWordChars($puzzleWord);    //  split the current word being turned into a puzzle into the characters in that word.  Result is an array
				
//				echo ('b1: '.PHP_EOL);
//				print_r($puzzleChars);
				
                $generate = true;
                $counter = 0;

                while ($generate) {
                    $wordArray = array();
					for ($i = 0; $i < count($puzzleChars); $i++) {   //  This is each character in the current word being puzzle-ized
						for ($j = 0; $j < count($puzzles); $j++) {	//	Loop thru the word list ($puzzles) looking for a word that has the current character							
							$intersectionFound = false;
							$candidateWord = $puzzles[$j];					//  candidateWord will be the current word we're thinking about intersecting with
							if ($puzzleWord == $candidateWord) {
								continue;
							}
							$key = array_search($candidateWord, $usedWordList, true);
							if ($key !== false) {
								continue;
							}
							
							$candidateChars = getWordChars($candidateWord);			//  candidateChars will be an array built from candidateWord
							$key = array_search($puzzleChars[$i], $candidateChars, true);
//							echo ('zz: '.$puzzleChars[$i].'|'.$puzzleWord.'|'.$candidateWord.'|'.$key.'|'.PHP_EOL);
							
							if ($key !== false) {
								$intersectionFound = true;
								break;
							}
						}
						if (!$intersectionFound) {
							array_push($wordArray, 'INTERSECTION_NOT_FOUND');
//							echo ('INTERSECTION NOT FOUND: '.$puzzleWord.'|'.$candidateWord.PHP_EOL);
						}
									
/* 						echo ('qq: '.$puzzleWord.'|'.$candidateWord.PHP_EOL);
						echo ('c1: '.PHP_EOL);
						print_r($candidateWord);
 */						
                        if (!empty($candidateWord)) {
                            array_push($wordArray, $candidateWord);
                            array_push($usedWordList, $candidateWord);
                        } 
						else {
                            array_push($wordArray, $puzzleChars[$i]);
                            if (!$maxProvided) {
                                $generate = false;
                            }
                        }
                    }

                    $counter++;

					//  one  = 3/3 (two) + 1/4 (nine) + 4/5 (three)
					//  Now, spin thru the characters of the current $puzzleWord and figure out where the Candidate words intersect
					$snippet = '<li>'.$puzzleWord.'  ';
                    for ($i = 0; $i < count($puzzleChars); $i++) {
						if ($wordArray[$i] === 'INTERSECTION_NOT_FOUND') {
							$snippet .= '?? (not enough words to generate)';
							break;
						}
//						echo('Word Chars Loop 2'.$snippet.PHP_EOL);
						$wordChars = getWordChars($wordArray[$i]);
                        $pos = array_search($puzzleChars[$i], $wordChars) + 1;
                        $len = count($wordChars);
						$snippet .= $pos.'/'.$len.'('.$wordArray[$i].')';
						if ($i < count($puzzleChars) - 1) {
							$snippet .= ' + ';
						}
                    }
					$generate = false;
                    //  }
                    if ($maxProvided) {
                        // only display max count number of puzzles
                        if ($counter == $max) {
                            $generate = false;
                        }
                    }
                }            
            echo $snippet.'</li>';

			}
        }
    }
	
    ?>

    <script>
        function toggleImage() {
            var show = document.getElementsByName('showImage');
            var images = document.getElementsByClassName('print-img');
            var letters = document.getElementsByClassName('letters');
            var chars = document.getElementsByClassName('chars');
            var masks = document.getElementsByClassName('maskImage');

            if (show[1].checked) {
                for (i = 0; i < images.length; i++) {
                    images[i].style.display = 'none';
                }
                for (i = 0; i < masks.length; i++) {
                    masks[i].style.display = 'block';
                }
                for (i = 0; i < chars.length; i++) {
                    chars[i].style.display = 'none';
                }
                for (i = 0; i < letters.length; i++) {
                    letters[i].style.display = 'none';
                }
            } else if (show[2].checked) {
                for (i = 0; i < images.length; i++) {
                    images[i].style.display = 'none';
                }
                for (i = 0; i < masks.length; i++) {
                    masks[i].style.display = 'none';
                }
                for (i = 0; i < chars.length; i++) {
                    chars[i].style.display = 'none';
                }
                for (i = 0; i < letters.length; i++) {
                    letters[i].style.display = 'none';
                }
            } else if (show[3].checked) {
                for (i = 0; i < images.length; i++) {
                    images[i].style.display = 'none';
                }
                for (i = 0; i < masks.length; i++) {
                    masks[i].style.display = 'none';
                }
                for (i = 0; i < chars.length; i++) {
                    chars[i].style.display = 'block';
                }
                for (i = 0; i < letters.length; i++) {
                    letters[i].style.display = 'block';
                }
            } else {
                for (i = 0; i < images.length; i++) {
                    images[i].style.display = 'block';
                }
                for (i = 0; i < masks.length; i++) {
                    masks[i].style.display = 'block';
                }
                for (i = 0; i < chars.length; i++) {
                    chars[i].style.display = 'block';
                }
                for (i = 0; i < letters.length; i++) {
                    letters[i].style.display = 'none';
                }
            }
        }

        function toggleAnswer() {
            var options = document.getElementsByName('showAnswers');
            var x = document.getElementsByClassName('answerDiv');
            var allAnswers = document.getElementsByName("allAnswers");
            if (options[1].checked) {
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = 'block';
                }
                allAnswers[0].style.display = 'none';
            } else if(options[2].checked) {
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = 'none';
                }
                allAnswers[0].style.display = 'block';
            } else {
                for (i = 0; i < x.length; i++) {
                    x[i].style.display = 'none';
                }
                allAnswers[0].style.display = 'none';
            }
        }

        function alterImageSize() {
            var options = document.getElementsByName('imageSize');
            var defaultSize = document.getElementById('default').value + "px";
            var heightDriven = document.getElementById('heightDriven').value + "px";
            var widthDriven = document.getElementById('widthDriven').value + "px";
            var imageStyle = document.getElementsByClassName('print-img');
            var imageHousing = document.getElementsByClassName('maskImage');

            if(options[0].checked && document.getElementById('default').value == "" ){
                alert("Provide values before selecting default button");
            }
            if(options[1].checked && document.getElementById('heightDriven').value == "" ){
                alert("Provide values before selecting default button");
            }
            if(options[2].checked && document.getElementById('widthDriven').value == "" ){
                alert("Provide values before selecting default button");
            }
            for (i = 0; i < imageStyle.length; i++) {
                if (options[0].checked) {
                   // alert("'" + defaultSize + "'");
                    imageStyle[i].style.height = defaultSize;
                    imageStyle[i].style.width = defaultSize;
                    imageHousing[i].style.height = imageStyle[i].style.height;
                    imageHousing[i].style.width = imageStyle[i].style.width;
                } else if (options[1].checked) {
                    //alert("'" + heightDriven + "'");
                    imageStyle[i].style.height  = heightDriven;
                    imageStyle[i].style.width = 'auto';
                    imageHousing[i].style.height = imageStyle[i].style.height;
                    imageHousing[i].style.width = imageStyle[i].style.width;
                    imageHousing[i].style.backgroundImage = "none";
                } else if (options[2].checked) {
                    //alert(widthDriven);
                    imageStyle[i].style.height = 'auto';
                    imageStyle[i].style.width = widthDriven;
                    imageHousing[i].style.width = imageStyle[i].style.width;
                    imageHousing[i].style.height = imageStyle[i].style.height;
                    imageHousing[i].style.backgroundImage = "none";
                }else{
                    imageStyle[i].style.height = "150px";
                    imageStyle[i].style.width = "150px";
                    imageHousing[i].style.height = "150px";
                    imageHousing[i].style.width = "150px";
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

        function changeTableRow(){
            var size = document.getElementById("rowSize").value;
            var tables = document.getElementsByClassName("table");
            alert(tables.length);

           // for(i=0; i<tables.length; i++){

                var table = tables[0];
               // alert(table.rows[0].cells.length);
               // table.rows.length = size;
                var rowObject = table.rows[0];
                //alert(table.rows[0].cells.length);

                var diff  = rowObject.cells.length - size;
                var index = rowObject.cells.length;
                var rowIndex = 1;
                var i=0;
                if(diff > 0){
                    while(diff >= 0){
                        rowObject.insertCell(-1);
                        rowObject.cell[i+1].innerHTML = table.rows[rowIndex].cells[i].innerHTML;
                        table.rows[rowIndex].deleteCell(i);
                        i++;
                    }

                }
           // }
        }


    </script>

</div>
</body>
</html>
