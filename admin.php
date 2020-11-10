<!--FIXME: random user can get to page by putting admin.php into the url need to change so that only an admin can load the page-->
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
    <title>Rebus Admin</title>
</head>
<?PHP
require('session_validation.php');
//require('import.php');
/*
if ((!isset($_SESSION['valid_admin'])){
    echo "<meta http-equiv=\"refresh\" content=\"0;URL=login.php\">";
}
else{
}
*/
?>

<body>
<?PHP
session_start();
echo getTopNav();
?>
<!--<div id="export">
    <br><br>
    <h2 class="upload">[3]Import the word list (Source: Excel File; Target: Database)</h2>
    <div id="import">
        <p id="error" style="display: none;">Error: You must select a file to import</p>
        <?php
require('import.php');
if ($error) {
    ?>
            <p id="error" style="display:block;background-color: #ce4646;padding:5px;color:#fff;">
                <?php echo $result; ?>
            </p>
        <?php } ?>
        <form class="upload" method="post" name="importFrom" enctype="multipart/form-data"
              onsubmit="return validateForm()">
            <label class="upload"><input class="upload" type="file" name="fileToUpload" id="fileToUpload"></label>
            <input class="upload" type="submit" value="Submit File" name="submit">
        </form>
    </div> -->
<!-- <div class="backUpSuccess">The database backup has been saved in the Sql_Scripts Folder.</div>
 <p id="demo"></p> -->
<br><br>
<table align="center" class="adminTable">
    <tr>
        <td align="center">
            <a href="add_word.php"><img src="./pic/addAWord.png" class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a href="list.php"><img src="./pic/wordList.png" class="adminThumbnailSize">
        </td>
        <td align="center">
            <a href="admin_manage_users.php"><img src="./pic/users.png" class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a href="export_db.php"><img src="./pic/export.png" class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a href="uploadPage.php"><img src="./pic/import.png" class="adminThumbnailSize">
        </td>
        <td align="center">
            <a href="#"><img src="./pic/configure.png" class="adminThumbnailSize"></a>
        </td>
    </tr>
    <tr>
        <td align="center"><a href="add_word.php">Add Word</a></td>
        <td align="center"><a href="list.php">Word List</a></td>
        <td align="center"><a href="admin_manage_users.php">Users</a></td>
        <td align="center"><a href="export_db.php">Export</a></td>
        <td align="center"><a href="uploadPage.php">Import</a></td>
        <td align="center"><a href="#">Configure</a></td>
    </tr>
    <tr class="separator">
        <td></td>
    </tr>
    <tr>
        <td align="center">
            <a href="backup.php" onclick="backUpMessage()"><img src="./pic/backUp.png" class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a href="report.php"><img src="./pic/report.png" class="adminThumbnailSize">
        </td>
        <td align="center">
            <a target="_blank" href="one_to_many.php"><img src="./pic/oneWordManyPuzzles.png"
                                                           class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a target="_blank" href="many_to_one.php"><img src="./pic/manyWordsOnePuzzle.png"
                                                           class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a target="_blank" href="one_to_many_plus.php"><img src="./pic/oneWordManyPuzzlesPlus.png"
                                                                class="adminThumbnailSize">
        </td>
        <td align="center">
            <a href="userManual.php"><img src="./pic/user_manual.png" class="adminThumbnailSize"></a>
        </td>
    </tr>
    <tr>
        <td align="center"><a href="backup.php" onclick="backUpMessage()">Backup</a></td>
        <td align="center"><a href="report.php">Report</a></td>
        <td align="center"><a target="_blank" href="one_to_many.php">One Word <br> Many Puzzle</a></td>
        <td align="center"><a target="_blank" href="many_to_one.php">Many Words <br> One Puzzle</a></td>
        <td align="center"><a target="_blank" href="one_to_many_plus.php">One Word <br> Many Puzzle <br> Plus</a></td>
        <td align="center"><a href="userManual.php">User <br> Manual</a></td>
    </tr>
    <tr class="separator">
        <td></td>
    </tr>
    <tr>
