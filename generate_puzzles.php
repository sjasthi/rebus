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
  <title>Rebus Puzzles</title>
</head>
<body>
  <?php
  require('create_puzzle.php');
  require('utility_functions.php');
  ?> 
  <!-- ./pic/SILClogo.jpg -->
  <div style="width: 100%; background-color: #92d050; text-align: center;"><img src="./pic/logo.png" style="height: 190px; width:auto; cursor: pointer;" onclick="showHideOptions()"> </div><br>
  <div class="container">
    <?php
    if (isset($_POST['max'])) { // this is for one to many puzzle which provides a MAX_COUNT
      $maxProvided = true;
      $max = $_POST['max'];
    } else { // this is for one to many
      $maxProvided = false;
    }
    if (isset($_POST['puzzle'])) {
      $input = preg_replace("/\r\n/", ",", validate_input($_POST['puzzle']));
      // Verify the input value provided meets our requirements
      if ($input == '') {
        // If input is empty, go back to one_to_many page
        echo '<script type="text/javascript">alert("You did not enter any words. Please try again!"); ';
        if ($maxProvided) {
          echo 'window.location.href = "one_to_many_plus.php"</script>';
        } else {
          echo 'window.location.href = "one_to_many.php"</script>';
        }
      } else if (count(explode(",", trim($input))) > 1) {
        // If input contains more than one words, go back to previous page
        echo '<script type="text/javascript">alert("You can only enter one word. Please try again"); ';
        if ($maxProvided) {
          echo 'window.location.href = "one_to_many_plus.php"</script>';
        } else {
          echo 'window.location.href = "one_to_many.php"</script>';
        }
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

        echo '<div id="rowSizePreference">';
        echo '<lable><b style="font-size: 20px;">Number of images per row: </b></lable>';
        echo '<input type="radio" name="radioBtn" id="sizeOne" onclick="changeTableRow(id)" value="1" /><label> &nbsp 1 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeTwo" onclick="changeTableRow(id)" value="2" /><label> &nbsp 2 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeThree" onclick="changeTableRow(id)" value="3" /><label> &nbsp 3 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeFour" checked onclick="changeTableRow(id)" value="4" /><label>&nbsp 4 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeFive" onclick="changeTableRow(id)" value="5" /><label> &nbsp 5 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeSix" onclick="changeTableRow(id)" value="6" /><label>&nbsp 6 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeSeven" onclick="changeTableRow(id)" value="7" /><label>&nbsp 7 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeEight" onclick="changeTableRow(id)" value="8" /><label>&nbsp 8 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeNine" onclick="changeTableRow(id)" value="9" /><label>&nbsp 9 &nbsp &nbsp</label>';
        echo '<input type="radio" name="radioBtn" id="sizeTen" onclick="changeTableRow(id)" value="10" /><label>&nbsp 10 &nbsp &nbsp</label>';
        echo '</div>';
        

        echo '<div id="lengthPreferences">';
        echo '<form action="/rebus/generate_puzzles.php" method="post"><lable><b style="font-size: 20px;">Length Preference: </b></lable>';
        echo '<label>Length Minimum</label>
        <input style="margin-left:5px;" size="2px" type="text" name="lenmin" id="lenmin"/>';
        echo '<label style="padding: 8px;">Length Maximum</label>
        <input style="margin-left:5px;" size="2px" type="text" name="lenmax" id="lenmax"/>';
        echo '<input type="hidden" id="puzzle" name="puzzle" value="'. $_POST['puzzle'] .'">';
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
        $lenmin = 1;
        $lenmax = 120;
        $daysFromToday = 1000;
        $strengthmin = 1;
        $strengthmax = 7;
        $weightmin = 1;
        $weightmax = 30;
        $levelmin = 1;
        $levelmax = 7;
        //echo '<h3 style="color:green;"><input type="checkbox" name="answer" onclick="toggleAnswer()">Show Answer</h3>';
        if (isset($_POST['lenmin']) && is_numeric($_POST['lenmin'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $lenmin = $_POST['lenmin'];
        } else { // this is for one to many
          $lenmin = 1;
        }

        if (isset($_POST['lenmax']) && is_numeric($_POST['lenmax'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $lenmax = $_POST['lenmax'];
        } else { // this is for one to many
          $lenmax = 120;
        }

        if (isset($_POST['daysFromToday']) && is_numeric($_POST['daysFromToday'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $daysFromToday = $_POST['daysFromToday'];
        } 

        if (isset($_POST['strengthmin']) && is_numeric($_POST['strengthmin'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $strengthmin = $_POST['strengthmin'];
        } 

        if (isset($_POST['strengthmax']) && is_numeric($_POST['strengthmax'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $strengthmax = $_POST['strengthmax'];
        } 

        if (isset($_POST['weightmin']) && is_numeric($_POST['weightmin'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $weightmin = $_POST['weightmin'];
        } 

        if (isset($_POST['weightmax']) && is_numeric($_POST['weightmax'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $weightmax = $_POST['weightmax'];
        } 

        if (isset($_POST['levelmin']) && is_numeric($_POST['levelmin'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $levelmin = $_POST['levelmin'];
        } 

        if (isset($_POST['levelmax']) && is_numeric($_POST['levelmax'])) { // this is for one to many puzzle which provides a MAX_COUNT
          $levelmax = $_POST['levelmax'];
        } 

        // Display the puzzles generated for given word
        $puzzles = explode(",", trim($input));
        $wordList = array(); // we will use this to keep track of words being used so no repetition occurs
        $allAnswers = "";
        foreach ($puzzles as $puzzleWord) {
          echo '<div class="container"><h1 style="color:red;">Find the words for "' . $puzzleWord . '"</h1>';
          $puzzleChars = getWordChars($puzzleWord);
          $generate = true;
          $counter = 0;
          //$allAnswers .= "<h1>Answers for ".$puzzleWord.": </h1>";
          $allAnswers .="<h2 style='color: green;'> Answer for Puzzle: \"".$puzzleWord."\"</h2>";
          while ($generate) {
            $word_array = array();
            $image_array = array();
            for ($i = 0; $i < count($puzzleChars); $i++) {
              $word = getRandomWord($puzzleChars[$i], $wordList, $lenmin, $lenmax, $daysFromToday, $strengthmin, $strengthmax, $weightmin, 
            $weightmax, $levelmin, $levelmax);
              if (!empty($word)) {
                array_push($word_array, $word['word']);
                array_push($wordList, $word['word']);
                array_push($image_array, $word['image']);
              } else {
                array_push($word_array, $puzzleChars[$i]);
                array_push($image_array, "");
                if (!$maxProvided) {
                  $generate = false;
                  //  break;
                }
              }
            }


            //if ($generate) {
            $counter++;
            $allAnswers .="<h2 style='color: green;'>Puzzle #".$counter."</h2>";
            echo '<h1>Puzzle #' . $counter . '</h1>';
            echo '<table class="table" id="print_table" border="0" style="width: auto">';
            for ($i = 0; $i < count($puzzleChars); $i++) {
              $word_chars = getWordChars($word_array[$i]);
              $pos = array_search($puzzleChars[$i], $word_chars) + 1;
              $len = count($word_chars);
              $image = getImageIfExists($image_array[$i]);
              $word = $word_array[$i];
              if ($i === 0) {
                echo '<tr >';
              } else if ($i % 4 === 0) {
                echo '</tr border="0"><tr>';
              }
              if (empty($image)) {
                echo "<td align='center' style='border-top: none; vertical-align: bottom;'>
                <h1 class='char'> $puzzleChars[$i] </h1>
                <figcaption class=\"print-figCaption\">" . $pos . '/' . $len . "</figcaption>
                <div align='center' class='answerDiv'><h3>" . $word . "</h3></div></td>";
              } else {
                echo "<td align='center' style='border-top: none; vertical-align: bottom;'>
                <h1 class='letters' style='display:none;'> $puzzleChars[$i] </h1>
                <div class='maskImage'><img class='print-img' src=\"$image\" alt =\"$image\"></div>
                <figcaption class=\"print-figCaption\">" . $pos . '/' . $len . "</figcaption>
                <div align='center' class='answerDiv'><h3>" . $word . "</h3></div></td>";
              }
              $allAnswers .= "<h5>".$word."</h5>";
            }
            echo '</tr>';
            echo '</table>';
            //  }
            if ($maxProvided) {
              // only display max count number of puzzles
              if ($counter == $max) {
                $generate = false;
              }
            }
          }

        }
        //  $allAnswers = preg_replace("</td>","",$allAnswers);
        // echo $allAnswers;
        echo '<div name="allAnswers" style="display:none"><h3>'.$allAnswers.'</h3></div>';
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

    function changeTableRow(id){
      var size = document.getElementById(id).value;
      var tables = document.getElementsByClassName("table");

      for(i = 0; i < tables.length; i++){
        var table = tables[i];

        var j = 0;
        var done = 0;
        var rowObject = table.rows[j];
        var diff  = rowObject.cells.length - size;

        //Making rows larger
        if(diff < 0){
          while(done === 0){
            while(table.rows[j].cells.length < size){
              table.rows[j].insertCell(table.rows[j].cells.length).innerHTML = table.rows[j+1].cells[0].innerHTML;

              table.rows[j+1].deleteCell(0);
              if(table.rows[j+1].cells.length === 0){
                table.deleteRow(j+1);
              }
            }
            j++;
            try{ var next = table.rows[j].cells.length;
              if (next < size && table.rows[j+1].cells.length < size){
              }
            }catch{done = 1;}
          }
        }
        //Make rows smaller
        else {
          while(done === 0){
            //  alert("here");
            while(table.rows[j].cells.length > size ){
              //alert(table.rows[j+1].cells.length);
              try{
                if(table.rows[j+1].cells.length !== 0 ){}
              }catch{table.insertRow(j+1);}
              table.rows[j+1].insertCell(0).innerHTML = table.rows[j].cells[table.rows[j].cells.length-1].innerHTML;
              table.rows[j].deleteCell(table.rows[j].cells.length-1);
            }
            j++;
            try{ var next = table.rows[j].cells.length;

              if (table.rows[j].cells.length !== 0){

              }else{done = 1;}
            }catch{done = 1;}
          }
        }
      }
    }



    </script>

    <style>
      .table tbody tr td {
        vertical-align: bottom;
        border-top: none;
        text-align: center;
      }
      .print-figCaption {
        margin-left: 25%;
      }
    </style>

  </div>
</body>
</html>
