<?php
require('session_validation.php');
require 'db_configuration.php';

ini_set("log_errors", 1); // go ahead and log the errors

// log the errors to a file called "rebus_errors.log"
ini_set("error_log", "rebus_errors.log"); 

?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    
<script src="styles/dropzone.css"></script>
<script src="./javascript/dropzone.js"></script>
</head>
<style>

 .dropzone
{
 text-align:center; 
 margin:0 auto;
 margin: 20px;
 padding:30px;
 width:250px;
 height:300px; 
 background-color:white;
 border:3px dashed grey;
}
.dz-message
{
 margin-top:-30px;
 margin-left:-30px;
 width:250px;
 height:200px; 
}
.drop-text
{
 margin-top:70px;
 color:grey;
 font-size:15px;
 font-weight:bold;

}

.word_title{ 
    /* margin-left:200px; */
    margin-top: -10px;

} 

#table {
    margin:0 auto;

} 

</style>
<body>


    <?php

    echo getTopNav();
    $row_count = 5;

   

    $images = "SELECT `word_id` FROM `words` WHERE image = '' ORDER BY `word_id` ASC";
    // $words_no_images = "SELECT `word_id` FROM `words` WHERE image = '' ORDER BY `word` ASC"
    
    $word_results = mysqli_query($db, $images);
    // $title_words = mysqli_query($db, $words_no_images);

    if (mysqli_num_rows($word_results) > 0) {
        while ($row = mysqli_fetch_assoc($word_results)) {
            $words[] = $row;
        }
    }
    $db_words = array();
    foreach ($words as $associative => $word){
        foreach($word as $w => $x){
            array_push($db_words, $x);
        }
        
    }
    


?>
<br>
<br>
	
<table id="table">
        <tr>
        <?php
        for ($a = 0; $a < count($db_words); $a) {
            for ($b = 0; $b < $row_count; $b++) {
                if(isset($db_words[$a])){ 
                    $image_word = $db_words[$a];
                    $get_word = "SELECT `word` FROM `words` WHERE word_id = '$image_word'";
                    
                    $title_results = mysqli_query($db, $get_word);
                    $titles = array();
                    if (mysqli_num_rows($title_results) > 0) {
                        while ($row = mysqli_fetch_assoc($title_results)) {
                            $titles[] = $row;
                        }
                    }
                    $title_words = array();
                    foreach ($titles as $associative => $title_word){
                        foreach($title_word as $assoc => $display){
                            array_push($title_words, $display);
                        }
                        
                    }
                    $image_name = str_replace(' ', '_', $title_words[0]);

                    echo "<td> <div class = \"word_title\" style=\"text-align: center;\">" . $title_words[0] . "</div>";
                    echo "<form action=\"upload.php\" class=\"dropzone\"><div class='dz-message'>
                    <h3 class='drop-text'>Drag and Drop Image Here</h3></div>";
                    echo "<input hidden='true' type='text' name='word_id' value='" . $db_words[$a] . "'/>";
                    echo "</form><br><br><br>";
                    echo "</td>";

                $a++;  
                }else{
                    $a++;
                }
                
            }
            ?>
            </tr>
        <?php
        }
        ?>
    </table>


    




</body>

</html>