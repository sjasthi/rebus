<?php
require_once('db_configuration.php');

$word = $_POST['word'];
$file = $_POST['file'];

$file_name = basename($_FILES["fileToUpload"]["name"]);
print_r($file_name);

$target_dir = "images/";
$target_dir = $target_dir . $file_name . "/";
print_r($target_dir);
if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
    $sql = "UPDATE `word`
            SET image = $file_name
            WHERE `word` = $word";

            // mysqli_query($db, $sql);
            run_sql($sql);
            header('location: add_images.php?upload=success');
}

}
?>