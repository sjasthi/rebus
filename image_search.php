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
            text-align: center;
        }

        .flex-row > div {
            padding: 5px;
        }
        
        .warning {
            font-size: 22px;
            color: red;
        }

        textarea {
            padding: 10px; 
            border: 2px solid black;
            border-radius: 10px;
            width: 100%;
            font-size: 24px;
        }
    
        .flex-col {
            display: flex;
            align-items: center;
            padding: 10px;
            font-size: 30px;
        }

        .flex-col > div {
            flex: 1;
        }
        
        .warning {
            font-size: 22px;
            color: red;
        }
    
    </style>


</head>
<title>Rebus Image Search</title>
<body>
<?php
    session_start();
    require('session_validation.php');
    require('utility_functions.php');
    require('common_sql_functions.php');
?>
<?php echo getTopNav(); ?>

<div class="divTitle" align="center">
    <font class="font">Image Search</font>
</div>
<br>

<div>
    <form method="post" action="">
        <div class="container flex-row">

            <div>
                <textarea name="query" rows="8" placeholder="Enter multiple words; one per line to find matching images" onfocus="this.placeholder=''" onblur="this.placeholder='Enter multiple words; one per line to find matching images'"></textarea>
            </div>

            <div>
                <input class="main-buttons" type="submit" name="query_images" value="Show me.."/>
            </div>

                <?php

                    // Check that form was submitted
                    if(!empty($_POST['query'])):

                    // Sanitize POST array
                    $query = preg_split("/[\s,]+/", validate_input($_POST['query']));


                    // $solutionWords = preg_replace("/\r\n/", ",", validate_input($_POST['solution_words']));

                    foreach($query as $word){
                        $images = getImg($word);    
                    }

                ?>

                <?php if($images): ?>

                    <div id="optionContainer" class="optionDiv" style="display: block;" align="center">
         
                        <div id="imagePreferences">
                            <lable><b style="font-size: 20px;">Image Size Preference: </b></lable>
                            <input type="radio" name="imageSize" onclick="alterImageSize()"><label>Default</label>
                            <input style="margin-left:5px;" size="2px" type="text" name="default" id="default" value="150">
                            <input type="radio" style="margin-left:15px;" name="imageSize" onclick="alterImageSize()"><label>Height Driven</label>
                            <input style="margin-left:5px;" size="2px" type="text" name="heightDriven" id="heightDriven">
                            <input type="radio" style="margin-left:15px;" name="imageSize" onclick="alterImageSize()"><label>WidthDriven</label>
                            <input style="margin-left:5px;" size="2px" type="text" name="widthDriven" id="widthDriven">
                        </div>

                    </div>
                <?php endif?>

                <?php

                    // no images found for the following words...
                    $words = [];
                    foreach($query as $word){
                        $images = getImg($word);
                        
                        if(!$images){
                            array_push($words, $word);
                        }
                    }

                    if(count($words) > 0){
                        $words = implode(", ", $words);
                        echo "<p class='warning'>No images found for: {$words}";
                    }
                    
                    // show images
                    foreach($query as $word):
                        
                        $images = getImg($word);
                        if($images): ?>

                <?php 
                
                            foreach($images as $img): ?>
                            
                            <div class="flex-col">
                                <div><?php echo $img['english_word']; ?></div>
                                <div class="mask-image"><img  src="Images/<?php echo $img['image']; ?>" alt="<?php echo $img['english_word']; ?>" class="print-img"></div>
                            </div>
        
                <?php
                            endforeach;

                        endif;
                    endforeach;

                ?>

            <?php endif; ?>

            </div>
  
        </div>
    </form>
</div>

<script>

function alterImageSize() {
      var options = document.getElementsByName('imageSize');
      var defaultSize = document.getElementById('default').value + "px";
      var heightDriven = document.getElementById('heightDriven').value + "px";
      var widthDriven = document.getElementById('widthDriven').value + "px";
      var imageStyle = document.getElementsByClassName('print-img');
      var imageHousing = document.getElementsByClassName('mask-image');

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

</script>

</body>
</html>
