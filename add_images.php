<?php

require 'db_configuration.php';
require('session_validation.php');
session_start();

if(is_array($_FILES)) 
{
    
    //echo $_FILES;
    if(isset($_FILES['userImage']['tmp_name'])){
        if(is_uploaded_file($_FILES['userImage']['tmp_name'])) {
            $sourcePath = $_FILES['userImage']['tmp_name'];
            $targetPath = "images/".$_FILES['userImage']['name'];
            
            move_uploaded_file($sourcePath,$targetPath);
            
            print_r($_FILES);
        }
    }

}

// if (isset($_POST['word_id'])) {

//     $wordID = $_POST['word_id'];
//     print_r($wordID);
//     $word = $_POST['image_name'];
//     print_r($word);

//     $file_name = basename($_FILES["file"]["name"]);
//     print_r($file_name);

//     $target_dir = "images/";
//     $target_dir = $target_dir . $file_name . "/";
//     print_r($target_dir);
//     if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)){
//         $sql = "UPDATE `word`
//                 SET image = $file_name
//                 WHERE `word_id` = $wordID";
    
//                 mysqli_query($db, $sql);
//                 header('location: list_dresses.php?create_dress=success');
//     }

// }
//     if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file))

//     $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
//     $path_parts = pathinfo($_FILES["file"]["name"]);
//     $extension = $extension = $path_parts['extension'];
//     if (isset($_POST['path']) && $_POST['path'] != null && $_POST['path'] != "") {
//         $target_file = $_POST['path'];
//         unlink($target_file);
//     } else {
//         $target_file = $target_dir . getToken(16) . $libraryID . "." . $extension;
//         unlink($target_file);
//     }
//     $uploadOk = 1;
//     //echo $target_file;
//     $check = getimagesize($_FILES["file"]["tmp_name"]);
//     if ($check == false) {
//         $uploadOk = 0;
//         $errorReason = "not an image.";
//     }
//     if (file_exists($target_file)) {
//         unlink($target_file);
//     }
//     if ($_FILES["file"]["size"] > 5000000) {
//         $uploadOk = 0;
//         $errorReason = "image was too large.";
//     }
//     $allowableExtensions = array("jpeg", "jpg", "png", "PNG", "JPG", "JPEG");
//     if (!in_array($extension, $allowableExtensions)) {
//         $uploadOk = 0;
//         $errorReason = "image has a bad extension.";
//     }
//     if ($uploadOk == 0) {
//         header("Location: LibraryMain.php?id=" . $libraryID . "&error=true&messgae=" . $errorReason);
//         exit();
//     } else {
//         if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
//         } else {
//             $uploadOK = 0;
//             $errorReason = "Could Not Move image.";
//         }
//     }
//     header("Location: LibraryMain.php?id=" . $libraryID . "&success=true");
//     exit();
// } else {
//     header("Location: LibraryMain.php?id=" . $libraryID . "&error=true&message=Something went wrong.");
//     exit();
// }
?>

<html>
<head>
<!-- <link rel="stylesheet" href="styles/main_style.css" type="text/css"> -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- jQuery library -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script> -->
    <!-- Latest compiled JavaScript -->
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <link rel="stylesheet" href="styles/custom_nav.css" type="text/css">
    
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script> -->
<link rel="stylesheet" type="text/css" href="dropzone/dropzone.css" />
<!-- <script src="dropzone.min.js"></script>> -->
<!-- <script type="text/javascript" src="dropzone/dropzone.js"></script> -->
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

.title{
    /* margin-left:200px; */
    margin-top: -10px;

} 

#table {
    margin:0 auto;

}

</style>
<body>


    <?php

    //=============================================================================
    // Step 1: Get the row_count and dresses_count from COOKIE or from defaults
    //=============================================================================
    // Hard code these defaults for now; Ideally, we can get these from the database.
    echo getTopNav();
    $row_count = 5;

   

    //=============================================================================
    // Step 2: Get the $pic and $name for each of the dresses from the database
    // Refrence: https://www.php.net/manual/en/mysqli-result.fetch-assoc.php
    //=============================================================================

    $images = "SELECT `word_id` FROM `words` WHERE image = '' ORDER BY `word_id` ASC";
    // $words_no_images = "SELECT `word_id` FROM `words` WHERE image = '' ORDER BY `word` ASC"
    
    $word_results = mysqli_query($db, $images);
    // $title_words = mysqli_query($db, $words_no_images);

    if (mysqli_num_rows($word_results) > 0) {
        while ($row = mysqli_fetch_assoc($word_results)) {
            $words[] = $row;
        }
    }
    // print_r($words);
    $db_words = array();
    foreach ($words as $associative => $word){
        foreach($word as $w => $x){
            array_push($db_words, $x);
        }
        
    }
    
    
// These are most of the websites I looked at to get the code for Dropzone
// http://mrbool.com/building-a-file-upload-form-using-dropzonejs-and-php/34395
// https://www.dropzonejs.com/
// https://www.startutorial.com/articles/view/how-to-build-a-file-upload-form-using-dropzonejs-and-php
// https://makitweb.com/upload-file-using-dropzone-js-php/
// https://makitweb.com/how-to-upload-image-file-using-ajax-and-jquery/

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
        ?>                
                    <td>
                        <form action="upload.php" class='dropzone'  id = '<?php echo $db_words[$a] ?>' method="post">
                            <div class='dz-message'> 
                                <!-- needsclick -->
                                <h3 class='drop-text'>Drag and Drop Image Here</h3>
                            </div>
                            <br>
                            <br>
                            <div class = "title"><?php echo $title_words[0]; ?></div>
                            <input hidden='true' type='text' name='word_id' value='<?php $db_words[$a] ?>'/>
                            <!-- <div class="fallback">
                                <input hidden='true' type="file" name="file" />
                            </div> -->
                            <!-- <input type="submit" value="Submit"> -->
                        </form>

                        <br> 
                        <br> 
                        <br>

                    </td>
                <?php
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


    


    
<script>
// function drop(event, word) {
//   event.preventDefault();
  
// }
// $(document).ready(function(){
//     $(".dropzone").dropzone({
// 	  url: 'upload.php',
// 	  width: 300,
// 	  height: 300, 
// 	  progressBarWidth: '100%',
//       maxFileSize: '5MB'
// 	})
// });
</script>

</body>

</html>