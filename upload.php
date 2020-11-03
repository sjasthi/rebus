<?php

echo ($_POST['word_id']);
print_r($_POST['word_id']);
if (isset($_POST['word_id'])) {

$wordID = $_POST['word_id'];
print_r($wordID);
echo $wordID;
// $file_name = basename($_FILES["fileToUpload"]["name"]);
// print_r($file_name);

// $target_dir = "images/";
// $target_dir = $target_dir . $file_name . "/";
// print_r($target_dir);
// if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
//     $sql = "UPDATE `word`
//             SET image = $file_name
//             WHERE `word_id` = $wordID";

//             mysqli_query($db, $sql);
//             header('location: add_images.php?upload=success');
// }

}
?>