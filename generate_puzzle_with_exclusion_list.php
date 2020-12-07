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
require ('utility_functions.php');
?>
<div style="width: 100%; background-color: #92d050;">
    <div style="text-align: center;"><img src="./pic/logo.png" style="height: 190px; width:auto; cursor: pointer;" onclick="showHideOptions()"> </div>
    <div style="margin-top: -110px; position:relative; bottom: 35px; left: 35px;"><a href="./admin.php"><button id="back" class="navOption">Admin</button></a></div>
</div>
    <br><div class="container">
    <?php


    if (isset($_POST['puzzleWord'])) {
        if (isset($_POST['exclusionList'])){ 
            $input = preg_replace("/\r\n/", ",", validate_input($_POST['puzzleWord']));

            $input2 = preg_replace("/\r\n/", ",", validate_input($_POST['exclusionList']));
            $exclusion_list = explode(",", trim($input2));
            if ($input == '') {
                echo '<script type="text/javascript">alert("You did not enter any words. Please try again!"); window.location.href = "puzzle_with_exclusion.php"</script>';
            } else if (count(explode(",", trim($input))) > 1) {
                // If input contains more than one words, go back to previous page
                echo '<script type="text/javascript">alert("You can only enter one word in the puzzle word section. Please try again"); window.location.href = "puzzle_with_exclusion.php"</script>';
            } else {
                // Display preferences
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
    //
    //            echo '<div id="rowSizePreference">';
    //            echo '<lable><b style="font-size: 20px;">Column Preference: </b></lable>';
    //            echo '<label>Number of words per row: </label><input style="margin-left:5px;" type="number" name="rowSize" id="rowSize"min="3" max = "10" value="4" onchange="changeTableRow()"/><label> (Range is from 3 to 10)</label>';
    //            echo '</div>';
                echo '<div id="lengthPreferences">';
                echo '<form action="/rebus/generate_puzzle_with_exclusion_list.php" method="post"><lable><b style="font-size: 20px;">Length Preference: </b></lable>';
                echo '<label>Length Minimum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="lenmin" id="lenmin"/>';
                echo '<label style="padding: 8px;">Length Maximum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="lenmax" id="lenmax"/>';
                echo '<input type="hidden" id="puzzleWord" name="puzzleWord" value="'. $_POST['puzzleWord'] .'">';
                echo '<input type="hidden" id="exclusionList" name="exclusionList" value="'. $_POST['exclusionList'] .'">';
                if(isset($_POST['max'])){ 
                echo '<input type="hidden" id="max" name="max" value="'. $max .'">';
                }
                echo '</div><div id="dateCreated">';
                echo '<lable><b style="font-size: 20px;">Creation Date:</b></lable>\
                <label style="padding: 8px;">Pull from words created within how many days: </label>';
                echo '<input type=text name="daysFromToday" id="daysFromToday"></div>';

                echo '<div id="strengthPreferences">';
                echo '<lable><b style="font-size: 20px;">Strength Preferences: </b></lable>';
                echo '<label>Strength Minimum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="strengthmin" id="strengthmin"/>';
                echo '<label style="padding: 8px;">Strength Maximum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="strengthmax" id="strengthmax"/></div>';

                echo '<div id="weightPreferences">';
                echo '<lable><b style="font-size: 20px;">Weight Preferences: </b></lable>';
                echo '<label>Weight Minimum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="weightmin" id="weightmin"/>';
                echo '<label style="padding: 8px;">Weight Maximum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="weightmax" id="weightmax"/></div>';

                echo '<div id="levelPreferences">';
                echo '<lable><b style="font-size: 20px;">Level Preferences: </b></lable>';
                echo '<label>Level Minimum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="levelmin" id="levelmin"/>';
                echo '<label style="padding: 8px;">Level Maximum</label>
                <input style="margin-left:5px;" size="2px" type="text" name="levelmax" id="levelmax"/>';

                echo '<br><input type="submit" value="Refresh">';
                echo '</form></div>';
                echo '</div>';
                $lenmin = 1; //default minimum length for a word is 1
                $lenmax = 120; //default maximum length for a word is 120. No word is longer than 120 characters.
                $daysFromToday = 1000; //default days from today is 1000 because no word in the database is older than 1000 days
                $strengthmin = 1; //default minimum Strength for a word is 1
                $strengthmax = 7; //default max strength for a word is 7.
                $weightmin = 1; //default minimum Weight for a word is 1
                $weightmax = 30; //default max weight for a word is 30.
                $levelmin = 1; //default minimum level for a word is 1
                $levelmax = 7;  //default max level for a word is 7

                if (isset($_POST['lenmin']) && is_numeric($_POST['lenmin'])) { 
                    $lenmin = $_POST['lenmin'];
                  } else { 
                    $lenmin = 1;
                  }
          
                  if (isset($_POST['lenmax']) && is_numeric($_POST['lenmax'])) { 
                    $lenmax = $_POST['lenmax'];
                  } else { 
                    $lenmax = 120;
                  }
          
                  if (isset($_POST['daysFromToday']) && is_numeric($_POST['daysFromToday'])) { 
                    $daysFromToday = $_POST['daysFromToday'];
                  } 
          
                  if (isset($_POST['strengthmin']) && is_numeric($_POST['strengthmin'])) { 
                    $strengthmin = $_POST['strengthmin'];
                  } 
          
                  if (isset($_POST['strengthmax']) && is_numeric($_POST['strengthmax'])) { 
                    $strengthmax = $_POST['strengthmax'];
                  } 
          
                  if (isset($_POST['weightmin']) && is_numeric($_POST['weightmin'])) { 
                    $weightmin = $_POST['weightmin'];
                  } 
          
                  if (isset($_POST['weightmax']) && is_numeric($_POST['weightmax'])) { 
                    $weightmax = $_POST['weightmax'];
                  } 
          
                  if (isset($_POST['levelmin']) && is_numeric($_POST['levelmin'])) { 
                    $levelmin = $_POST['levelmin'];
                  } 
          
                  if (isset($_POST['levelmax']) && is_numeric($_POST['levelmax'])) { 
                    $levelmax = $_POST['levelmax'];
                  } 


                $wordsInDatabase = array();
                for($i = 0; $i < count($exclusion_list); $i++){
                    $word = $exclusion_list[$i];
                    $checkword = checkWord($word);
                    if (!empty($checkword)) {
                        array_push($wordsInDatabase, $checkword);//need to complete checkword function
                        
                    } 

                }
                $wordList = array();
                $allAnswers = "";
                $puzzleChars = getWordChars($input);    //  split the current word being turned into a puzzle into the characters in that word.  Result is an array
                echo '<div class="container"><h1 style="color:red;">Find the words for "' . $input . '"</h1>';
                $word_array = array();
                $image_array = array();
                for ($i = 0; $i < count($puzzleChars); $i++) {
                    $word = getRandomWordWithException($puzzleChars[$i], $wordList, $wordsInDatabase, $lenmin, $lenmax, $daysFromToday, $strengthmin, $strengthmax, $weightmin, 
            $weightmax, $levelmin, $levelmax);
                    if (!empty($word)) {
                        array_push($word_array, $word['word']);
                        array_push($wordList, $word['word']);
                        array_push($image_array, $word['image']);
                    } else {
                        array_push($word_array, $puzzleChars[$i]);
                        array_push($image_array, "");
                        //$generate = false;
                    }
                }
                $allAnswers .="<h2 style='color: green;'> Answer for Puzzle: \"".$input."\"</h2>";
                echo '<h1>Puzzle # 1</h1>';

                echo '<table class="table" id="print_table" border="0" style="width: auto">';
                for ($i = 0; $i < count($puzzleChars); $i++) {
                    $word_chars = getWordChars($word_array[$i]);
                    $pos = array_search($puzzleChars[$i], $word_chars) + 1;
                    $len = count($word_chars);
                    if (empty($image_array[$i])){
                        $image = null;
                    } else {
                        $image = getImageIfExists($image_array[$i]);
                    }
                    $word = $word_array[$i];
                    if ($i === 0) {
                        echo '<tr>';
                    } else if ($i % 4 === 0) {
                        echo '</tr border="0"><tr>';
                    }
                    if (empty($image)) {
                        echo "<td align='center' style='vertical-align:bottom; border-top: none;'><h1> $puzzleChars[$i] </h1>
                        <figcaption class=\"print-figCaption\">" . $pos . '/' . $len . "</figcaption>
                        <div align='center' class='answerDiv'><h3>" . $word . "</h3></div></td>";

                    } else {
                        echo "<td align='center' style='border-top: none; vertical-align: bottom;'>
                            <h1 class='letters' style='display:none;'> $puzzleChars[$i] </h1>
                            <div class='maskImage'><img class=\"print-img\" src=\"$image\" alt =\"$image\"></div>
                            <figcaption class=\"print-figCaption\">" . $pos . '/' . $len . "</figcaption>
                            <div align='center' class='answerDiv'><h3>" . $word . "</h3></div></td>";
                    }
                    $allAnswers .= "<h5>".$word."</h5>";
                }
                echo '</tr>';
                echo '</table></div>';

                echo '<div name="allAnswers" style="display:none"><h3>'.$allAnswers.'</h3></div>';

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

//            var size = document.getElementById("rowSize").value;
//            var tables = document.getElementsByClassName("table");
//
//            for(i=0; i<tables.length; i++){
//
//                var table = tables[i];
//               // alert(table.rows[0].cells.length);
//                table.rows[0].in(size);
//                alert(table.rows[0].cells.length);
//
//
//                if(table.column.length != size){
//                    table.rows.length = size;
//
//                }
//            }
        }

    </script>


</div>
</body>
</html>