<!--
        <td align="center">
            <a href="ManyFromAlist.php" onclick="backUpMessage()"><img src="./pic/ManyFromAlist.png" class="adminThumbnailSize"></a>
        </td>
-->
         <td align="center">
            <a href="many_From_A_list.php"><img src="./pic/manyfromalist.png" class="adminThumbnailSize">
        </td>
        <td align="center">
           <a href="add_words.php"><img src="./pic/add_words.jpg" class="adminThumbnailSize">
       </td>
       <td align="center">
          <a href="add_many_words_one_image.php"><img src="./pic/add_many_words_one_image.jpg" class="adminThumbnailSize">
      </td>
      <td align="center">
          <a href="one_from_a_given_list.php"><img src="./pic/one_from_A_list.png" class="adminThumbnailSize">
      </td>
      <td align="center">
          <a href="puzzle_with_exclusion.php"><img src="./pic/exclusion_list.png" class="adminThumbnailSize">
      </td>
      <td align="center">
          <a href="add_images.php"><img src="./pic/add_images.png" class="adminThumbnailSize">
      </td>
<!--
        <td align="center">
            <a target="_blank" href="one_to_many.php"><img src="./pic/oneWordManyPuzzles.png"
                                                           class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a target="_blank" href="many_to_one.php"><img src="./pic/manyWordsOnePuzzle.png"
                                                           class="adminThumbnailSize"></a>
        </td>
        <td align="center">
            <a target="_blank" href="one_to_many_plus.php"><img src="./pic/oneWordManyPuzzlesPlus.png"
                                                                class="adminThumbnailSize">
        </td>
        <td align="center">
            <a href="userManual.php"><img src="./pic/user_manual.png" class="adminThumbnailSize"></a>
        </td>
-->
    </tr>
    <tr>
<!--        <td align="center"><a href="ManyFromAlist.php" onclick="backUpMessage()">Backup</a></td> -->
        <td align="center"><a href="many_from_a_list.php">Many From a List</a></td>
        <td align="center"><a href="add_words.php">Add Words</a></td>
        <td align="center"><a href="add_many_words_one_image.php">Add Many Words One Image</a></td>
        <td align="center"><a href="one_from_a_given_list.php">One From a Given List</a></td>
        <td align="center"><a href="puzzle_with_exclusion.php">Create Puzzle With Exclusion List</a></td>
        <td align="center"><a href="add_images.php">Add Images</a></td>


<!--
        <td align="center"><a target="_blank" href="one_to_many.php">One Word <br> Many Puzzle</a></td>
        <td align="center"><a target="_blank" href="many_to_one.php">Many Words <br> One Puzzle</a></td>
        <td align="center"><a target="_blank" href="one_to_many_plus.php">One Word <br> Many Puzzle <br> Plus</a></td>
        <td align="center"><a href="userManual.php">User <br> Manual</a></td>
-->
    </tr>
    <tr class="separator">
        <td></td>
    </tr>
    <tr>
        <td align="center">
                <a href="force_sync.php"><img src="./pic/force_sync.png" class="adminThumbnailSize">
        </td>
    </tr>
    <tr>
        <td align="center"><a href="force_sync.php">Force Sync</a></td>
    </tr>
</table>
</div>

<script>

    //    function backUpMessage(){
    //        var x = document.getElementsByClassName('backUpSuccess');
    //        if (x.style.display === 'none') {
    //            x.style.visibility = 'block';
    //        }// else {
    //        //    x.style.visibility = 'hidden';
    //        //}
    //        return false;
    //    }

    function backUpMessage() {
        //document.getElementById("demo").innerHTML = "The database backup has been saved in the Sql_Scripts Folder.";
        alert('The database backup has been saved in the Sql_Scripts Folder.');
    }

</script>
</body>

</html>
