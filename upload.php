<?php

ini_set("log_errors", 1); // go ahead and log the errors

// log the errors to a file called "rebus_errors.log"
ini_set("error_log", "rebus_errors.log"); 

require_once('db_configuration.php');

$ds = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'images';   //2

$word_id = $_POST['word_id'];

$fileName = $_FILES['file']['name'];
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
 
    if(move_uploaded_file($tempFile,$targetFile)){ //6
        $sql = 'UPDATE words SET image = \'' . $fileName . '\' WHERE word_id = ' . $word_id;
            run_sql($sql);
            header('location: add_images.php?upload=success');

    } 
     
}
?> 