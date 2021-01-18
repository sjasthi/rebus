<?PHP
require('session_validation.php');
require('db_configuration.php');
require('InsertUtil.php');
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
<title>Rebus Many From a List</title>
<body>
<?PHP echo getTopNav(); ?>
<div id="pop_up_fail" class="container pop_up" style="display:none">
    <div class="pop_up_background">
        <img class="pop_up_img_fail" src="pic/info_circle.png">
        <div class="pop_up_text">Incorrect! <br>Try Again!</div>
        <button class="pop_up_button" onclick="toggle_display('pop_up_fail')">OK</button>
    </div>
</div>
<div style="text-align: center; color: #FF0000; font-size: 28px;">
<?php


if (isset($_POST['Add'])){
    if (isset($_POST['wordList'])) {
        $wordList = $_POST['wordList'];
    }
    if (isset($_POST['name'])) {
        $eng = $_POST['name'];
    }
    if ( strlen($_POST['name']) && strlen($_POST['wordList']) && $_FILES["fileToUpload"]["tmp_name"] ){
        //if (isset($_POST['fileToUpload'])) {
        $inputFileName = $_FILES["fileToUpload"]["tmp_name"];
        //echo $inputFileName;

        $target_dir = "./Images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        //echo $target_file;
        $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $imageName = basename($_FILES["fileToUpload"]["name"]);
        // echo $imageName;
        if (!empty($imageName)) {
            copy($inputFileName, $target_file);
        }

        $splitWords = $wordList; //Remove dot at end if exists
        $splitWords = preg_replace('/\s+/', '', $splitWords);
        $array = explode(',', $splitWords); //split string into array seperated by ', '
        foreach($array as $value) //loop over values
        {
          echo '"' . $value . '": '; //print value
          insertIntoWordsTable($value, $eng, $imageName);
          echo '<br>';
        }
    } else {
      echo 'you must fill all forms to submit this page.';
    }
}

?>
</div>
<div style="text-align:center;  font-size: 26px;" class="container">
<form action="" method="post" enctype="multipart/form-data">
  <div>
    <input class="main-buttons" type="submit" name="Add" value="Add"/>
  </div>
  <br>
<div class="divTitle" align="center" style="font-weight: bold;">
    Words (Seperated by comma)
</div>
<br/>
<div>
		<div style="clear: both;">
			<textarea cols="75" rows="8" style="font-family:Times New Roman, Times, serif;font-size: 24px; padding: 10px;  border: 2px solid black; border-radius: 10px; clear: both; background-color: #FFF8DC;" name="wordList" id="name-textarea"></textarea>
      <br>
    </div>
		<br>
    <div>
        <div style="font-weight: bold;"> English Word </div><br>
      <input type="textbox" name="name" id="name" style="padding: 10px; clear: both; border: 2px solid black; border-radius: 10px; background-color: #FFF8DC; "/>
    </div>
    <br/>
    <div style="">
        <div style="font-weight: bold;">   Select Image<br> </div>
      <input class="upload" type="file" name="fileToUpload" id="fileToUpload" style="padding: 10px; clear: both; background-color: #EFDFBB;"/>
    </div>
    <br>
    <br><br>
    </form>
  </div>
</div>

</body>
</html>
